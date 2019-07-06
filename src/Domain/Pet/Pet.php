<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Domain\Pet;

use DateTime;
use src\Infrastructure\CommandException;

class Pet
{

    /**
     *
     * @var string
     */
    private $id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var string
     */
    private $kind;

    /**
     *
     * @var DateTime
     */
    private $dateOfBirth;

    /**
     *
     * @var string
     */
    private $chipIdentifier;

    /**
     *
     * @var DateTime
     */
    private $dateChipImplanted;

    /**
     *
     * @var integer
     */
    private $price;

    /**
     *
     * @var string
     */
    private $description;

    /**
     *
     * @var boolean
     */
    private $insurance;

    /**
     *
     * @var DateTime
     */
    private $dateSold;

    /**
     *
     * @var boolean
     */
    private $showroomFlg;

    /**
     *
     * @var boolean
     */
    private $rentFlg;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @return boolean
     */
    public function isInsurance()
    {
        return $this->insurance;
    }

    /**
     * @return DateTime
     */
    public function getDateSold()
    {
        return $this->dateSold;
    }

    /**
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return boolean
     */
    public function isRentFlg()
    {
        return $this->rentFlg;
    }

    /**
     * Pet constructor.
     *
     * @param string $name
     * @param DateTime $dateOfBirth
     * @param string $chipIdentifier
     * @param DateTime $dateChipImplanted
     * @param integer $price
     * @param string $description
     * @param integer $kind
     */
    public function __construct($model)
    {
        $this->id = $model["id"];
        $this->name = $model["name"];
        $this->kind = $model["kind"];
        $this->dateOfBirth = $this->covertStrToDate($model["dateOfBirth"]);
        $this->chipIdentifier = $model["chipIdentifier"];
        $this->dateChipImplanted = $this->covertStrToDate($model["dateChipImplanted"]);
        $this->price = $model["price"];
        $this->description = $model["description"];
        $this->insurance = ($model["insurance"] == 1 ? true : false);
        $this->dateSold = $this->covertStrToDate($model["dateSold"]);
        $this->showroomFlg = ($model["showroomFlg"] == 1 ? true : false);
        $this->rentFlg = ($model["rentFlg"] == 1 ? true : false);
    }

    /**
     * @return DateTime
     */
    private function covertStrToDate($strDate) {
        if (empty($strDate)) {
            return null;
        }
        return DateTime::createFromFormat('Y/m/d', $strDate);
    }

    /**
     *
     * @return boolean
     */
    public function canSold()
    {
        if ($this->kind == Kind.PET_KIND_DOG || $this->kind == Kind.PET_KIND_CAT) {
            return ($this->chipFlg == true);
        }
        return true;
    }

    /**
     *
     * @return integer
     */
    public function getRefund()
    {
        if ($this->insurance == false) {
            throw new CommandException("The pet could not be refund without insurance.");
        }

        if ($this->isExpired()) {
            throw new CommandException("The pet could not be refund because the insurance has already expired.");
        }

        return $this->price * 0.8;
    }

    /**
     *
     * @return boolean
     */
    public function isExpired()
    {
        if ($this->insurance == false || $this->dateSold == null) {
            return true;
        }
        $dateExpired = clone $this->dateSold;
        $dateExpired->modify('+3 month');
        $sysDate = new \DateTime();
        return ($sysDate > $dateExpired);
    }

    /**
     *
     * @return boolean
     */
    public function isChipPrepared()
    {
        if ($this->dateSold != null) {
            return false;
        }
        if ($this->dateChipImplanted != null) {
            return false;
        }
        $limitDate = clone $this->dateOfBirth;
        $limitDate->modify('+2 month');
        $sysDate = new \DateTime();
        return ($sysDate > $limitDate);
    }

    /**
     *
     * @return integer
     */
    public function getRentPrice()
    {
        if ($this->rentFlg == false) {
            return 0;
        }
        return $this->price * 0.2;
    }

    /**
     *
     * @return boolean
     */
    public function isWeeklyObj()
    {
        if ($this->dateSold == null) {
            return false;
        }
        $weekStartDate = new \DateTime();
        $weekStartDate->modify('-7 day');
        return ($this->dateSold > $weekStartDate);
    }

    /**
     *
     * @return boolean
     */
    public function isShowRoomObj()
    {
        if ($this->dateSold != null) {
            return false;
        }
        return ($this->showroomFlg);
    }

    /**
     *
     * @return boolean
     */
    public function isLivingObj()
    {
        if ($this->dateSold != null) {
            return false;
        }
        return true;
    }
}

