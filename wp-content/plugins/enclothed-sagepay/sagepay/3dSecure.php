<?php
session_start();
?>
<html><head><title>3D Secure Verification</title></head>
<body>
  <form name="form" action="<?php echo $_SESSION['payment']['acsurl']; ?>" method="POST">
    <input type="hidden" name="PaReq" value="<?php echo $_SESSION['payment']['pareq']; ?>" />
    <input type="hidden" name="TermUrl" value="<?php echo SECURE_SITE . '/checkout/payment/3dCallback.php?VendorTxCode=' . $_SESSION['payment']['vendorTxCode']; ?>" />
    <input type="hidden" name="MD" value="<?php echo $_SESSION['payment']['md']; ?>" />
    <input type="submit" value="Proceed to 3D secure authentication" />
  </form>
  <script type="text/javascript">document.form.submit();</script>
</body>
</html>
