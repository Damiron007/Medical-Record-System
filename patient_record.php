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
  $insertSQL = sprintf("INSERT INTO patient_record (Patient_Name, Sex, Amount, Age, `Date`, Type_of_test, Patient_id, Phone_Number, Report) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Patient_Name'], "text"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Amount'], "text"),
                       GetSQLValueString($_POST['Age'], "text"),
                       GetSQLValueString($_POST['Date'], "text"),
                       GetSQLValueString($_POST['Type_of_test'], "text"),
                       GetSQLValueString($_POST['Patient_id'], "text"),
                       GetSQLValueString($_POST['Phone_Number'], "text"),
                       GetSQLValueString($_POST['Report'], "text"));

  mysql_select_db($database_Medical_record, $Medical_record);
  $Result1 = mysql_query($insertSQL, $Medical_record) or die(mysql_error());

  $insertGoTo = "patient_record.php";
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
<title>Patient Record</title>
<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	color: #FFFFFF;
	font-weight: bold;
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
.style2 {
	font-size: 18px;
	font-weight: bold;
}
.style3 {
	color: #0000FF;
	font-size: 20px;
}
-->
</style>
</head>

<body>
<table width="1082" border="0" cellpadding="0" cellspacing="0" bgcolor="#0000FF">
  <!--DWLayoutTable-->
  <tr>
    <td width="149" height="62">&nbsp;</td>
    <td width="923" align="center" valign="middle"><div align="center"><span class="style1">PATIENT RECORD INFORMATION SYSTEM</span> </div></td>
  <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td align="center" valign="middle"><font color="white">
	<script language="JavaScript" type="text/javascript"> 
			 document.write(TODAY);	   </script></font></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="1024" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="4" height="443">&nbsp;</td>
    <td width="976" valign="top"><p align="center">&nbsp;</p>
      <p align="center" class="style2 style3">Kindly enter Patient record information </p>
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      
        <div align="center">
          <table align="center">
            <!--DWLayoutTable-->
            <tr valign="baseline">
              <td width="144" height="24" align="center" valign="top" nowrap><strong>Patient Name</strong></td>
              <td width="307" valign="top"><input type="text" name="Patient_Name" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap> <strong>Gender</strong></td>
                <td valign="baseline"><select name="Sex" id="Sex">
                  <option value="">Select...</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Amount:</strong></td>
              <td valign="top"><input type="text" name="Amount" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Age</strong></td>
              <td valign="top"><input type="text" name="Age" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Date</strong></td>
              <td valign="top"><input type="date" name="Date" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Type of Medical test:</strong></td>
              <td valign="top">
                <select name="Type_of_test" id="Type_of_test">
                  <option value="" selected="selected">Select...</option>
                  <option value="Pelvis">Pelvis</option>
                  <option value="Pregnancy">Pregnancy</option>
                  <option value="Prostrate">Prostrate</option>
                  <option value="Thyroid">Thyroid</option>
                  <option value="Malaria">Malaria</option>
                  <option value="HBP">High Blood presure</option>
                  <option value="None">None</option>
              </select>              </td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Patient ID</strong></td>
              <td valign="top"><input type="text" name="Patient_id" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Phone Number</strong></td>
              <td valign="top"><input type="text" name="Phone_Number" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="24" align="center" valign="top" nowrap><strong>Report</strong></td>
              <td valign="top"><input type="text" name="Report" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="50"></td>
              <td align="center" valign="top"><p>
                <input type="submit" value="Save record">
&nbsp;&nbsp;
                    <p align="center"><input type="button" name="Print" value="Print" onClick="javascript:window.print();" />
                  <input name="Print receipt" type="button" value="Print reciept" onClick="parent.open('patient_print.php')"/>
                  &nbsp;
                  <input type="button" name="Close" value="Close" />
                </p>              </td>
            </tr>
          </table>
          </p>
          
          <input type="hidden" name="MM_insert" value="form1">
          <a href="home.php"><strong>HOME</strong></a> | <a href="patient_record_summary.php"><strong>RECORD 
            SUMMARY</strong></a></div>
      </form>      <p align="center">&nbsp;</p></td>
  <td width="44">&nbsp;</td>
  </tr>
</table>
</body>
</html>
