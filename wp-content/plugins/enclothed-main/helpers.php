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
	function flashMessagesDisplay($in_div = false){
		if (!sessionHasMessages()) return false; 
		foreach($_SESSION['messages'] as $typename => $type){
			foreach ($type as $key => $message) {
				if ($in_div){
					echo "<div class='flashmessage {$typename}'>$message</div>";		
				} else {
					echo $message;
				}
				
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



if (!function_exists('time_elapsed')){
	function time_elapsed($datetime, $full = false) {
		$now = new DateTime;
		$datetime = date('d-m-Y H:m:i', $datetime); 
		$ago = new DateTime($datetime);
		// $diff = $now->diff($ago);
		$diff = date_diff_52($now->format('Y-m-d H:i:s'), $ago->format('Y-m-d H:i:s'));
		
		$diff = new DateTime($diff);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
			);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}


function date_diff_52($date1, $date2) { 
    $current = $date1; 
    $datetime2 = date_create($date2); 
    $count = 0; 
    while(date_create($current) < $datetime2){ 
        $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
        $count++; 
    } 
    return $count; 
}


/**
*
* Helper function to help with form fields default value
*
**/
if (!function_exists('echo_if_exists')){
	function echo_if_exists($str = ''){
		echo $str;
	}
}






