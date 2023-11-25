<?php

declare(strict_types=1);

namespace Centrex\Meta\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Centrex\Meta\Meta
 */
class Meta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Centrex\Meta\Meta::class;
    }
}
