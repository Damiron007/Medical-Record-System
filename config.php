<?
$dhost = "localhost"; // 
$dusername = "root"; // database user
$dpassword = "David "; // database pass
$ddatabase = "ckc_cms"; // database name
date_default_timezone_set;
error_reporting(0);

$con = mysql_connect($dhost, $dusername, $dpassword) or die("Cannot Connect"); 
mysql_select_db($ddatabase, $ckc_cms);



if($_COOKIE["username"] and $_COOKIE["password"])
{
$q = mysql_query("SELECT * FROM tb_user WHERE username='{$_COOKIE['username']}' AND password='{$_COOKIE['password']}'") or die(mysql_error());
if(mysql_num_rows($q) == 0)
{
$_COOKIE['username'] = false;
$_COOKIE['password'] = false;
} else {
$loggedin = 1;
$r = mysql_fetch_array($q);
}
}


if($_COOKIE["username"] and $_COOKIE["password"])
{
$q = mysql_query("SELECT * FROM settweb WHERE username='{$_COOKIE['username']}' AND password='{$_COOKIE['password']}'") or die(mysql_error());
if(mysql_num_rows($q) == 0)
{
$_COOKIE['username'] = false;
$_COOKIE['password'] = false;
} else {
$loggedin = 1;
}
}

?>