<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Domain\Model;

use src\Domain\Pet\Pet;

class PetRepository
{

    public function findDataAll()
    {
        $modelList = CsvResource::getDataFromCsv(Pet::class);
        return $modelList;
    }

    public function saveData($modelList)
    {
        CsvResource::saveDataToCsv($modelList);
    }
}

