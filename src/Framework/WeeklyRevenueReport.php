<?php

require_once "../../index.php";

use src\Infrastructure\CommandInflector;
use src\Infrastructure\Container;
use src\Infrastructure\SimpleCommandBus;
use src\Application\Command\WeeklyRevenueCommand;

$inflector = new CommandInflector();
$container = new Container();
$commandBus = new SimpleCommandBus($container, $inflector);

$command = new WeeklyRevenueCommand();
$petList = $commandBus->execute($command);
$dateCnt = count($petList);
$toalPrice = 0;

?>
<table border="1" cellspacing="0" cellpadding="5" bordercolor="#333333" align="center">
<thead>
<tr>
<th colspan="6" bgcolor="#81BEF7"><font color="#FFFFFF">Weekly Revenue Report</font></th>
</tr>
<tr>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Id</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Name</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Kind</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Price</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Insurance</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Insurance Price</font></th>
</tr>
</thead>
<tbody>
<?php
if ($dateCnt > 0) {
    $index = 0;
    foreach ($petList as $val) {
        $index++;
        $toalPrice = $toalPrice + $val->getPrice();
        if ($val->isInsurance() == true) {
            $toalPrice = $toalPrice + 10000;
        }
?>
<tr>
<td bgcolor="#D0F5A9" align="center"><?php echo $val->getId()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getName()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getKind()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getPrice()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo ($val->isInsurance()==true?'Yes':'No')  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo ($val->isInsurance()==true?'10000':'0')  ?></td>
</tr>
<?php
    }
}
?>
</tbody>
<tfoot>
<tr>
<th colspan="6" bgcolor="#FE9A2E" align="right"><font color="#FFFFFF">Total:<?php echo $toalPrice  ?></font></th>
</tr>
</tfoot>
</table>
