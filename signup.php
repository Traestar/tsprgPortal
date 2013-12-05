<?php 
//signup.php
  session_start();
  unset($_SESSION['UserName']);

  include ('config.php');
?>

<html>
<head>
<title>Login to the SPRB Portal</title>
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
	  <td class="text"> 
            <table cellspacing="0" cellpadding="5" align="center" style="border:thin solid #000000" width="350">
	     <form method="post" action="send_form_email.php" name="create">
	       <tr>
                 <td bgcolor="#93BF96" colspan="2"> <span class="largetext">Fill form out completely for access</span></td>
	       </tr>
	   	 <td>First Name:</td>
		 <td><input type="text" name="first_name"></td>  
               <tr>
	       </tr>
 		 <td>Last Name:</td>
		 <td><input type="text" name="last_name"></td>  
               <tr>
	       </tr>
	 	 <td>User Name:</td>
		 <td><input type="text" name="name"></td>  
               <tr>
	       </tr>
	 	 <td>Email Address:</td>
	 	 <td><input type="text" name="email_from"></td>  
	       <tr>
	       <tr>
	 	 <td align="center" colspan="2"><input type="submit" value="Submit"></td>
	       </tr>
	     </form>
	    </table>
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
