<?php


require_once('db.php');


class Emails_model extends db{


	const TEMPLATE_THANK_YOU 				= 'thank_you'; //right after creation - to user
	const TEMPLATE_ORDER_IN 				= 'order_in'; //an order made - to agency
	const TEMPLATE_THANK_REGISTERING		= 'thank_registering'; //email to user with register details
	const TEMPLATE_NEW_BOX					= 'new_box'; 
	const TEMPLATE_NEW_BOX_USER				= 'new_box_user'; 
	const TEMPLATE_NEW_PASS					= 'new_pass'; 


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