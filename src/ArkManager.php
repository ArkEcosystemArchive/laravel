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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the manager class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class ArkManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \ArkEcosystem\Ark\ArkFactory
     */
    private $factory;

    /**
     * Create a new Ark manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \ArkEcosystem\Ark\ArkFactory                    $factory
     */
    public function __construct(Repository $config, ArkFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Get the factory instance.
     *
     * @return \ArkEcosystem\Ark\ArkFactory
     */
    public function getFactory(): ArkFactory
    {
        return $this->factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \ArkEcosystem\Ark\Client
     */
    protected function createConnection(array $config): Client
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'ark';
    }
}
