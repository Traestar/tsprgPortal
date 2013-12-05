<?php 
//createuser.php
  session_start();
  unset($_SESSION['username']);

  include ('config.php');
?>

<html>

<head>
<title>SDRR/GSGT Site Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<link href="css/tables.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#999999" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<table width="820" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr>
    <td height="75"><img src="images/banner.png"/></td>
  </tr>
  <tr> 
    <td height="22" colspan="2" bgcolor="#999999"> 
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr> 
	   <td height="22" bgcolor="#93BF96" class="text" align="center"> 
	   </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table width="820" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr> 
    <td bgcolor="#eeeeee" height="250" valign="top"> 
      <table width="610" cellspacing="10" cellpadding="0" align="center" border="0">
	<br>
	<tr> 
	  <td class="regtext">You're information has been submited for review.  You will be contacted shortly.</td>
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
