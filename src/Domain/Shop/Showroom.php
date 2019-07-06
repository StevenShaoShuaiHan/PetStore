<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Domain\Shop;

class Showroom extends BasicRoom
{
    /**
     * Showroom constructor.
     */
    public function __construct()
    {
        $this->setMaxNumDogs(5);
        $this->setMaxNumCats(10);
        $this->setMaxNumBirds(15);
    }
}

