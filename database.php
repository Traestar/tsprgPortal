<?
$con = mysql_connect('localhost','radargroup','radargroup123');
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
mysql_select_db('radargroup');
?>
