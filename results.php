<?php
// results.php
require_once('auth.php');
include ("config.php");

mysql_connect( $db_host, $user, $password )
      or die( "Error! Could not connect to database: " . mysql_error() );

mysql_select_db( $db_name )
      or die( "Error! Could not select the database: " . mysql_error() );

$user_id = $_SESSION['SESS_MEMBER_ID'];
$query_admin = "SELECT admin FROM users WHERE user_id='$user_id'";
$result_admin = mysql_query($query_admin);
$admin = mysql_fetch_array($result_admin);

if ($admin[0] == "admin"){
      $navbar = "navbar_admin.php";
}
else $navbar = "navbar_user.php";

$site_id_array=$_POST['site'];
$site_id = "'" .implode("','",$site_id_array) ."'";
$srchradio=$_POST['srchradio'];
$srchedit=$_POST['srchedit'];

function searchResults($srchradio, $site_id) {

 // get site info results 
 if ($srchradio=='siteinfo') {
  if($site_id=="'all'") {
    $result = mysql_query("SELECT `id`, `site`, `ip`, `mac`, `license`, `notes` FROM `sites` ORDER BY `site`");
    if (!$result) {
      die("No Data found for $site_id " . mysql_error() );
    }
  }
  else {
    $result = mysql_query("SELECT `id`, `site`, `ip`, `mac`, `license`, `notes` FROM `sites` WHERE `site_id` IN($site_id) ORDER BY `site`");
    if (!$result) {
      die("No Data found for $site_id " . mysql_error() );
    }
  }
 }

 // get hw info results
 elseif ($srchradio=='hwinfo') {
  if($site_id=="'all'") {
    $result = mysql_query("SELECT `id`, `facility`, `machine_type`, `slack_version`, `kernel`, `sdrr_version`,
      `processor`, `memory`, `harddrive`, `optical_drives` FROM `overview` ORDER BY `facility`");
    if (!$result) {
      die("No Data found for $site_id " . mysql_error() );
    }
  }
  else {
    $result = mysql_query("SELECT `id`, `facility`, `machine_type`, `slack_version`, `kernel`, `sdrr_version`,
      `processor`, `memory`, `harddrive`, `optical_drives` FROM `overview` WHERE `site_id` IN($site_id) ORDER BY `facility`");
    if (!$result) {
      die("No Data found for $site_id " . mysql_error() );
    }
  }
 }

 // get poc info results
 elseif ($srchradio=='pocinfo') {
  if($site_id=="'all'") {
    $result = mysql_query("SELECT `id`, `site`, `f_name`, `l_name`, `phone`, `email` FROM `POC` ORDER BY `site`");
    if (!$result) {
      die("No Data found for $site_id " . mysql_error() );
    }
  }
  else {
    $result = mysql_query("SELECT `id`, `site`, `f_name`, `l_name`, `phone`, `email` FROM `POC` WHERE `site_id` IN($site_id) ORDER BY `site`");
    if (!$result) {
      die("No Data found for $site_id " . mysql_error() );
    }
  }
 }

 // get sw version results
 elseif ($srchradio=='swver') {
  if($site_id=="'all'") {
     $result = mysql_query("SELECT `id`, `site`, `sdrr`, `avid`, `gsgt` FROM `sw` ORDER BY `site`");
     if (!$result) {
	die("No Data found for $site_id " . mysql_error() );
     }
  }
  else {
     $result = mysql_query("SELECT `id`, `site`, `sdrr`, `avid`, `gsgt` FROM `sw` WHERE `site_id` IN($site_id) ORDER BY `site`");
     if (!$result) {
        die("No Data found for $site_id " . mysql_error() );
     }
  }
 }

 // get radar info results
 elseif ($srchradio=='radar') {
  if($site_id=="'all'") {
     $result = mysql_query("SELECT `id`, `site`, `radar`, `type`, `channels` FROM `radars` ORDER BY `site`");
     if (!$result) {
        die("No Data found for $site_id ". mysql_error() );
     }
  }
  else {
     $result = mysql_query("SELECT `id`, `site`, `radar`, `type`, `channels` FROM `radars` WHERE `site_id` IN($site_id) ORDER BY `site`");
     if (!$result) {
	die("No Data found for $site_id " . mysql_error() );
     }
  }
 }

 // get connectivity results
 elseif ($srchradio=='connect') {
  if($site_id=="'all'") {
     $result = mysql_query("SELECT `id`, `site`, `TP2`, `4th`, `SP2`, `2E`, `G1` FROM `connectivity` ORDER BY `site`");
     if (!$result) {
	die("No Data found for $site_id ". mysql_error() );
     }
  }
  else {
     $result = mysql_query("SELECT `id`, `site`, `TP2`, `4th`, `SP2`, `2E`, `G1` FROM `connectivity` WHERE `site_id` IN($site_id) ORDER BY `site`");
     if (!$result) {
	die("No Data found for $site_id " . mysql_error() );
     }
  }
 }

 return $result;
}

$result=searchResults($srchradio, $site_id);

?>

<html>
<head>
<title>SDRR/GSGT Site Database</title>
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
	  <td valign="top" class="headertext"> 
            <table align="center" border="0">
	      <?php
	      // Error checking

	      if ($srchradio==''){
		 echo "Please make a selection to search for!";
	      }
	      elseif ($site_id=="''"){
		 echo "Please select a site to search for!";
	      }

	      //prints results for site info
	      elseif ($srchradio=='siteinfo') {
	      ?>
                <tr><td align="center"><h1 class="titletext">SDRR Site Info</h1></td></tr>
                <tr><td>
                  <table align="center" cellpadding="2" border="1" style="empty-cells:show" >
                    <tr height="35" align="center">
                      <th bgcolor="#93BF96" width="35">ID</th>
                      <th bgcolor="#93BF96" width="100">Site</th>
                      <th bgcolor="#93BF96" width="100">IP Address</th>
                      <th bgcolor="#93BF96" width="100">MAC Address</th>
                      <th bgcolor="#93BF96" width="100">License</th>
                      <th bgcolor="#93BF96" width="300">Notes</th>
                    </tr>
              <?php
              }
              //prints results for hardware info
	      elseif ($srchradio=='hwinfo') {
              ?>
                <tr><td align="center"><h1 class="titletext">SDRR Site Hardware Info</h1></td></tr>
                <tr><td>
                  <table align="center" border="1" cellpadding="5" style="empty-cells:show">
                    <tr height="35" align="center">
                      <th bgcolor="#93BF96" width="35">ID</th>
                      <th bgcolor="#93BF96" width="150">Site</th>
                      <th bgcolor="#93BF96" width="100">Machine Type</th>
                      <th bgcolor="#93BF96" width="100">Slack Version</th>
                      <th bgcolor="#93BF96">Kernel</th>
                      <th bgcolor="#93BF96" width="100">SDRR Version</th>
                      <th bgcolor="#93BF96" width="150">Processor</th>
                      <th bgcolor="#93BF96">RAM</th>
                      <th bgcolor="#93BF96">Hard Drive</th>
                      <th bgcolor="#93BF96">Optical Drives</th>
                    </tr>
              <?php
	      }
              //prints results for sw version
	      elseif ($srchradio=='swver') {
	      ?>
		 <tr><td align="center"><h1 class="titletext">Software Version</h1></td></tr>
  		 <tr><td>
		   <table align="center" border="1" cellpadding="5" style="empty-cells:show">
		     <tr height="35" align="center">
                       <th bgcolor="#93BF96" width="35">ID</th>
                       <th bgcolor="#93BF96" width="150">Site</th>
                       <th bgcolor="#93BF96" width="75">SDRR</th>
                       <th bgcolor="#93BF96" width="75">AViD</th>
		       <th bgcolor="#93BF96" width="75">GSGT</th>
		     </tr>
	       <?php
	      }
	      //prints results for Radar info
	      elseif ($srchradio=='radar') {
	      ?>
                  <tr><td align="center"><h1 class="titletext">Radar Configuration</h1></td></tr>
                 <tr><td>
                   <table align="center" border="1" cellpadding="5" style="empty-cells:show">
                     <tr height="35" align="center">
                       <th bgcolor="#93BF96" width="35">ID</th>
                       <th bgcolor="#93BF96" width="150">Site</th>
                       <th bgcolor="#93BF96" width="75">Radar</th>
                       <th bgcolor="#93BF96" width="75">Type</th>
                       <th bgcolor="#93BF96" width="75">Channels</th>
                     </tr>
               <?php
              }
              //prints results for POC
	      elseif ($srchradio=='pocinfo') {
              ?>
                <tr><td align="center"><h1 class="titletext">SDRR Point of Contacts</h1></td></tr>
                <tr><td>
                  <table align="center" border="1" cellpadding="5" style="empty-cells:show">
                    <tr height="35" align="center">
                      <th bgcolor="#93BF96" width="35">ID</th>
                      <th bgcolor="#93BF96">Site</th>
                      <th bgcolor="#93BF96">First Name</th>
                      <th bgcolor="#93BF96">Last Name</th>
                      <th bgcolor="#93BF96">Phone</th>
                      <th bgcolor="#93BF96">Email</th>
                    </tr>
              <?php
	      }
	      // print results for connectivity
	      elseif ($srchradio=='connect') {
              ?>
		<tr><td align="center"><h1 class="titletext">Site Connectivity </h1></td></tr>
		<tr><td>
		  <table align="center" border="1" cellpadding="5" style="empty-cells:show">
		    <tr height="35" align="center">
		      <th bgcolor="#93BF96" width="35">ID</th>
		      <th bgcolor="#93BF96">Site</th>
		      <th bgcolor="#93BF96">TP2</th>
		      <th bgcolor="#93BF96">4th</th>
		      <th bgcolor="#93BF96">SP2</th>
		      <th bgcolor="#93BF96" width="30">2E</th>
		      <th bgcolor="#93BF96" width="30">G1</th>
		    </tr>
              <?php
	      }

              $color = "#DCEDEA";
              //print rows   #AFC7C7 
              while($row = mysql_fetch_row($result))
		{
		echo "<tr>";
                if ( $color == "#FAF8CC" ) $color = "#DCEDEA";
                else if ( $color == "#DCEDEA" ) $color = "#FAF8CC";
		  foreach($row as $cell)
                    echo "<td align='center' class='tbtext' bgcolor=$color>$cell</td>";
                    echo "</tr>\n";
                }
	      ?>
            </table>
	  </td>
	</tr>

    <?php if ($admin[0] == "admin") {  // Updates Site Info Data 
     
      if ($srchradio=='siteinfo') { ?>
	<tr><td colspan="5"><h1 class="titletext">Update Site Info</h1></td></tr>
	<tr><td class="largetext">Enter the ID from above to update or delete that entry</td></tr>
	<form action="UpdateSiteInfo.php" method="post" name="updateSite">
         <table align="center" cellpadding="2" border="1" style="empty-cellis:show" >
  	   <tr height="35" align="center">
             <th bgcolor="#93BF96" width="35">ID</th>
             <th bgcolor="#93BF96" width="100">Site</th>
             <th bgcolor="#93BF96" width="100">IP Address</th>
             <th bgcolor="#93BF96" width="130">MAC Address</th>
             <th bgcolor="#93BF96" width="100">License</th>
             <th bgcolor="#93BF96" width="300">Notes</th>
           </tr>
	   <tr>	
	     <td><input type="text" size="1" name="id"></td>      
	     <td><input type="text" size="10" name="site"></td>      
	     <td><input type="text" size="10" name="ip"></td>      
	     <td><input type="text" size="10" name="mac"></td>      
	     <td><input type="text" size="10" name="license"></td>
	     <td><input type="text" size="30" name="notes"></td>
	   </tr>
	   <tr>
	     <td colspan="6" align="center">
	        <input type="submit" value="Update" name="update" onClick="return (confirm('Are you sure you want to update the entry?'))">
		<input type="submit" value="Delete" name="delete" onClick="return (confirm('Are you sure you want to delete the entry?'))">
	     </td>
           </tr>
         </table>
        </form>	
    <?php } // Ends if ($srchradio=='siteinfo')
      elseif ($srchradio=='hwinfo') { ?>
	<tr><td colspan="5" style="text"><h1 class="titletext">Update Site Hardware Info</h1></td></tr>
        <tr><td class="largetext">Enter the ID from above to update or delete that entry</td></tr>
	<form action="UpdateHardware.php" method="post" name="updateHW">
         <table align="center" cellpadding="2" border="1" style="empty-cellis:show" >
           <tr height="35" align="center">
             <th bgcolor="#93BF96" width="35">ID</th>
             <th bgcolor="#93BF96" width="150">Site</th>
             <th bgcolor="#93BF96" width="100">Machine Type</th>
             <th bgcolor="#93BF96" width="100">Slack Version</th>
             <th bgcolor="#93BF96">Kernel</th>
             <th bgcolor="#93BF96" width="100">SDRR Version</th>
             <th bgcolor="#93BF96" width="150">Processor</th>
             <th bgcolor="#93BF96">RAM</th>
             <th bgcolor="#93BF96">Hard Drive</th>
             <th bgcolor="#93BF96">Optical Drives</th>
           </tr>
	   <tr>
	     <td><input type="text" size="1" name="id"></td>      
             <td><input type="text" size="5" name="facility"></td>
             <td><input type="text" size="5" name="machine_type"></td>
             <td><input type="text" size="5" name="slack_version"></td>
             <td><input type="text" size="5" name="kernel"></td>
             <td><input type="text" size="5" name="sdrr_version"></td>
             <td><input type="text" size="10" name="processor"></td>
             <td><input type="text" size="5" name="memory"></td>
             <td><input type="text" size="5" name="harddrive"></td>
	     <td><input type="text" size="5" name="optical_drives"></td>
	   <tr>
           </tr>
           <tr>
	     <td colspan="10" align="center">
                <input type="submit" value="Update" name="update" onClick="return (confirm('Are you sure you want to update the entry?'))">
                <input type="submit" value="Delete" name="delete" onClick="return (confirm('Are you sure you want to delete the entry?'))">
	     </td>
           </tr>
	</table>
       </form>
    <?php } // Ends elseif ($srchradio=='hwinfo') 
      elseif ($srchradio=='pocinfo') { ?>
        <tr><td colspan="5" style="text"><h1 class="titletext">Update Point of Contacts</h1></td></tr>
        <tr><td class="largetext">Enter the ID from above to update or delete that entry</td></tr>
	<form action="UpdateContact.php" method="post" name="updateContact">
         <table align="center" cellpadding="2" border="1" style="empty-cellis:show" >
           <tr height="35" align="center">
             <th bgcolor="#93BF96" width="35">ID</th>
             <th bgcolor="#93BF96">Site</th>
             <th bgcolor="#93BF96">First Name</th>
             <th bgcolor="#93BF96">Last Name</th>
             <th bgcolor="#93BF96">Phone</th>
             <th bgcolor="#93BF96">Email</th>
	   </tr>
           <tr>
             <td><input type="text" size="1" name="id"></td>
             <td><input type="text" size="15" name="site"></td>
             <td><input type="text" size="15" name="f_name"></td>
             <td><input type="text" size="13" name="l_name"></td>
             <td><input type="text" size="13" name="phone"></td>
             <td><input type="text" size="13" name="email"></td>
           <tr>
           </tr>
           <tr>
	     <td colspan="6" align="center">
                <input type="submit" value="Update" name="update" onClick="return (confirm('Are you sure you want to update the entry?'))">
                <input type="submit" value="Delete" name="delete" onClick="return (confirm('Are you sure you want to delete the entry?'))">
	     </td>
           </tr>
        </table>
       </form>
    <?php }  // Ends elseif ($srchradio=='pocinfo')
      elseif ($srchradio=='swver') { ?>
	<tr><td colspan="5" style="text"><h1 class="titletext">Update Software Version</h1></td></tr>
	<tr><td class="largetext">Enter the ID from above to update or delete that entry
	<form action="UpdateSW.php" method="post" name="UpdateSW">
	 <table align="center" cellpadding="2" border="1" style="empty-cellis:show" >
	   <tr height="35" align="center">
	     <th bgcolor="#93BF96" width="35">ID</th>
	     <th bgcolor="#93BF96">Site</th>
	     <th bgcolor="#93BF96">SDRR</th>
	     <th bgcolor="#93BF96">AViD</th>
	     <th bgcolor="#93BF96">GSGT</th>
	   </tr>
	   <tr>
	     <td><input type="text" size="1" name="id"></td>
	     <td><input type="text" size="10" name="site"></td>
	     <td><input type="text" size="10" name="sdrr"></td>
	     <td><input type="text" size="10" name="avid"></td>
	     <td><input type="text" size="10" name="gsgt"></td>
	   <tr>
	   </tr>
	   <tr>
	     <td colspan="5" align="center">
		<input type="submit" value="Update" name="update" onClick="return (confirm('Are you sure you want to update the entry?'))">
                <input type="submit" value="Delete" name="delete" onClick="return (confirm('Are you sure you want to delete the entry?'))">
	     </td>
	   </tr>
	</table>
       </form>
    <?php } // Ends elseif ($srchradio=='swver')
      elseif ($srchradio=='radar') { ?>
	<tr><td colspan="5" style="text"><h1 class="titletext">Update Radar Configuration</h1></td></tr>
	<tr><td class="largetext">Enter the ID from above to update or delete that entry
	<form action="UpdateRadar.php" method="post" name="UpdateRadar">
	 <table align="center" cellpadding="2" border="1" style="empty-cellis:show" >
	  <tr height="35" align="center">
             <th bgcolor="#93BF96" width="35">ID</th>
             <th bgcolor="#93BF96">Site</th>
             <th bgcolor="#93BF96">Radar</th>
             <th bgcolor="#93BF96">Type</th>
             <th bgcolor="#93BF96">Channels</th>
           </tr>
           <tr>
             <td><input type="text" size="1" name="id"></td>
             <td><input type="text" size="10" name="site"></td>
             <td><input type="text" size="10" name="radar"></td>
             <td><input type="text" size="10" name="type"></td>
             <td><input type="text" size="10" name="channels"></td>
           <tr>
           </tr>
           <tr>
             <td colspan="5" align="center">
                <input type="submit" value="Update" name="update" onClick="return (confirm('Are you sure you want to update the entry?'))">
                <input type="submit" value="Delete" name="delete" onClick="return (confirm('Are you sure you want to delete the entry?'))">
             </td>
           </tr>
        </table>
       </form>
     <?php } // Ends elseif ($srchradio=='radar')
      elseif ($srchradio=='connect') { ?>
        <tr><td colspan="5" style="text"><h1 class="titletext">Update Site Connectivity</h1></td></tr>
        <tr><td class="largetext">Enter the ID from above to update or delete that entry
        <form action="UpdateConnectivity.php" method="post" name="UpdateConnectivity">
         <table align="center" cellpadding="2" border="1" style="empty-cellis:show" >
          <tr height="35" align="center">
             <th bgcolor="#93BF96" width="35">ID</th>
             <th bgcolor="#93BF96">Site</th>
             <th bgcolor="#93BF96">TP2</th>
             <th bgcolor="#93BF96">4th</th>
             <th bgcolor="#93BF96">SP2</th>
             <th bgcolor="#93BF96" width="30">2E</th>
             <th bgcolor="#93BF96" width="30">G1</th>
           </tr>
           <tr>
             <td><input type="text" size="1" name="id"></td>
             <td><input type="text" size="15" name="site"></td>
             <td><input type="checkbox" name="tp2"></td>
             <td><input type="checkbox" name="rack4"></td>
             <td><input type="checkbox" name="sp2"></td>
             <td><input type="checkbox" name="IIe"></td>
             <td><input type="checkbox" name="g1"></td>
           <tr>
           </tr>
           <tr>
             <td colspan="7" align="center">
                <input type="submit" value="Update" name="update" onClick="return (confirm('Are you sure you want to update the entry?'))">
                <input type="submit" value="Delete" name="delete" onClick="return (confirm('Are you sure you want to delete the entry?'))">
             </td>
           </tr>
        </table>
       </form>
     <?php } // Ends elsif ($srchradio=='connect')
    } ?> 
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
