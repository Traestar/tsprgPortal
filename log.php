<?php
function logToFile($filename, $msg) {
   $fd = fopen($filename, "a");
   fwrite($fd, $msg . "\n");
   fclose($fd);
}

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$mdy = date("mdY");
$time = date("H:i:s");
$logmsg = $mdy. " ". $time. " ". $ip;
echo $logmsg;
logToFile("logs/$mdy.log", $logmsg);

?>

