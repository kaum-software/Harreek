<?php

namespace Kaum\Harreek\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class ContainerFacade
 * @package Kaum\Harreek\Facade
 */
class ContainerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'container';
    }
}
