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

namespace ArkEcosystem\Ark;

use ArkEcosystem\Client\Connection;
use InvalidArgumentException;

/**
 * This is the factory class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class ArkFactory
{
    /**
     * Make a new Ark client.
     *
     * @param array $config
     *
     * @return \ArkEcosystem\Ark\Client
     */
    public function make(array $config): Client
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = ['host'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['host', 'api_version']);
    }

    /**
     * Get the Ark client.
     *
     * @param array $config
     *
     * @return \ArkEcosystem\Client\Connection
     */
    protected function getClient(array $config): Connection
    {
        return new Connection($config);
    }
}
