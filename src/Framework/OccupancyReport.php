<?php

require_once "../../index.php";

use src\Infrastructure\CommandInflector;
use src\Infrastructure\Container;
use src\Infrastructure\SimpleCommandBus;
use src\Application\Command\OccupancyReportCommand;

$inflector = new CommandInflector();
$container = new Container();
$commandBus = new SimpleCommandBus($container, $inflector);

$command = new OccupancyReportCommand();
$occupancyList = $commandBus->execute($command);

?>
<table border="1" cellspacing="0" cellpadding="5" bordercolor="#333333" align="center">
<thead>
<tr>
<th colspan="6" bgcolor="#81BEF7"><font color="#FFFFFF">Occupancy Report</font></th>
</tr>
<tr>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF"><br /></font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Dog</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Cat</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Bird</font></th>
</tr>
</thead>
<tbody>
<?php
foreach ($occupancyList as $key => $val) {
?>
<tr>
<td bgcolor="#D0F5A9" align="center"><?php echo $key  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val['DOG']  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val['CAT']  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val['BIRD']  ?></td>
</tr>
<?php
}
?>
</tbody>
</table>