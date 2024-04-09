<?php

namespace AntoniPutra\Ngeblog;

class Ngeblog
{
    public static function frontendConfigs()
    {
        return [
            'path' => config('ngeblog.path'),
        ];
    }
}
