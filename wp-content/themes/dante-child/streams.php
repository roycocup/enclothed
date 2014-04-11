<?php
/**
*
* Template Name: Streams 
*
**/

// $streams = new ldmStreams();
$ws = new ldmwebservices();

// $form = $ws->getForm();

// $form = array_flip($form);

// foreach ($form as $key => &$value) {
// 	$value = 'notused';
// }

//$ws->renderFullForm();

$fields = array();



$fields['customerId'] 				= '98669';
$fields['orderReferenceNumber'] 	= '23423';
$fields['firstName'] 				= 'yourname';
$fields['lastName'] 				= 'lastnamemaman';
$fields['addressLine1'] 			= 'add_1';
$fields['addressLine2'] 			= 'nothinghere';
$fields['townCity'] 				= 'London';
$fields['Email'] 					= 'rod@likedigitalmedia.com';
$fields['postcode'] 				= 'e16ql';
$fields['telephone'] 				= '36345643565463';
$fields['password'] 				= 'thisisanicepass';
$fields['occupation'] 				= 'somestuff';
$fields['dob'] 						= '1976-09-10';
$fields['forceLead'] 				= 'true';

// echo $ws->getCustomForm($fields);
echo $ws->sendForm($fields);

?>



