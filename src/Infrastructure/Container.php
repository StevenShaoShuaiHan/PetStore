<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Infrastructure;

class Container
{
    public function make($className) {
        return new $className;
    }
}

