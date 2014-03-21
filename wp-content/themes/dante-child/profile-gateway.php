<?php
/**
*
* template name: Box Payment Gateway
*
**/


?>

<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_2'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	Going to Sagepay for a authorization of £500
	
	
	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>

<!-- <form action="https://test.sagepay.com/gateway/service/vspserver-register.vsp" method="POST" id="SagePayForm" name="SagePayForm"> -->
<form action="https://test.sagepay.com/gateway/service/vspform-register.vsp" method="POST" id="SagePayForm" name="SagePayForm">
<input type="hidden" name="navigate" value="" />
<input type="hidden" name="VPSProtocol" value="3.00" />
<input type="hidden" name="TxType" value="deferred" />
<input type="hidden" name="Vendor" value="Enclothedldt" />

<input type="hidden" name="Crypt" value="bwBaVAxCYR11X1QBCwIEHQlWGQJSHQRSGwECSQYHHQIMVgMHWwEBQ2RVVgFEQVVCcCEJQAJCQQtTQm8NUhVxXVYQWkReABtVBhZzEURBVV5aHAlXAUATIVNDUxZfQ0RZVgsJFjBFVgZTQ0MxZH8NSVYQRm8QWUEAaVZBAFhbRERJXxsfBl5WCVlEWAFSHVRVT0pAWAJeXjpPX0VCcFJZXEwXUWUxfAgcWUVCO0VaRFVmA0VUDVhBEUYKH0tTXVNcVhFcVQceUQBAH1MFWFBVXB8mQUMXX1gARH5RCVMOEBZqAFpUJn1UDFoNAEJ0WlxcUAtTdgpCRhFYUV0BRQ4WclAJWFkNV2YQRF5RCVMOFnJQCVhZDVd0AVJCVRdFAg0WewxYXApeUiZfRElZEHFZXFUMWlczX0YRdV9UAQsVcllVCV1eBHNaEFhEQh0LFXRVVQxCVRFJcwxEQ0QKV15VQwRDcFUPWUMAREljEURdUV1cWBJ0BlxcE1NCSSVSV0JVShYFDUV0UAlfRlUWT3BZREBYEnQGXFwTU0JJNFlARHNWAVENRXRQCV9GVRZPcF9FVxFGSV4WdAlaX0cjX1VEcVABCQBFcUUVWklxMmVwZgIEVRJxE0BZHAV0YwFVRkJVBFUScgpcWQxYV3EDRFZVXVwLQA1T" />
<input type="submit">
</form>
