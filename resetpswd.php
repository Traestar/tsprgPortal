<?php
// resetpswd.php
require_once('auth.php');
include ("config.php");

mysql_connect( $db_host, $user, $password )
      or die( "Error! Could not connect to database: " . mysql_error() );

mysql_select_db( $db_name )
      or die( "Error! Could not select the database: " . mysql_error() );

/*
$site_id=$_POST['site_id'];
$site=$_POST['site'];
$f_name=$_POST['f_name'];
$l_name=$_POST['l_name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
 */
$user_id = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['username'];
$query_admin = "SELECT admin FROM users WHERE user_id='$user_id'";
$result_admin = mysql_query($query_admin);
$admin = mysql_fetch_array($result_admin);
$mdy = date("mdY");
$oldpswd = $_POST['oldpswd'];
$newpswd1 = $_POST['newpswd1'];
$newpswd2 = $_POST['newpswd2'];

//sets what menu user can see
if ($admin[0] == "admin"){
   $navbar = "navbar_admin.php";
}
else $navbar = "navbar_user.php";

function logToFile($filename,$msg, $date, $user) {
   $ip = $_SERVER['REMOTE_ADDR'];
   $time = date("H:i:s");
   $logmsg = $date. " ". $time. " ". $ip. " ". $user. " ". $msg;
   $fd = fopen($filename, "a");
   fwrite($fd, $logmsg . "\n");
   fclose($fd);
}

$query = "SELECT passwd FROM users WHERE user_id='$user_id'";
$result = mysql_query($query);
$dbpswd = mysql_fetch_array($result);

function updatePswd($pswd) {

   mysql_query("INSERT INTO `users` (passwd) VALUES ('$pswd')");  
}

//$msg = "Inserted Into Contacts:" ." " .$site_id .", " .$site .", " .$f_name .", " .$l_name .", " .$phone .", " .$email;

//logToFile("logs/$mdy.log", $msg, $mdy, $username);

?>

<html>
<head>
<title>Login to the SPRB Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/styles.css" type="text/css"/>
<link href="css/tables.css" rel="stylesheet" type="text/css"/>

</head>
<body bgcolor="#999999" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<table width="820" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr>
    <td height="75"><img src="images/banner.png"/></td>
  </tr>
  <tr> 
    <td height="22" colspan="2" bgcolor="#eeeeee"> 
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr><?php include ("$navbar"); ?> </tr>
      </table>
    </td>
  </tr>
</table>
<table width="820" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr> 
    <td bgcolor="#eeeeee" valign="top" align="center" class="regtext"> 
      <table width="780" height="30" cellspacing="0" cellpadding="5" align="center" border="0">
        <tr align="center" > 
	   <?php
              if ($dbpswd[0] == md5($oldpswd) && $newpswd1 == $newpswd2) {
		 $newpswd=md5($newpswd1);
		 mysql_query("UPDATE Users SET passwd='$newpswd' WHERE user_id='$user_id'");
		 echo "<br>" ."Your Password Has Been Updated!";
	         logToFile("logs/$mdy.log", "Changed password", $mdy, $username);
	      }
	      else {
		 echo "<br>" ."Your Passwords Do Not Match. Please Try Again.";
		 logToFile("logs/$mdy.log","Failed attempt to change password", $mdy, $username);
	      }
	   ?>

        </tr>
    </td>
  </tr>
</table>
<table width="820" cellspacing="0" cellpadding="0" height="40" border="0" align="center">
  <tr> 
    <td bgcolor="#93BF96" height="24" class="text" align="center">Designed and Maintained by Terminal Simulation Group (TSG)</td>
  </tr>
</table>
</body>
</html>
