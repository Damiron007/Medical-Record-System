<?php require_once('Connections/ckc_db.php'); ?>
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

$MM_restrictGoTo = "index.php";
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
?>
<?php
	$query = "Select Max(Serial_Number) From nominal_role";
	$returnD = mysql_query($query);
	$result = mysql_fetch_assoc($returnD);
	Print mysql_error();
	$maxRows = $result['Max(Serial_Number)'];
  if(empty($maxRows)){
	    $lastRow = $maxRows + 1;       
    }else{
		$lastRow = $maxRows + 0001 ;
    }
?>
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
  $insertSQL = sprintf("INSERT INTO nominal_role (Serial_Number, Name_of_Parishioner, Gender, Address, Phone_number, Occupation, Marital_status, Children, Socieites, State_origin, Date_of_birth) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Serial_Number'], "int"),
                       GetSQLValueString($_POST['Name_of_Parishioner'], "text"),
					   GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['Phone_number'], "text"),
                       GetSQLValueString($_POST['Occupation'], "text"),
					   GetSQLValueString($_POST['Marital_status'], "text"),
                       GetSQLValueString($_POST['Children'], "text"),
                       GetSQLValueString($_POST['Socieites'], "text"),
                       GetSQLValueString($_POST['State_origin'], "text"),
                       GetSQLValueString($_POST['Date_of_birth'], "text"));

  mysql_select_db($database_ckc_db, $ckc_db);
  $Result1 = mysql_query($insertSQL, $ckc_db) or die(mysql_error());

  $insertGoTo = "nominal_role.php";
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
<title>NOMINAL ROLE</title>
</head>

<body>
<div align="center">
  <table width="780" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr>
      <td height="54" colspan="4" valign="top" bgcolor="#FFFFFF"><div align="center">
        <h2 align="center" class="style1">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;NOMINAL RECORD </h2>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table align="center">
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Serial Number:</div></td>
              <td><input type="text" readonly="True" name="Serial_Number" value= "<?php if(!empty($lastRow)){ echo sprintf("%04d", $lastRow); }?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Name of Parishioner:</td>
              <td><input type="text" name="Name_of_Parishioner" value="" size="32"></td>
            </tr>
			<tr valign="baseline">
              <td nowrap align="right"><div align="left">Gender:</div></td>
              <td><select name="Gender" id="Gender">
			  <option value="">Select...</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
			  </select></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Address:</div></td>
              <td><input type="text" name="Address" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Phone number:</div></td>
              <td><input type="text" name="Phone_number" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Occupation:</div></td>
              <td><input type="text" name="Occupation" value="" size="32"></td>
            </tr>
			<tr valign="baseline">
              <td nowrap align="right"><div align="left">Marital status:</div></td>
              <td><select name="Marital_status" id="Marital_status">
			  <option value="">Select...</option>
              <option value="Married">Married</option>
              <option value="Single">Single</option>
              <option value="Widowed">Widowed</option>
			  <option value="None">None</option>
			  </select></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Children:</div></td>
              <td><input type="text" name="Children" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Socieites:</div></td>
              <td>
			  <select name="Socieites" id="Socieites">
			  <option value="" selected="selected">Select...</option>
              <option value="Catholic Biblical Institute Union">CBIU</option>
              <option value="Charasmatic Renewal">Charasmatic Renewal</option>
			  <option value="Catholic Men Organization">Catholic Men Organization</option>
              <option value="Catholic Women Organization">Catholic Women Organization</option>
			  <option value="Catholic Youth Organization">Catholic Youth Organization</option>
              <option value="Blue army">Blue army</option>
			  <option value="Legion of Mary">Legion of Mary</option>
              <option value="Altar Servers Association">Altar Servers Association</option>
			  <option value="Lay readers">Lay readers</option>
              <option value="Guild of St Anthony">Guild of St Anthony</option>
			  <option value="St Jude society">St Jude society</option>
			  <option value="CCD">CCD</option>
              <option value="Young Catholic Students">Young Catholic Students</option>
			  <option value="Choir">Choir</option>
              <option value="Man of Order & Discipline">Man of Order & Discipline</option>
			  <option value="League of Sacred Heart of Jesus">League of Sacred Heart of Jesus</option>
              <option value="St. Vincent de Paul">St. Vincent de Paul</option>
			  <option value="Block Rosary Crusade">Block Rosary Crusade</option>
              <option value="Mary League Girls">Mary League Girls</option>
			  <option value="Fr. Tansi Solidarity Movement">Fr. Tansi Solidarity Movement</option>
              <option value="None">None</option>
			  </select>
			  </td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">State origin:</div></td>
              <td>
			  <select name="State_origin" id="State_origin">
			  <option value="" selected="selected">Select...</option>
              <option value="Abia">Abia</option>
              <option value="Adamawa">Adamawa</option>
			  <option value="Akwa Ibom">Akwa Ibom</option>
              <option value="Anambra">Anambra</option>
			  <option value="Bauchi">Bauchi</option>
              <option value="Bayelsa">Bayelsa</option>
			  <option value="Benue">Benue</option>
              <option value="Borno">Borno</option>
			  <option value="Cross River">Cross River</option>
              <option value="Delta">Delta</option>
			  <option value="Ebonyi">Ebonyi</option>
			  <option value="Enugu">Enugu</option>
              <option value="Edo">Edo</option>
			  <option value="Ekiti">Ekiti</option>
              <option value="FCT">FCT</option>
			  <option value="Gombe">Gombe</option>
              <option value="Imo">Imo</option>
			  <option value="Jigawa">Jigawa</option>
              <option value="Kaduna">Kaduna</option>
			  <option value="Kano">Kano</option>
              <option value="Katsina">Katsina</option>
			  <option value="Kebbi">Kebbi</option>
              <option value="Kogi">Kogi</option>
			  <option value="Kwara">Kwara</option>
              <option value="Lagos">Lagos</option>
			  <option value="Nasarawa">Nasarawa</option>
              <option value="Niger">Niger</option>
			  <option value="Ogun">Ogun</option>
              <option value="Ondo">Ondo</option>
			  <option value="Osun">Osun</option>
              <option value="Oyo">Oyo</option>
			  <option value="Plateau">Plateau</option>
              <option value="Rivers">Rivers</option>
			  <option value="Sokoto">Sokoto</option>
              <option value="Taraba">Taraba</option>
			  <option value="Yobe">Yobe</option>
              <option value="Zamfara">Zamfara</option>
			  <option value="Non-Nigerian">Non-Nigerian</option>
			  </select>
			  </td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right"><div align="left">Date of birth:</div></td>
              <td><input type="date" name="Date_of_birth" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">&nbsp;</td>
              <td><input type="submit" value="Save record"></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1">
        </form>
        <p align="center"><a href="home.php">MENU</a> |<a href="nominal_role_record.php"> NOMINAL RECORD </a></p>
        <p align="center" class="style1">&nbsp;</p>
	  <td></td>
    </tr>
</table>
</body>
</html>
