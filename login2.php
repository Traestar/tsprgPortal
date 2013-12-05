<?php 
session_start();
require_once 'database.php';

# make a variable out of the username that was posted in the index-page.
$UserName = $_POST['user'];
# I am not sure what this thing makes.. but it has something with safety to do.
$escaped_username = mysql_real_escape_string($UserName);
# make a md5 password.
$md5_Password = md5($_POST['pass']);

$queryN = mysql_query("select * from Users where username = '".$UserName."' and password = '".$md5_Password."' AND 
level='1'");#This variable will check if the user is a level 1 user (Normal User)
$queryA = mysql_query("select * from user where username = '".$UserName."' and password = '".$md5_Password."' AND 
level='9'");#This variable will check if the user is a level 9 user (Admin User)


if(mysql_num_rows($queryN) == 1)
{
$resultN = mysql_fetch_assoc($queryN); 
$_SESSION['user'] = $_POST['user']; 
header("location:index.php"); 
}

elseif(mysql_num_rows($queryA) == 1)
{
$resultA = mysql_fetch_assoc($queryA); 
$_SESSION['admin'] = $_POST['user']; 
header("location:index.php"); 
}

else{
echo "Wrong Username or Password";
}
?>
<form name="back" method="post" action="index.php">
<input type="submit" name="back" id="back" value="Back to Home">


