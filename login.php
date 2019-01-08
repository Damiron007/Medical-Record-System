<?php require_once('Connections/Medical_record.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "access_denied.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Medical_record, $Medical_record);
  
  $LoginRS__query=sprintf("SELECT username, password FROM users WHERE username='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $Medical_record) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGIN PAGE FOR MEDICAL INFORMATION MANAGAMENT SYSTEM</title>
<style type="text/css">
<!--
body {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	background: #666666;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
	background-color: #333333;
}
.oneColFixCtrHdr #container {
	width: 780px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.oneColFixCtrHdr #header {
	padding: 0 10px 0 20px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
	background-color: #FFFFFF;
}
.oneColFixCtrHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.oneColFixCtrHdr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
	background: #FFFFFF;
}
.oneColFixCtrHdr #footer {
	padding: 0 10px;
	color: #FFFFFF;
	background-color: #0000FF;
}
.oneColFixCtrHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
	background-color: #0000FF;
}
-->
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #333333}
-->
</style>
</head>

<body class="oneColFixCtrHdr">

<div id="container">
  <div id="header">
    <h2 align="center" class="style1">WELCOME TO MEDICAL RECORD INFROMATION MANAGEMENT SYSTEM </h2>
    <h2 align="center" class="style2">STAFF LOGIN</h2>
<!-- end #header --></div>
<div id="mainContent">
<form ACTION="<?php echo $loginFormAction; ?>" method="POST" name="loginform" id="loginform" onsubmit="MM_validateForm('User name','','R');return document.MM_returnValue">
      <p><span id="sprytextfield1">
        <label><strong><br />
        <br />
        <br />
        User name</strong>
        <input name="Username" type="text" id="Username" accesskey="1" size="20" maxlength="20" />
      </label>
      </span></p>
      <p>
        <label><strong>Password</strong>        <span id="sprypassword1">
          <input name="password" type="password" id="password" size="20" maxlength="20" />
          </span></label>
    </p>
    <p>    
    <p>
    <p>
    <label>
          <div align="center">
      <input name="Submit" type="submit" id="Submit" onclick="MM_validateForm('User name','','R','password1','','R');return document.MM_returnValue" value="Login" />
    </label>
    <p>BACK TO <a href="index.php">HOMEPAGE </a></p>
</form>
    <h3>&nbsp;</h3>
<h2>&nbsp;</h2>
  <p>&nbsp;</p>
  <p>
    <!-- end #mainContent -->
  </p>
  <p>&nbsp;</p>
</div>
<div id="footer">
    <p align="center">Copyright @ 2018</p>
</div>
<!-- end #container -->
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($Medical_record.php);
?>
<?php
