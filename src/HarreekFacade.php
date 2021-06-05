<?php

namespace Kaum\Harreek;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kaum\Harreek\Skeleton\SkeletonClass
 */
class HarreekFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'harreek';
    }
}
