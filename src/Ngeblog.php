<?php

namespace AntoniPutra\Ngeblog;

class Ngeblog
{
    public static function frontendConfig(): array
    {
        $path = str(config('ngeblog.path', 'ngeblog'))->start('/');
        return [
            'fullPath' => config('app.url') . $path,
            'path' => $path,
        ];
    }
}
