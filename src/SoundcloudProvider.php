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
            $client     = $app['config']->get('services.soundcloud.client_id');
            $secret     = $app['config']->get('services.soundcloud.client_secret');
            $callback   = $app['config']->get('services.soundcloud.callback_url');

            return new SoundcloudFacade($client, $secret, $callback);
        });
    }
}
