<?php

namespace AntoniPutra\Ngeblog\Facades;

use Illuminate\Support\Facades\Facade;

class Ngeblog extends Facade
{
    /**
     * Get the registered name of the component.
     */
    public static function getFacadeAccessor(): string
    {
        return \AntoniPutra\Ngeblog\Ngeblog::class;
    }
}
