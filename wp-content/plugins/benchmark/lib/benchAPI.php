<?php
class benchAPI {
	private $curlDataWritten = 0;
	private $curlContent = 0;
	private $lastCurlErrorNo = 0;
	public function __construct(){
	}
	public function call($func, $data = false){
		if(! $data){
			$data = array();
		}
		try {
			$data['func'] = $func;
			$json = $this->getURL('http://markmaunder.com/wpbench/bench.php', $data);
			if($json){
				return json_decode($json);
			} else {
				return false;
			}
		} catch(Exception $e){
			error_log("Exception: $e");
			return false;
		}
	}
	protected function getURL($url, $postParams = array()){
		if(function_exists('curl_init')){
			$this->curlDataWritten = 0;
			$this->curlContent = "";
			$curl = curl_init($url);
			curl_setopt ($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt ($curl, CURLOPT_USERAGENT, "BenchUA 1.0" );
			curl_setopt ($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt ($curl, CURLOPT_HEADER, 0);
			curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt ($curl, CURLOPT_WRITEFUNCTION, array($this, 'curlWrite'));
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postParams);
			
			$curlResult = curl_exec($curl);
			$httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			$this->lastCurlErrorNo = curl_errno($curl);
			if($httpStatus == 200){
				curl_close($curl);
				return $this->curlContent;
			} else {
				$cerror = curl_error($curl);
				curl_close($curl);
				throw new Exception("We received an error response when trying to contact the Wordfence scanning servers. The HTTP status code was [$httpStatus]" . ($cerror ? (' and the error from CURL was ' . $cerror) : ''));
			}
		} else {
			$data = $this->fileGet($url, $postParams);
			if($data === false){
				$err = error_get_last();
				if($err){
					throw new Exception("We received an error response when trying to contact the Wordfence scanning servers using PHP's file_get_contents function. The error was: " . $err);
				} else {
					throw new Exception("We received an empty response when trying to contact the Wordfence scanning servers using PHP's file_get_contents function.");
				}
			}
			return $data;
		}

	}
	public function curlWrite($h, $d){
		$this->curlContent .= $d;
		if($this->curlDataWritten > 10000000){ //10 megs
			return 0;
		} else {
			return strlen($d);
		}
	}
	private function fileGet($url, $postParams){
		$body = "";
		if(is_array($postParams)){
			$bodyArr = array();
			foreach($postParams as $key => $val){
				$bodyArr[] = urlencode($key) . '=' . urlencode($val);
			}
			$body = implode('&', $bodyArr);
		} else {
			$body = $postParams;
		}
		$opts = array('http' =>
				array(
					'method'  => 'POST',
					'content' => $body,
					'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
					'timeout' => 60
				     )
			     );
		$context = stream_context_create($opts);
		return @file_get_contents($url, false, $context, -1);
	}
}
?>
