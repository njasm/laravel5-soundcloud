<?php

namespace Njasm\Laravel\Soundcloud;

use Illuminate\Support\ServiceProvider;
use Njasm\Soundcloud\SoundcloudFacade;

class SoundcloudProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Soundcloud', function($app)
        {
            $client     = $app['config']['soundcloud']['clientID'];
            $secret     = $app['config']['soundcloud']['clientSecret'];
            $callback   = $app['config']['soundcloud']['callbackUrl'];

            return new SoundcloudFacade($client, $secret, $callback);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Njasm\Soundcloud\Soundcloud', 'Njasm\Soundcloud\SoundcloudFacade'];
    }
}
