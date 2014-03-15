<?php 

/*==========================================
=            assorted functions            =
==========================================*/


if (!function_exists('logme')){
	function logme($message,$success,$end=false) {
		// Timestamp
		$text = '['.date('m/d/Y g:i A').'] - '.(($success)?'SUCCESS :':'FAILURE :').$message. "\n";
		if ($end) {
			$text .= "\n------------------------------------------------------------------\n\n";
		}

		// Write to log
		$fp=fopen('enc_custom_log.txt','a');
		fwrite($fp, $text );
		fclose($fp);
	}
}

if (!function_exists('get_uri')){
	function dump($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

if (!function_exists('get_uri')){
	function get_uri(){
		return $_SERVER['REQUEST_URI'];
	}
}


/*-----  End of assorted functions  ------*/

/*=====================================
=            Flashmessages            =
=====================================*/


/**
*
* Adds another message to the session
*
**/
if (!function_exists('setFlashMessage')){
	function setFlashMessage($type, $msg){
		$_SESSION['messages'][$type][] = $msg;
	}
}

/**
*
* Returns false if there are NO messages
* and true if there are messages
*
**/
if (!function_exists('sessionHasMessages')){
	function sessionHasMessages(){
		if (empty($_SESSION['messages'])) {
			return false; 
		}
		else {
			return true;
		}
	}
}


/**
*
* Outputs each message as a div with the class 'flashmessage' 
* and a class for what type of message.
* It will then destroy all messages in the session;
*
**/
if (!function_exists('flashMessagesDisplay')){
	function flashMessagesDisplay(){
		if (!sessionHasMessages()) return false; 
		foreach($_SESSION['messages'] as $typename => $type){
			foreach ($type as $key => $message) {
				echo "<div class='flashmessage {$typename}'>$message</div>";	
			}
		}
		unset($_SESSION['messages']);	
	}
}

/*-----  End of Flashmessages  ------*/


/*=================================
=            Ecryption            =
=================================*/

if (!function_exists('enc_encrypt')){
	function enc_encrypt($key, $message){
		return $message;
	}
}


if (!function_exists('enc_decrypt')){
	function enc_decrypt($key, $message){
		return $message;
	}
}
/*-----  End of Ecryption  ------*/


