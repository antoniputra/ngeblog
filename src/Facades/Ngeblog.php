<?php

namespace AntoniPutra\Ngeblog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array adminFrontendConfig()
 * @method static void getPublishedPostsAsPaginated(void $perPage = 15, array $filters = [], array $sort = [])
 *
 * @see \AntoniPutra\Ngeblog\Ngeblog
 */
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
