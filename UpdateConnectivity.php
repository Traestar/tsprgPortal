<?php
// UpdateConnectivity.php
require_once('auth.php');
include ("config.php");

mysql_connect( $db_host, $user, $password )
      or die( "Error! Could not connect to database: " . mysql_error() );

mysql_select_db( $db_name )
      or die( "Error! Could not select the database: " . mysql_error() );

$site_id=$_POST['site_id'];
$id=$_POST['id'];
$site=$_POST['site'];

if ($_POST['tp2']=='on') $tp2="X";
else $tp2="--";

if ($_POST['rack4']=='on') $rack4="X";
else $rack4="--";

if ($_POST['sp2']=='on') $sp2="X";
else $sp2="--";

if ($_POST['IIe']=='on') $IIe="X";
else $IIe="--";

if ($_POST['g1']=='on') $g1="X";
else $g1="--";

$id = $_SESSION['SESS_MEMBER_ID'];
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

if ($_POST['update']) {
   mysql_query("UPDATE connectivity SET site='$site', TP2='$tp2', 4th='$rack4', SP2='$sp2', 2E='$IIe', G1='$g1' WHERE id='$id'");
   $msg = "Updated Connectivity with ID:" ." " .$id .", " .$site .", " .$tp2 .", " .$rack4 .", " .$sp2 .", " .$IIe .", " .$g1;
}
elseif ($_POST['delete']) {
   mysql_query("DELETE FROM connectivity WHERE id='$id'");
   $msg = "Deleted Connection with ID:" ." " .$id;
}

logToFile("logs/$mdy.log", $msg, $mdy, $username);

?>

<html>
<head>
<title>Update Connectivity</title>
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
    <td bgcolor="#eeeeee" valign="top"> 
      <table width="780" cellspacing="0" cellpadding="5" align="center" border="0">
        <tr> 
	  <td valign="top" class="text"> 
	     <br>	
		<?php if ($_POST['update']) { ?>
		<table class="regtext" align="center" cellspacing="0" cellpadding="5" bgcolor="#ffffff"  style="border:thin solid #000000">
                  <tr><td bgcolor="#93BF96" align="center" colspan="3"><span class="largetext">Updated Following Radar Info</td></tr>
                  <tr>
                    <td>ID:</td>
		    <td><?php echo $id?></td>
                  </tr>
                  <tr>
		    <td>Facility:</td>
		    <td><?php echo $site;?></td>
		  </tr>
                  <tr>
                    <td>TP2:</td>
                    <td>
                      <?php
                        if ( $tp2=="X" ) $check="checked";
                        else $check="";
                        echo "<input type='checkbox' disabled='disabled' $check>";
                      ?>
                    </td>
                  <tr>
                    <td>4th:</td>
                    <td>
                      <?php
                        if ( $rack4=="X" ) $check="checked";
                        else $check="";
                        echo "<input type='checkbox' disabled='disabled' $check>";
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>SP2:</td>
                    <td>
                      <?php
                        if ( $sp2=="X" ) $check="checked";
                        else $check="";
                        echo "<input type='checkbox' disabled='disabled' $check>";
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td width="3">2E:</td>
                    <td>
                      <?php
                        if ( $IIe=="X" ) $check="checked";
                        else $check="";
                        echo "<input type='checkbox' disabled='disabled' $check>";
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td width="3">G1:</td>
                    <td>
                      <?php
                        if ( $g1=="X" ) $check="checked";
                        else $check="";
                        echo "<input type='checkbox' disabled='disabled' $check>";
                      ?>
                    </td>
                  </tr>
		</table>
		<?php }
                elseif ($_POST['delete']) {
		  echo "<tr><td align='center'><span class='largetext'>Deleted Data with ID: $id</td></tr>";
		} ?>
	  </td>
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
