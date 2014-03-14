<?php 

if (!function_exists(logme)){
	function logme($message,$success,$end=false) {
		if (!$this->ipn_log) return;  // is logging turned off?

		// Timestamp
		$text = '['.date('m/d/Y g:i A').'] - '.(($success)?'SUCCESS :':'FAILURE :').$message. "\n";
		if ($end) {
			$text .= "\n------------------------------------------------------------------\n\n";
		}

		// Write to log
		$fp=fopen('log.txt','a');
		fwrite($fp, $text );
		fclose($fp);
	}
}