<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unauthorized login</title>
<style type="text/css">
<!--
a {
	font-size: 14px;
	color: #FFF;
	font-weight: bold;
}
a:hover {
	color: #F00;
	text-decoration: underline;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
-->
</style></head>

<body>
<h2 align="center" class="style1">MEDICAL RECORD INFORMATION  MANAGEMENT SYSTEM RESTRICTED PAGE </h2>
<div align="center">
  <table width="793" height="347" border="1">
    <!--DWLayoutTable-->
    <tr>
      <td width="783" height="341" valign="top" bgcolor="#000066"><h2><font color="#FFFFFF">YOU ARE NOT PERMITTED TO VIEW THIS PAGE</font> </h2>
        <p>&nbsp;</p>
        <h2 align="center"><a href="login.php">Login </a></h2>
        <h2 align="center"><a href="index.php">Back to Home </a></h2>
      <p align="center">&nbsp;</p>        <p align="center" class="style2">Kindly consult administrator if you unable to login. Thank you. </p></td>
    </tr>
  </table>
</div>
<p align="center">© 2018 Copyright </p>
</body>
</html>