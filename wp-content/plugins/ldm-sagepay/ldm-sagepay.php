<?php
/**
*
* Plugin Name: LDM WP Sagepay 
* Description: A custom built plugin to provide sagepay payment functionality
* Author: Like Digital Media
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Provides: ldm_sagepay
*
**/

/*
require_once 'sagepay-direct/sagepay.class.php'; 
$data['TxType'] 		= 'Deferred';
$data['VendorTxCode'] 	= 'enclothed';
$data['Amount'] 		= 500;
$data['Description'] 	= 'A box full of the most amazing designer clothes';
$data['Environment']	= 'DEVELOPMENT'; //DEVELOPMENT or anything else
$sagepay = new Sagepay($data);
$sagepay->execute();
dump($sagepay->status); 
dump($sagepay->error); 
*/

require_once 'sagepay.php'; 

$sagepay = new Sagepay();

if ( !function_exists( 'debug_log' ) ) {
	function debug_log( $msg, $status = 'DEBUG', $file = 'debug_log.txt' ) {
		$location = 
		$msg = gmdate( 'Y-m-d H:i:s' ) . ' - ' . $status . ' - ' .print_r( $msg, TRUE ) . "\n";
		file_put_contents( $file , $msg, FILE_APPEND);
	}
}

$t = $sagepay->form();
debug_log($t);



// <form action="http://test.sagepay.com/" method="POST" id="SagePayForm" name="SagePayForm">
// <input type="hidden" name="navigate" value="" />
// <input type="hidden" name="VPSProtocol" value="3.00" />
// <input type="hidden" name="TxType" value="deferred" />
// <input type="hidden" name="Vendor" value="Enclothedldt" />
// <input type="hidden" name="Crypt" value="bwBaVAxCYR11X1QBCwIEHQlWGQJSHQRSGwECSQYHHQIMVgMHWwEBQ2RVVgFEQVVCcCEJQAJCQQtTQm8NUhVxXVYQWkReABtVBhZzEURBVV5aHAlXAUATIVNDUxZfQ0RZVgsJFjBFVgZTQ0MxZH8NSVYQRm8QWUEAaVZBAFhbRERJXxsfBl5WCVlEWAFSHVRVT0pAWAJeXjpPX0VCcFJZXEwXUWUxfAgcWUVCO0VaRFVmA0VUDVhBEUYKH0tTXVNcVhFcVQceUQBAH1MFWFBVXB8mQUMXX1gARH5RCVMOEBZqAFpUJn1UDFoNAEJ0WlxcUAtTdgpCRhFYUV0BRQ4WclAJWFkNV2YQRF5RCVMOFnJQCVhZDVd0AVJCVRdFAg0WewxYXApeUiZfRElZEHFZXFUMWlczX0YRdV9UAQsVcllVCV1eBHNaEFhEQh0LFXRVVQxCVRFJcwxEQ0QKV15VQwRDcFUPWUMAREljEURdUV1cWBJ0BlxcE1NCSSVSV0JVShYFDUV0UAlfRlUWT3BZREBYEnQGXFwTU0JJNFlARHNWAVENRXRQCV9GVRZPcF9FVxFGSV4WdAlaX0cjX1VEcVABCQBFcUUVWklxMmVwZgIEVRJxE0BZHAV0YwFVRkJVBFUScgpcWQxYV3EDRFZVXVwLQA1T" />
// <input type="submit">
// </form>




?>
