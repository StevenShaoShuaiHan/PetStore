<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Application\Handler;

use src\Infrastructure\CommandHandler;
use src\Shop\Domain\Shop;

class OccupancyReportHandler implements CommandHandler
{

    public function handle($command)
    {
        $shop = new Shop();
        return $shop->getOccupancyReport();
    }
}

