<?php 
require_once(dirname(__FILE__).'/wp-bootstrap.php');



// check what cron jobs need doing
class Cronjobs extends db{

	public $table = 'wp_duck_cron';
	
	
	public function __construct(){
		parent::__construct();
		$this->group_model = new Groups_model();
		$this->emails_model = new Emails_model();
		$this->orders_model = new Orders_model();
	}


	public function log_it( $msg, $status = 'CRON', $file = 'debug_log.txt' ) {
		$location = 
		$msg = gmdate( 'Y-m-d H:i:s' ) . ' - ' . $status . ' - ' .print_r( $msg, TRUE ) . "\n\r";
		print_r($msg);
		file_put_contents( $file , $msg, FILE_APPEND);
	}



	//clean up pending orders
	public function clean_up_orders(){
		$pending = Orders_model::STATUS_PENDING;
		$deleted = Orders_model::STATUS_DELETED;
		$days = 5;
		$sql = "SELECT * FROM  `wp_duck_orders` WHERE  `status` =  '{$pending}' AND modified + INTERVAL {$days} DAY < NOW() ";
		$rs = $this->wpdb->get_results($sql);
		foreach($rs as $value){
			$this->log_it("Deleting order $value->order_id because its {$pending} since {$value->modified}");
		}

		//delete AND stamp the modified date
		$sql = "UPDATE `wp_duck_orders` SET `status` = '{$deleted}', `modified` = now() WHERE  `status` =  '{$pending}' AND modified + INTERVAL {$days} DAY < NOW() ";
		$this->wpdb->query($sql);
	}
	


	//send emails to confirm or refund group deals that
	//are expired
	public function processGroup(){
		//deals that are expired that were not processed yet
		$sql = "SELECT pm.*
				FROM wp_posts p
				JOIN wp_postmeta pm ON pm.post_id = p.ID
				WHERE p.post_type = 'groups' 
				AND pm.meta_key = 'end_date' 
				AND pm.meta_value < now()
				AND p.ID NOT IN (SELECT post_id FROM wp_duck_cron c WHERE `status` = 'processed')";

		$groups = $this->wpdb->get_results($sql);
		$now = new Datetime();
		foreach($groups as $deal){
			//check if the minimum people has been attained
			$attained = $this->group_model->is_minimum_attained($deal->post_id);
			$post = $this->group_model->get_post_by_id($deal->post_id);

			//if it has
			//Gather the group of people for this deal
			$orders = $this->get_orders_bought_deal($deal->post_id);
			if ($attained){
				//send email to agency saying that group is complete and we are happy
				$this->send_all_good_email($post, $orders);
			} else {//if not 
				//send email to agency saying that group failed
				$this->send_refund_agency_email($post, $orders);
				//and to users informing them that they will be contacted shortly for refund
				foreach ($orders as $order){
					$data = array(
							'title'			=> $order['primary']->title,
							'name' 			=> $order['primary']->first_name." ".$order['primary']->surname,
							'route_name'	=> $post->post_title,
							'contact_period' => $this->num_days_refund,
							'price'			=> $order['order']->price,
							'bought_date'	=> format_date($order['order']->created),
							'transaction_code' => $order['order']->paypal_transaction_id,
							'order_id'		=> $order['order']->order_id,
							'order_code'	=> $order['order']->order_code,
						);
					//$this->emails_model->sendmail($order['primary']->email, __('Sorry we did not have enough people!'), Emails_model::TEMPLATE_REFUND, $data);
				}
				
			}
			//mark the post as processed in cron table
			$data = array('post_id'=>$post->ID, 'status'=>'processed', 'source'=>'group');
			$this->insert($data);	
			
			
			
		}

	}


	public function get_orders_bought_deal($post_id){
		//get the orders for this deal
		$orders = $this->orders_model->getOrdersIdForPost($post_id);
		foreach($orders as $order){
			//get the order details for each order
			$detailed_orders[] = $order_details = $this->orders_model->getOrderDetails($order->order_id);
		}
		//create an array of orders with its detail about members and primary
		//return
		return $detailed_orders;
	}

	/**
	*
	* This is the email that we SEND TO AGENCY to let them 
	* confirm the orders for the users that bought the group deal
	* and ARE GOOD to go.
	*
	**/
	public function send_all_good_email($post, $order_data){
		$to = get_bloginfo('admin_email');
		$subject = 'Group deal ok to go';
		$message = "<style>
			tr.even{background-color:#ccc}
			table.people{border:2px solid #ccc; text-align:center;}
		</style>";
		$message .= "<table>
		<tr>
			<td>Dear Haloexpress,</td>
		</tr>
		<tr>
			<td>Seems like group deal '{$post->post_title}' has been all bought and is ready to go. </td>
		</tr>
		<tr>
			<td>These are the names of the primary who bought it: </td>
		</tr>";
		$message .= "<table class='people'>
				<tr>
					<th>Name</th>
					<th>email</th>
					<th>phone</th>
					<th>Order ID</th>
					<th>Order Code</th>
					<th>Price</th>
				</tr>";
		foreach ($order_data as $k => $order){
			$class = (($k % 2) == 1)? 'odd':'even';
			$message .= "<tr class='{$class}'>";
			$message .= "<td>{$order['primary']->first_name} {$order['primary']->surname}</td>";
			$message .= "<td>{$order['primary']->email}</td>";
			$message .= "<td>{$order['primary']->phone}</td>";
			$message .= "<td>{$order['order']->order_id}</td>";
			$message .= "<td>{$order['order']->order_code}</td>";
			$message .= "<td>{$order['order']->price}</td>";
			$message .= "</tr>";
		}
		$message .="</table>";
		$message .= "<tr>
						<td>Please dont forget to confirm the orders for all of these people</td>
					</tr></table>";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

		$cool = wp_mail( $to, $subject, $message, $headers);
		$this->emails_model->saveEmail('cron_ok_to_go', $to, $message);
		return $cool;
	}


	/**
	*
	* This is the email to SEND TO AGENCY if things go wrong
	*
	**/
	public function send_refund_agency_email($post, $order_data){
		$to = get_bloginfo('admin_email');
		$subject = 'Group deal needs REFUNDS';
		$message = "<style>
			tr.even{background-color:#ccc}
			table.people{border:2px solid #ccc; text-align:center;}
		</style>";
		$message .= "<table>
		<tr>
			<td>Dear Haloexpress,</td>
		</tr>
		<tr>
			<td>Seems like group deal '{$post->post_title}' has not reached the necessary number of buyers. </td>
		</tr>
		<tr>
			<td>An email has already been sent to all the buyers informing them that they will be contacted in {$this->num_days_refund} days.<td>
		</tr>
		<tr>
			<td>Please go to the orders backend and click the button refund for each order (that will mark the order as refunded), 
			then please go to paypal and make the actual refund for the people below. </td>
		</tr>
		<tr>
			<td>These are the names of the primary who bought it and need to be refunded: </td>
		</tr>";
		$message .= "<table class='people'>
				<tr>
					<th>Name</th>
					<th>email</th>
					<th>phone</th>
					<th>Order ID</th>
					<th>Order Code</th>
					<th>Price</th>
				</tr>";
		foreach ($order_data as $k => $order){
			$class = (($k % 2) == 1)? 'odd':'even';
			$message .= "<tr class='{$class}'>";
			$message .= "<td>{$order['primary']->first_name} {$order['primary']->surname}</td>";
			$message .= "<td>{$order['primary']->email}</td>";
			$message .= "<td>{$order['primary']->phone}</td>";
			$message .= "<td>{$order['order']->order_id}</td>";
			$message .= "<td>{$order['order']->order_code}</td>";
			$message .= "<td>{$order['order']->price}</td>";
			$message .= "</tr>";
		}
		$message .="</table>";
		$message .= "<tr>
						<td>Please dont forget to refund the orders for these people.</td>
					</tr></table>";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

		$cool = wp_mail( $to, $subject, $message, $headers);
		$this->emails_model->saveEmail('cron_group_refund', $to, $message);
		return $cool;
	}


}

$cron = new Cronjobs();
$cron->processGroup(); //send emails to confirm or refund group deals that are expired
$cron->clean_up_orders(); //soft delete all orders that were deleted, pending from 5 days ago

?>
