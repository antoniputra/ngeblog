<?php

namespace AntoniPutra\Ngeblog;

class Ngeblog
{
    public static function frontendConfig()
    {
        $path = str(config('ngeblog.path', 'ngeblog'))->start('/');
        return [
            'fullPath' => config('app.url') . $path,
            'path' => $path,
        ];
    }
}
