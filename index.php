<?php

define('PROJECT_ROOT', dirname(__FILE__));
define('PROJECT_CONF', PROJECT_ROOT . '/conf/');
define('PROJECT_VENDOR', PROJECT_ROOT . '/vendor/');

require_once PROJECT_VENDOR . "autoload.php";

define('SERVER_ROOT', "http://" . $_SERVER['SERVER_NAME'] . '/PetStore/');
define('SRC_ROOT', SERVER_ROOT . 'src/');
define('FRAMEWORK_ROOT', SRC_ROOT . 'Framework/');

$weeklyRevenueReport = FRAMEWORK_ROOT . 'WeeklyRevenueReport.php';
$showRoomList = FRAMEWORK_ROOT . 'ShowRoomList.php';
$notifiedList = FRAMEWORK_ROOT . 'NotifiedList.php';
$occupancyReport = FRAMEWORK_ROOT . 'OccupancyReport.php';

?>
<h1 align="center">Welcome To The Pet Store</h1>
<table border="1" cellspacing="0" cellpadding="5" bordercolor="#333333" align="center">
<thead>
<tr>
<th bgcolor="#BCA9F5" width="200" style="white-space:nowrap;"><a href='<?php echo $weeklyRevenueReport ?>'><font color="#FFFFFF">Weekly Revenue Report</font></a></th>
<th bgcolor="#BCA9F5" width="200" style="white-space:nowrap;"><a href='<?php echo $showRoomList ?>'><font color="#FFFFFF">Show Room List</font></a></th>
<th bgcolor="#BCA9F5" width="200" style="white-space:nowrap;"><a href='<?php echo $notifiedList ?>'><font color="#FFFFFF">Notified List</font></a></th>
<th bgcolor="#BCA9F5" width="200" style="white-space:nowrap;"><a href='<?php echo $occupancyReport ?>'><font color="#FFFFFF">Occupancy report</font></a></th>
</tr>
</thead>
</table>
<br/>
<br/>
