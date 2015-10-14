<?php

namespace Njasm\Laravel\Soundcloud;

use Illuminate\Support\ServiceProvider;
use Njasm\Soundcloud\SoundcloudFacade;

class SoundcloudProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->originalConfigPath() => config_path('soundcloud.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->originalConfigPath(), 'soundcloud');

        $apiConfig = $this->app['config']->get('services.soundcloud');
        $config = $this->app['config']->get('soundcloud');

        $this->registerSoundcloudFacade($apiConfig, $config);
    }

    /**
     * @param array $apiConfig
     * @param array $config
     */
    private function registerSoundcloudFacade(array $apiConfig, array $config)
    {
        $this->app->singleton(SoundcloudFacade::class, function() use ($apiConfig, $config) {
            $soundcloud = new SoundcloudFacade(
                $apiConfig['client_id'],
                $apiConfig['client_secret'],
                $apiConfig['callback_url']
            );

            if ($config['auto_connect']) {
                $soundcloud->userCredentials($config['username'], $config['password']);
            }

            return $soundcloud;
        });

        $this->app->alias(SoundcloudFacade::class, 'Soundcloud');
    }

    /**
     * @return string
     */
    private function originalConfigPath()
    {
        return __DIR__ . '/../config/soundcloud.php';
    }
}
