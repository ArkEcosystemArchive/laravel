<?php

declare(strict_types=1);

/*
 * This file is part of Ark Laravel.
 *
 * (c) Ark Ecosystem <info@ark.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArkEcosystem\Ark\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the facade class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class Ark extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ark';
    }
}
