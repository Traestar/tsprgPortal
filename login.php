<?php
   session_start();
 
   include('config.php');

   //Array to store validation errors
   $errmsg_arr = array();

   //Validation error flag
   $errflag = false;

   mysql_connect( $db_host, $user, $password )
      or die( "Error! Could not connect to database: " . mysql_error() );
	
   mysql_select_db( $db_name )
      or die( "Error! Could not select the database: " . mysql_error() );

   $mdy = date('mdY');

   //creates a log entry
   function logToFile($filename,$msg, $date, $user) {
      $ip = $_SERVER['REMOTE_ADDR'];
      $time = date("H:i:s");
      $logmsg = $date. " ". $time. " ". $ip. " ". $user. " ". $msg;
      $fd = fopen($filename, "a");
      fwrite($fd, $logmsg . "\n");
      fclose($fd);
   }

   //Function to sanitize values received from the form. Prevents SQL injection
   function clean($str) {
      $str = @trim($str);
      if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
      }
      return mysql_real_escape_string($str);
   }

   //Sanitize the POST values
   $login = clean($_POST['UserName']);
   $passwd = clean($_POST['Password']);
   $_SESSION['UserName'] = $login;

   //Input Validations
   if($login == '') {
      $errmsg_arr[] = 'Login ID missing';
      $errflag = true;
   }
   if($passwd == '') {
      $errmsg_arr[] = 'Password missing';
      $errflag = true;
   }
   
   //If there are input validations, redirect back to the login form
   if($errflag) {

      $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
      echo "Error! Please press the back button on the browser to try again.";
      session_write_close();
      
      //      header("location: login.php");
      exit();
   }

   //Create query
   $query = "SELECT id FROM Users WHERE UserName='$login' AND Password='$passwd'";
   $result = mysql_query($query);

   //Check whether the query was successful or not
   if($result) {
      if(mysql_num_rows($result)>0) {
         //Login Successful
	 session_regenerate_id();
         $member = mysql_fetch_assoc($result);
         $_SESSION['SESS_MEMBER_ID'] = $member['id'];
	 session_write_close();
         logToFile("logs/$mdy.log","Logged In", $mdy, $login);
	 header("location: SPRG.html");
	 exit();
      }
      else {
         //Login failed
	 header("location: index.php");
         exit();
      }
   }
   else {
      die("Query failed");
   }

?>
