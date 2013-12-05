<?php
// main.php
require_once('auth.php');
include ("config.php");

mysql_connect( $db_host, $user, $password )
      or die( "Error! Could not connect to database: " . mysql_error() );

mysql_select_db( $db_name )
      or die( "Error! Could not select the database: " . mysql_error() );

$user_id = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['username'];
$query_admin = "SELECT admin FROM users WHERE user_id='$user_id'"; 
$result_admin = mysql_query($query_admin);
$admin = mysql_fetch_array($result_admin);
$mdy = date("mdY");
 
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

?>

<html>
<head>
<title>TSG Site Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/styles.css" type="text/css">
</head>
<body bgcolor="#999999" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<table width="820" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr>
    <td height="75"><img src="images/banner.png"/></td>
  </tr>
  <tr> 
    <td height="22" colspan="2" bgcolor="#eeeeee" > 
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr><?php include ("$navbar"); ?> </tr> 
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
              <span class="title">Welcome to the Terminal Simulation Group Site Database</span></p>
            <p>Please select below to begin your search:</p>
          </td>
	</tr>
        <tr>
	  <td>
            <table align="center" cellspacing="0" cellpadding="5" bgcolor="#ffffff" width="350" style="border:thin solid #000000">
              <tr><td bgcolor="#93BF96" align="center" colspan="3"><span class="largetext">Make a Selection to Search for Results</select></td></tr>
              <tr>
                <form action="results.php" method="post" name"srchresults">
                  <td>
                    <select name="site[]" multiple="multiple" size="7">
                       <option value="all">All Sites
                       <?php
                         $query = "SELECT DISTINCT `site_id` FROM `site_ids` ORDER BY `site_id` ASC";
                         $results = mysql_query( $query );
                           if( $results) {
                             while( $sp = mysql_fetch_object( $results ) ) {
                               echo "<option value=\"$sp->site_id\">$sp->site_id";
                             }
                           }
                       ?>
                    </select>
                  </td>
                  <td class="tbtext">
                    <input type="radio" name="srchradio" value="siteinfo">Site Info
                    <br>
                    <input type="radio" name="srchradio" value="hwinfo">Hardware Info
                    <br>
		    <input type="radio" name="srchradio" value="pocinfo">Contact Info
                    <br>
		    <input type="radio" name="srchradio" value="swver">Software Version
		    <br>
		    <input type="radio" name="srchradio" value="radar">Radar Info
		    <br>
		    <input type="radio" name="srchradio" value="connect">Site Connectivity
                  </td>
                  <td valign="bottom"><input type="submit" name="submit" value="Search"></td>
                </form>
              </tr>
            </table>
          <td>
        </tr>
      </table>
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
