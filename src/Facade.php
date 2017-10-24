<?php

namespace Antoniputra\Ngeblog;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Ngeblog::class;
    }
}
