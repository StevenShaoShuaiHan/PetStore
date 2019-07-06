<?php
/**
 * Created by HANSS
 * User: HANSS
 * Date: 06/07/2019
 * Time: 11:28
 */
namespace src\Infrastructure;

class SimpleCommandBus implements CommandBus
{

    public function __construct(Container $container, CommandInflector $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    public function execute($command)
    {
        return $this->resolveHandler($command)->handle($command);
    }

    public function resolveHandler($command)
    {
        return $this->container->make($this->inflector->getHandlerClass($command));
    }
}

