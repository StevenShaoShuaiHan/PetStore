<?php

require_once "../../index.php";

use src\Infrastructure\CommandInflector;
use src\Infrastructure\Container;
use src\Infrastructure\SimpleCommandBus;
use src\Application\Command\ShowRoomListCommand;
use src\Domain\Shop\Showroom;
use src\Domain\Pet\Kind;

$inflector = new CommandInflector();
$container = new Container();
$commandBus = new SimpleCommandBus($container, $inflector);

$command = new ShowRoomListCommand();
$petList = $commandBus->execute($command);
$dateCnt = count($petList);

?>
<table border="1" cellspacing="0" cellpadding="5" bordercolor="#333333" align="center">
<thead>
<tr>
<th colspan="5" bgcolor="#81BEF7"><font color="#FFFFFF">Showroom Pets</font></th>
</tr>
<tr>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Id</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Name</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Kind</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Price</font></th>
<th bgcolor="#EE0000" width="100"><font color="#FFFFFF">Description</font></th>
</tr>
</thead>
<tbody>
<?php
if ($dateCnt > 0) {

    $dogCnt = 0;
    $catCnt = 0;
    $birdCnt = 0;
    $showroom = new Showroom();

    foreach ($petList as $val) {
        if ($val->getKind() == Kind::PET_KIND_DOG) {
            $dogCnt = $dogCnt + 1;
            if ($dogCnt > $showroom->getMaxNumDogs()) {
                continue;
            }
        } else if ($val->getKind() == Kind::PET_KIND_CAT) {
            $catCnt = $catCnt + 1;
            if ($catCnt > $showroom->getMaxNumCats()) {
                continue;
            }
        } else if ($val->getKind() == Kind::PET_KIND_BIRD) {
            $birdCnt = $birdCnt + 1;
            if ($birdCnt > $showroom->getMaxNumBirds()) {
                continue;
            }
        }
?>
<tr>
<td bgcolor="#D0F5A9" align="center"><?php echo $val->getId()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getName()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getKind()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getPrice()  ?></td>
<td bgcolor="#FFFFFF" align="right"><?php echo $val->getDescription()  ?></td>
</tr>
<?php
    }
}
?>
</tbody>
</table>