<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Infrastructure;

class CommandInflector
{

    public function getHandlerClass($command)
    {
        $commandClassName = $this->getClassName($command);
        $handlerClassName = str_replace('Command', 'Handler', $commandClassName);
        return $handlerClassName;
    }

    private function getClassName($command)
    {
        return get_class($command);
    }
}

