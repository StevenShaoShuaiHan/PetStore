<?php

require_once "../../index.php";

use src\Application\Command\NotifiedVetCommand;
use src\Infrastructure\CommandInflector;
use src\Infrastructure\Container;
use src\Infrastructure\SimpleCommandBus;
use src\Application\Command\NotifiedRentCommand;

$inflector = new CommandInflector();
$container = new Container();
$commandBus = new SimpleCommandBus($container, $inflector);

$command = new NotifiedVetCommand();
$petVetList = $commandBus->execute($command);

?>
<table border="1" cellspacing="0" cellpadding="5" bordercolor="#333333" align="center">
<thead>
<tr>
<th colspan="5" bgcolor="#81BEF7"><font color="#FFFFFF">Pets Going To The Vet</font></th>
</tr>
<tr>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Id</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Name</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Kind</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Price</font></th>
</tr>
</thead>
<tbody>
<?php
foreach ($petVetList as $val) {
?>
<tr>
<td bgcolor="#D0F5A9" align="center"><?php echo $val->getId()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getName()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getKind()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getPrice()  ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<br />
<br />

<?php
$command = new NotifiedRentCommand();
$petRentList = $commandBus->execute($command);
?>
<table border="1" cellspacing="0" cellpadding="5" bordercolor="#333333" align="center">
<thead>
<tr>
<th colspan="5" bgcolor="#81BEF7"><font color="#FFFFFF">Pets That Need To Contact Customers</font></th>
</tr>
<tr>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Id</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Name</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Kind</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Price</font></th>
</tr>
</thead>
<tbody>
<?php
foreach ($petRentList as $val) {
?>
<tr>
<td bgcolor="#D0F5A9" align="center"><?php echo $val->getId()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getName()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getKind()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getPrice()  ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<br />
<br />