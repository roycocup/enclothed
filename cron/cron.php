<?php 
require_once(dirname(__FILE__).'/wp-bootstrap.php');



// check what cron jobs need doing
class Cronjobs extends db{

	public $table = 'wp_duck_cron';
	
	
	public function __construct(){
		parent::__construct();
		
	}


	public function log_it( $msg, $status = 'CRON', $file = 'debug_log.txt' ) {
		$location = 
		$msg = gmdate( 'Y-m-d H:i:s' ) . ' - ' . $status . ' - ' .print_r( $msg, TRUE ) . "\n\r";
		print_r($msg);
		file_put_contents( $file , $msg, FILE_APPEND);
	}


	public function sendDigestEmails(){
		
	}

}

$cron = new Cronjobs();

?>
