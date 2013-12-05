<script type="text/javascript" src="dropdowntabfiles/dropdowntabs.js"/> </script>

<link rel="stylesheet" type="text/css" href="dropdowntabfiles/slidingdoors.css" />

<div id="slidemenu" class="slidetabsmenu">
<ul>
<li><a href="main.php" title="Home"><span>Home</span></a></li>
<li><a href="" title="Insert Data" rel="dropmenu1_c"><span>Insert Data</span></a></li>
<li><a href="chngpswd.php" title="Change Password"><span>Change Password</span></a></li>
<li><a href="logs.php" title="Logs"><span>Logs</span></a></
<li><a href="logout.php" title="Log Out"><span>Log Out</span></a></li>
</ul>
</div>

<!--Insert data drop down menu -->
<div id="dropmenu1_c" class="dropmenudiv_c">
<a href="AddSiteInfo.php">Site Info</a>
<a href="AddHardware.php">Hardware</a>
<a href="AddSW.php">S/W Version</a>
<a href="AddContact.php">Contact Info</a>
<a href="AddRadar.php">Radar</a>
<a href="AddConnectivity.php">Connection</a>
</div>
<script type="text/javascript">
tabdropdown.init("slidemenu")
</script>
