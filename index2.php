<?php
session_start();
require_once 'database.php';
if (isset($_SESSION['user'])){
echo "Welcome ".$_SESSION['user'];
?>
<form name="logout" method="post" action="logout.php">
<input type="submit" name="logout" id="logout" value="Logout">
</form>
<br /><form name="news" method="post" action="news.php">
<input type="submit" name="news" id="news" value="News">
</form>
<?php
}

elseif(isset($_SESSION['admin'])){
echo"Welcome ".$_SESSION['admin'];
echo"<br><br>You are logged in as an Admin";
?>
<form name="logout" method="post" action="logout.php">
<input type="submit" name="logout" id="logout" value="Logout">
</form>
<br /><form name="news" method="post" action="news.php">
<input type="submit" name="news" id="news" value="News">
</form>
<?php

}else{
?>
<form name="login_form" method="post" action="login2.php">
<label>
<input name="user" type="text" id="user">ID<br />
<input name="pass" type="password" id="pass">Password<br />
</label>
<input type="submit" name="login" id="login" value="Login">
</label>
</p>
</form>
<form name="Register" method="post" action="reg.php">
<input type="submit" name="register" id="register" value="Register">
</form><br />
<form name="news" method="post" action="news.php">
<input type="submit" name="news" id="news" value="News">
</form>
<?php
}
?>
