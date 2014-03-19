<?php
$data['MD'] = $_POST['MD'];
$data['PaRes'] = $_POST['PARes'];

$secure = new SecureAuth($data);
if($secure->status == 'success') {
	// transaction successful
} else {
	// an error has occurred. Process accordingly
}
?>