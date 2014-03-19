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


require_once 'sagepay/sagepay.class.php'; 

$data['TxType'] 		= 'Deferred';
$data['VendorTxCode'] 	= '';
$data['Amount'] 		= 500;
$data['Description'] 	= 'A box full of the most amazing designer clothes';


$sagepay = new Sagepay($data);
dump($sagepay); 




?>
