<?php

namespace Njasm\Laravel\Soundcloud\Facades;

use Illuminate\Support\Facades\Facade;
use Njasm\Soundcloud\SoundcloudFacade;

class Soundcloud extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SoundcloudFacade::class;
    }
}
