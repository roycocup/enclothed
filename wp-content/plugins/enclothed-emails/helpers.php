<?php 

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