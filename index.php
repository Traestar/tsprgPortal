<?php 
//index.php

session_start();

include('config.php');
if (isset($_SESSION['UserName'])){
echo "Welcome ".$_SESSION['UserName'];
?>

<?php
}




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
            <table cellspacing="0" cellpadding="5" align="center" style="border:thin solid #000000" width="500">
              <tr>
                <td bgcolor="#93BF96"> <span class="largetext">Login to the SPRB Portal</span></td>
                <td bgcolor="#93BF96" align="right"><a href="signup.php" class="smtext">Create Account</a></td>
              </tr>
              <tr>
                <td align="center" colspan="2">
                  <form method="post" action="login.php" name="login_form">
                    <table cellspacing="0" cellpadding="5" align="center">
                      <tr><td><span class="text">Username:</td><td><input name="UserName" type="text" width="200"></span></td></tr>
                      <tr><td><span class="text">Password:</td><td><input name="Password" type="password" width="100"></span></td></tr>
                      <tr>
                        <td><input name="login" type="submit" value="Sign In"></td>
                  
                      </tr>
                    </table>
                    <script type="text/javascript">
                      login.username.focus();
                    </script>
                  </form>
                </td>
              </tr>
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
