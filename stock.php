<?php require_once('Connections/Medical_record.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO stock (items_type, stock_left, Date_last_requested, staff_name) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['items_type'], "text"),
                       GetSQLValueString($_POST['stock_left'], "text"),
                       GetSQLValueString($_POST['Date_last_requested'], "text"),
                       GetSQLValueString($_POST['staff_name'], "text"));

  mysql_select_db($database_Medical_record, $Medical_record);
  $Result1 = mysql_query($insertSQL, $Medical_record) or die(mysql_error());

  $insertGoTo = "stock.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stock Products</title>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 24px;
}
.style2 {
	color: #0000FF;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>

<body>
<table width="1092" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="1092" height="85" valign="middle" bgcolor="#0000FF"><div align="center" class="style1">STOCK RECORD INFORMATION </div></td>
  </tr>
</table>
<table width="1092" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="1092" height="270" valign="top"> <div align="center" class="style2"><br />Kindly provide detail number of items in stock </div>
      <p>&nbsp;</p>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center">
          <!--DWLayoutTable-->
          <tr valign="baseline">
            <td width="119" height="24" align="center" valign="top" nowrap><strong>Items Type</strong></td>
            <td width="190"><input type="text" name="items_type" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td height="24" align="center" valign="top" nowrap><strong>Stock left</strong></td>
            <td><input type="text" name="stock_left" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td height="24" align="right" valign="top" nowrap><strong>Date last requested</strong></td>
            <td><input type="date" name="Date" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td height="24" align="center" valign="top" nowrap><strong>Staff name</strong></td>
            <td><input type="text" name="staff_name" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td height="43"></td>
            <td align="center" valign="bottom"><p>
              <input type="submit" value="Save record">
&nbsp;&nbsp;
<input type="button" name="Print" value="Print" onClick="javascript:window.print();" />
          &nbsp;
                  <input type="button" name="Close" value="Close" />
            </p>
            </td>
          </tr>
        </table>
        <div align="center">
          <p>
            <input type="hidden" name="MM_insert" value="form1">
            <a href="home.php">BACK TO HOME    
            </a>
          </p>
        </div>
      </form>      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="4"></td>
  </tr>
</table>
</body>
</html>
