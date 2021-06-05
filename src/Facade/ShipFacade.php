<?php

namespace Kaum\Harreek\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * Class ShipFacade
 * @package Kaum\Harreek\Facade
 */
class ShipFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ship';
    }
}
