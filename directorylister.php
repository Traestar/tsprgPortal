<?php
// blank.php

require_once('auth1.php');
include ("config.php");

mysql_connect( $db_host, $user, $password )
      or die( "Error! Could not connect to database: " . mysql_error() );

mysql_select_db( $db_name )
      or die( "Error! Could not select the database: " . mysql_error() );

$un = $_SESSION['UserName'];

$user_id = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['UserName'];
$query_admin = "SELECT AdminRights FROM Users WHERE id='$user_id'";
$result_admin = mysql_query($query_admin);
$admin = mysql_fetch_array($result_admin);
$mdy = date("mdY");

if ($admin[1] != "admin"){
   header("location: access-denied.php");
}

//sets what menu user can see
if ($admin[1] == "admin"){
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

?>

<html>
<head>
<title>Surveillance Performance and Registration Baseline (SPRB)</title>
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
         <tr><?php include ("navbar_admin.php"); ?> </tr>
      </table>
    </td>
  </tr>
</table>
<table width="820" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr> 
    <td bgcolor="#eeeeee" height="250" valign="top"> 
      <table width="780" cellspacing="0" cellpadding="5" align="center" border="0">
        <tr>
	<td valign="top" class="text"> 
            <p><br>
              <span class="title">Action Items</span></p>
		<?php
		// open the current directory
		$dhandle = opendir('Action%20Items');
		// define an array to hold the files
	        $files = array();

		if ($dhandle) {
		   // loop through all of the files
		   while (false !== ($fname = readdir($dhandle))) {
		      // if the file is not this file, and does not start with a '.' or '..',
		      // then store it for later display
		      if (($fname != '.') && ($fname != '..') && ($fname != basename($_SERVER['PHP_SELF']))) {
			 // store the filename
			 $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
		      }
		   }
		   // close the directory
		   closedir($dhandle);
		}
		sort ($files);
		foreach($files as $fname) {
	           echo "<a href='/tsprgPortal/Action%20Items/$fname'>$fname <br>";
		}
		?>
 
            <p><br>
              <span class="title">Logs</span></p>
		<?php
		// open the current directory
		$dhandle = opendir('logs');
		// define an array to hold the files
	        $files = array();

		if ($dhandle) {
		   // loop through all of the files
		   while (false !== ($fname = readdir($dhandle))) {
		      // if the file is not this file, and does not start with a '.' or '..',
		      // then store it for later display
		      if (($fname != '.') && ($fname != '..') && ($fname != basename($_SERVER['PHP_SELF']))) {
			 // store the filename
			 $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
		      }
		   }
		   // close the directory
		   closedir($dhandle);
		}
		sort ($files);
		foreach($files as $fname) {
	           echo "<a href='../../../../tsprgPortal/logs/$fname'>$fname <br>";
		}
		?>
	  </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table width="820" cellspacing="0" cellpadding="0" height="40" border="0" align="center">
  <tr> 
    <td bgcolor="#93BF96" height="24" class="text" align="center">Designed and Maintained by Terminal Surveillance & Registration Group (TSPRG)</td>
  </tr>
</table>
</body>
</html>
