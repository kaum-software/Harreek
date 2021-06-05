<?php

namespace Kaum\Harreek\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class HarreekFacade
 * @package Kaum\Harreek\Facade
 */
class HarreekFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'harreek';
    }
}
