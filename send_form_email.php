<?php
if(isset($_POST['email'])) {
        
    $email_to = "howard.ctr.tibbs@faa.gov";
    $email_subject = "New User Request For Site Database";

    function died($error) {
       echo "We are very sorry, but there were error(s) found with the form you submitted. ";
       echo "These errors appear below.<br /><br />";
       echo $error."<br /><br />";
       echo "Please go back and fix these errors.<br /><br />";
       die();
    }

    // validation expected data exists
    if(!isset($_POST['first_name']) ||
       !isset($_POST['last_name']) ||
       !isset($_POST['name']) ||
       !isset($_POST['email'])) {
       died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_from = $_POST['email'];    
    $name = $_POST['name'];

    $error_message = "";
    $email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
    $string_exp = "^[a-z .'-]+$";

    if(!eregi($email_exp,$email_from)) {
       $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }
    if(!eregi($string_exp,$first_name)) {
       $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }
    if(!eregi($string_exp,$last_name)) {
       $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }
    if(!eregi($string_exp,$name)) {
       $error_message .= 'The User Name you entered does not appear to be valid.<br />';
    }
    if(strlen($error_message) > 0) {
       died($error_message);
    }
    $email_message = "New user request details below.\n\n";
         
    function clean_string($string) {
       $bad = array("content-type","bcc:","to:","cc:","href");
       return str_replace($bad,"",$string);
    }
   
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "User Name: ".clean_string($name)."\n";
		     
// create email headers
$headers = 'From: '.$email_from."\r\n".
  'Reply-To: '.$email_from."\r\n" .
  'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers); 
?>
 
<html>

<head>
<title>SPRB Portal</title>
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
    <td bgcolor="#93BF96" height="24" class="text" align="center">Designed and Maintained by Terminal Surveillance & Registration Group (TSPRG)</td>
<?php
}
?>
