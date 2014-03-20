<?php
$data = array();
$data['MD'] = $_POST['MD'];
$data['PAReq'] = $_POST['PaRes'];
$data['PaRes'] = $_POST['PaRes'];
$data['VendorTxCode'] = $_GET['VendorTxCode'];
$_SESSION['mdx'] = $_POST['MDX'];
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" type="text/css" href="images/directKitStyle.css">
  <title>3D-Secure Redirect</title>
  <script language="Javascript"> function OnLoadEvent() { document.form.submit(); } </script>
</head>

<body OnLoad="OnLoadEvent();">
  <form name="form" action="./3dComplete.php" method="POST"/>
    <input type="hidden" name="PARes" value="<?php echo $data['PaRes']; ?>"/>
    <input type="hidden" name="MD" value="<?php echo $data['MD']; ?>"/>
    <noscript>
      <center><p>Please click button below to Authorise your card</p><input type="submit" value="Go"/></p></center>
    </noscript>
  </form>
</body>
</html>
