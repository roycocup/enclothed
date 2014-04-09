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
				if ($in_div == 'full'){
					echo "<div class='flashmessage {$typename}'>$message</div>";		
				} elseif ($in_div == 'li') {
					echo '<li>'.$message.'</li>';
				} else{
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
		$diff = $now->diff($ago);
		$diff = time_elapsed_52($datetime);

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

/**
*
* This is a function for very lame servers that run php5.2
* and have no idea about datetime.diff.... LAME
*
**/
if (!function_exists('time_elapsed_52')){
	function time_elapsed_52($date2) { 
		$now = time();
		$date2 = date('d-m-Y H:m:i', $date2);
		$date2 = strtotime($date2);

		$diff = $now - $date2; 

		$unit = '';

		if ($diff > 60 ){$unit = 'minute';} // at least a minute
		if ($diff > 60 * 60){$unit = 'hour';} // at least an hour
		if ($diff > 60 * 60 * 24){$unit = 'day';} // at least a day
		if ($diff > 60 * 60 * 24 * 30){$unit = 'month';} // at least a month
		if ($diff > 60 * 60 * 24 * 30 * 365){$unit = 'year';} // at least a year

		// how many units
		$how_long = '';
		switch ($unit) {
			case 'minute':
				$units = $diff / 60;
				$unit = round($units);
				if ($unit > 1){
					$how_long = $unit.' minutes ago';
				}else{
					$how_long = $unit.' minute ago';
				}
				break;
			case 'hour':
				$units = $diff / 60 / 60;
				$unit = round($units);
				if ($unit > 1){
					$how_long = $unit.' hours ago';
				}else {
					$how_long = $unit.' hour ago';
				}
				break;
			case 'day':
				$units = $diff / 60 / 60 / 24;
				$unit = round($units);
				if ($unit > 1){
					$how_long = $unit.' days ago';
				}else {
					$how_long = $unit.' day ago';
				}
				break;
			case 'month':
				$units = $diff / 60 / 60 / 24 / 30;
				$unit = round($units);
				if ($unit > 1){
					$how_long = $unit.' months ago';
				}else {
					$how_long = $unit.' month ago';
				}
				break;
			case 'year':
				$units = $diff / 60 / 60 / 24 / 30 / 365;
				$unit = round($units);
				if ($unit > 1){
					$how_long = $unit.' years ago';
				}else {
					$how_long = $unit.' year ago';
				}
				break;
		}
		
		return $how_long;
	}
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






