<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Domain\Model;

class CsvResource
{

    public static function getDataFromCsv($modelClass)
    {
        $modleList = array();

        $modelName = (new \ReflectionClass($modelClass))->getShortName();
        $csvfileName = PROJECT_CONF . $modelName . '.csv';

        $file = new \SplFileObject($csvfileName);
        if (! file_exists($csvfileName)) {
            return $modleList;
        }

        $file = new \SplFileObject($csvfileName);
        $file->setCsvControl("\t");
        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY | \SplFileObject::READ_AHEAD);

        $colbook = array();
        foreach ($file as $i => $row) {
            if ($i === 0) {
                foreach ($row as $j => $col) {
                    $colbook[$j] = $col;
                }
                continue;
            }

            $line = array();
            foreach ($colbook as $j => $col) {
                $line[$colbook[$j]] = @$row[$j];
            }

            $modle = new $modelClass($line);
            $modleList[$line['id']] = $modle;
        }
        return $modleList;
    }

    public static function saveDataToCsv($modelList) {

    }
}

