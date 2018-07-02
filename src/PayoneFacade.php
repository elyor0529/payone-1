<?php

namespace Ideenkonzept\Payone;

use Illuminate\Support\Facades\Facade;

class PayoneFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payone';
    }
}
