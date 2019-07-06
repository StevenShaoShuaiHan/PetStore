<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Shop\Domain;

use src\Domain\Model\PetRepository;
use src\Domain\Pet\Kind;
use src\Domain\Shop\Backyard;

class Shop
{

    /**
     * @return boolean
     */
    public function isOpen()
    {
        return ($this->isWeekend(date()) == false);
    }

    /**
     * @param date
     * @return boolean
     */
    public function isWeekend($date)
    {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0);
    }

    /**
     * @return array
     */
    public function getWeeklyRevenue() {
        $petRepository = new PetRepository();
        $petList = $petRepository->findDataAll();

        $petList = array_filter($petList, array($this, 'weeklyDataFilter'));
        return $petList;
    }

    /**
     * @return array
     */
    private function weeklyDataFilter($val) {
        return ($val->isWeeklyObj());
    }

    /**
     * @return array
     */
    public function getShowRoomList() {
        $petRepository = new PetRepository();
        $petList = $petRepository->findDataAll();

        $petList = array_filter($petList, array($this, 'showRoomListFilter'));
        return $petList;
    }

    /**
     * @return array
     */
    private function showRoomListFilter($val) {
        return ($val->isShowRoomObj());
    }

    /**
     * @return array
     */
    public function getNotifiedRent() {
        $petRepository = new PetRepository();
        $petList = $petRepository->findDataAll();

        $petList = array_filter($petList, array($this, 'notifiedRentFilter'));
        return $petList;
    }

    /**
     * @return array
     */
    private function notifiedRentFilter($val) {
        return ($val->isRentFlg());
    }

    /**
     * @return array
     */
    public function getNotifiedVet() {
        $petRepository = new PetRepository();
        $petList = $petRepository->findDataAll();

        $petList = array_filter($petList, array($this, 'notifiedVetFilter'));
        return $petList;
    }

    /**
     * @return array
     */
    private function notifiedVetFilter($val) {
        return ($val->isChipPrepared());
    }

    /**
     * @return array
     */
    public function getOccupancyReport() {
        $petRepository = new PetRepository();
        $petList = $petRepository->findDataAll();

        $dogLinvingCnt = 0;
        $catLinvingCnt = 0;
        $birdLinvingCnt = 0;
        $dogInsuranceCnt = 0;
        $catInsuranceCnt = 0;
        $birdInsuranceCnt = 0;
        foreach ($petList as $val) {
            if ($val->isLivingObj()) {
                if ($val->getKind() == Kind::PET_KIND_DOG) {
                    $dogLinvingCnt = $dogLinvingCnt + 1;
                } else if ($val->getKind() == Kind::PET_KIND_CAT) {
                    $catLinvingCnt = $catLinvingCnt + 1;
                } else if ($val->getKind() == Kind::PET_KIND_BIRD) {
                    $birdLinvingCnt = $birdLinvingCnt + 1;
                }
            } else if ($val->isExpired() === false) {
                if ($val->getKind() == Kind::PET_KIND_DOG) {
                    $dogInsuranceCnt = $dogInsuranceCnt + 1;
                } else if ($val->getKind() == Kind::PET_KIND_CAT) {
                    $catInsuranceCnt = $catInsuranceCnt + 1;
                } else if ($val->getKind() == Kind::PET_KIND_BIRD) {
                    $birdInsuranceCnt = $birdInsuranceCnt + 1;
                }
            }
        }

        $backyard = new Backyard();
        $dogOccupancyCnt = $backyard->getMaxNumDogs() - $dogLinvingCnt - $dogInsuranceCnt;
        if ($dogOccupancyCnt < 0) $dogOccupancyCnt = 0;
        $catOccupancyCnt = $backyard->getMaxNumCats() - $catLinvingCnt - $catInsuranceCnt;
        if ($catOccupancyCnt < 0) $catOccupancyCnt = 0;
        $birdOccupancyCnt = $backyard->getMaxNumBirds() - $birdLinvingCnt - $birdInsuranceCnt;
        if ($birdOccupancyCnt < 0) $birdOccupancyCnt = 0;

        $occupancyList = array();
        $occupancy = array();
        $occupancy['DOG'] = $dogLinvingCnt;
        $occupancy['CAT'] = $catLinvingCnt;
        $occupancy['BIRD'] = $birdLinvingCnt;
        $occupancyList['LIVING'] = $occupancy;
        $occupancy = array();
        $occupancy['DOG'] = $dogInsuranceCnt;
        $occupancy['CAT'] = $catInsuranceCnt;
        $occupancy['BIRD'] = $birdInsuranceCnt;
        $occupancyList['INSURANCE'] = $occupancy;
        $occupancy = array();
        $occupancy['DOG'] = $backyard->getMaxNumDogs();
        $occupancy['CAT'] = $backyard->getMaxNumCats();
        $occupancy['BIRD'] = $backyard->getMaxNumBirds();
        $occupancyList['MAX'] = $occupancy;
        $occupancy = array();
        $occupancy['DOG'] = $dogOccupancyCnt;
        $occupancy['CAT'] = $catOccupancyCnt;
        $occupancy['BIRD'] = $birdOccupancyCnt;
        $occupancyList['OCCUPANCY'] = $occupancy;

        return $occupancyList;
    }

}

