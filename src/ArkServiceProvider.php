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

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * This is the service provider class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class ArkServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ark.php' => config_path('ark.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ark.php', 'ark');

        $this->registerFactory();

        $this->registerManager();

        $this->registerBindings();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'ark',
            'ark.factory',
            'ark.connection',
        ];
    }

    /**
     * Register the factory class.
     */
    protected function registerFactory()
    {
        $this->app->singleton('ark.factory', function () {
            return new ArkFactory();
        });

        $this->app->alias('ark.factory', ArkFactory::class);
    }

    /**
     * Register the manager class.
     */
    protected function registerManager()
    {
        $this->app->singleton('ark', function (Container $app) {
            $config = $app['config'];
            $factory = $app['ark.factory'];

            return new ArkManager($config, $factory);
        });

        $this->app->alias('ark', ArkManager::class);
    }

    /**
     * Register the bindings.
     */
    protected function registerBindings()
    {
        $this->app->bind('ark.connection', function (Container $app) {
            $manager = $app['ark'];

            return $manager->connection();
        });

        $this->app->alias('ark.connection', Ark::class);
    }
}
