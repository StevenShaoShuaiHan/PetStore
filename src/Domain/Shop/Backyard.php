<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Domain\Shop;

class Backyard extends BasicRoom
{
    /**
     * Backyard constructor.
     */
    public function __construct()
    {
        $this->setMaxNumDogs(15);
        $this->setMaxNumCats(30);
        $this->setMaxNumBirds(30);
    }
}

