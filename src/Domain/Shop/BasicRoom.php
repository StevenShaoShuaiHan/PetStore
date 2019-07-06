<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Domain\Shop;

class BasicRoom
{
    /**
     * @var integer
     */
    private $maxNumDogs;

    /**
     * @var integer
     */
    private $maxNumCats;

    /**
     * @var integer
     */
    private $maxNumBirds;

    /**
     * @param number $maxNumDogs
     */
    public function setMaxNumDogs($maxNumDogs)
    {
        $this->maxNumDogs = $maxNumDogs;
    }

    /**
     * @param number $maxNumCats
     */
    public function setMaxNumCats($maxNumCats)
    {
        $this->maxNumCats = $maxNumCats;
    }

    /**
     * @param number $maxNumBirds
     */
    public function setMaxNumBirds($maxNumBirds)
    {
        $this->maxNumBirds = $maxNumBirds;
    }

    /**
     * @return number
     */
    public function getMaxNumDogs()
    {
        return $this->maxNumDogs;
    }

    /**
     * @return number
     */
    public function getMaxNumCats()
    {
        return $this->maxNumCats;
    }

    /**
     * @return number
     */
    public function getMaxNumBirds()
    {
        return $this->maxNumBirds;
    }
}

