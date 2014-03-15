<?php


require_once('db.php');


class Emails_model extends db{


	const TEMPLATE_THANK_YOU 				= 'thank_you'; //right after creation - to user
	const TEMPLATE_ORDER_IN 				= 'order_in'; //an order made but not confirmed yet - to agency
	const TEMPLATE_REFUND					= 'refund'; // to user
	const TEMPLATE_REFUND_REQUEST_CLIENT	= 'refund-request-client'; // to user confirming that he requested a refund
	const TEMPLATE_REFUND_REQUEST_AGENCY	= 'refund-request-agency'; // to user confirming that he requested a refund
	const TEMPLATE_CONFIRM 					= 'confirm'; //to user confirming that the trip is booked and money was received
	const TEMPLATE_REVIEW_SUBMITTED			= 'review-submitted'; //this is to the agnecy be informed of a review that was submitted by a momber

	public $table = 'wp_enc_emails';
	

	public function __contruct(){
		parent::__construct();
	}


	public function getMailTemplate($email_template_name){
		$sql = "SELECT * FROM {$this->templates_table} WHERE name = '{$email_template_name}' ";
		$result = $this->wpdb->get_row($sql);
		return $result;
	}

	public function saveMailTemplate($email_template_name, $body){
		$data['body'] =  $body;
		$where['name'] = $email_template_name;
		$this->update($data, $where, $this->templates_table);
	}


	public function saveEmail($template_name, $to, $content){
		$data['email_template_name'] = $template_name;
		$data['to'] = $to;
		$data['content'] = $content;
		$t = $this->insert($data);
	}


	public function _replace($template, $data){
		//collect all the items
		$pattern = '/%([\s\w\_]*)%/sim';
		preg_match_all($pattern, $template->body, $matches);
		//assign values
		$newtemplate = $template->body;
		foreach($matches[1] as $item){
			//recompose the string
			$newtemplate = preg_replace('/%'.$item.'%/sim', $data[$item], $newtemplate);
		}
		//return
		return $newtemplate;
	}


}