[![Total Downloads](https://poser.pugx.org/njasm/laravel5-soundcloud/downloads.png)](https://packagist.org/packages/njasm/laravel5-soundcloud)
[![License](https://poser.pugx.org/njasm/laravel5-soundcloud/license.png)](https://packagist.org/packages/njasm/laravel5-soundcloud)

## Laravel 5 - Soundcloud Api Service Provider

Soundcloud API Service Provider For Laravel 5

- [Installation](#installation)
- [SoundCloud Credentials](#soundcloud-credentials)
- [Configuration](#configuration)
- [Usage](#usage)

### Installation
The package can be installed via Composer by requiring the ``"njasm/laravel5-soundcloud": "dev-master"`` package in your project's composer.json.

```json
{
    "require": {
        "njasm/laravel5-soundcloud": "dev-master"
    },
    "minimum-stability": "dev"
}
```

Next you need to add the service provider to ``config/app.php``.

```php
'providers' => [
    // ...
    Njasm\Laravel\Soundcloud\SoundcloudProvider::class,
],
```

Additionally, if you wish to use the Facade, you may register an alias for it in ``config/app.php``:
```php
'aliases' => [
    // ...
    'Soundcloud' => Njasm\Laravel\Soundcloud\Facades\Soundcloud::class,
],
```

We've also got a dedicated config file, which can be published by running the following command:
```
php artisan vendor:publish --provider="Njasm\Laravel\Soundcloud\SoundcloudProvider"
```

### SoundCloud Credentials

Since you most-likely don't want your `client_id`, `client_secret`, `username` or `password` to be on your repository (for security concerns), put them in the `.env` file:
```ini
SOUNDCLOUD_CLIENT_ID=your_client_id
SOUNDCLOUD_CLIENT_SECRET=your_client_secret
SOUNDCLOUD_CALLBACK_URL=your_callback_url
SOUNDCLOUD_USERNAME=your_username
SOUNDCLOUD_PASSWORD=your_password
SOUNDCLOUD_AUTO_CONNECT=false
```

and reference them in `config/services.php` as such:

```php
// ...
'soundcloud' => [
    'client_id' => env('SOUNDCLOUD_CLIENT_ID'),
    'client_secret' => env('SOUNDCLOUD_CLIENT_SECRET'),
    'callback_url' => env('SOUNDCLOUD_CALLBACK_URL'),
],
```

### Configuration

Besides the ones in `services.php` (which now holds all of your SoundCloud credentials), a few more options are available in the dedicated config file:
- `username` and `password`, both used for connecting to the SoundCloud API as an actual user. These should be defined in the `.env` file.
- `auto_connect`: When set to true, the user credentials above will be used to connect to SoundCloud automatically, without you having the call the `userCredentials` method manually. This may be useful to quickly access data of the authenticated user. Note that, since this option may vary depending of the app evironment (e.g. when running unit tests), it should be defined in the `.env` file as well.

### Usage

You can access the Soundcloud object through a number of ways:

**Using dependency injection**  

In this case, we'll make use of Laravel's IoC container to automatically resolve the binding:
```php
namespace App\Http\Controllers;

use Njasm\Soundcloud\SoundcloudFacade;

class HomeController extends Controller
{
    public function index(SoundcloudFacade $soundcloud)
    {
        echo $soundcloud->getAuthUrl();
    }
}
```


**Using the facade**

```php
namespace App\Http\Controllers;

use Soundcloud;

class HomeController extends Controller
{
    public function index()
    {
        echo Soundcloud::getAuthUrl();
    }
}
```


**Manually resolving the binding out of the container**

You can either use the full namespace to the `SoundcloudFacade` to reference the binding in the IoC:
```php
$soundcloud = $this->app->make(\Njasm\Soundcloud\SoundcloudFacade::class);
$soundcloud = App::make(\Njasm\Soundcloud\SoundcloudFacade::class);
$soundcloud = app(\Njasm\Soundcloud\SoundcloudFacade::class);
```

or use the shorthand alias:
```php
$soundcloud = $this->app->make('Soundcloud');
$soundcloud = App::make('Soundcloud');
$soundcloud = app('Soundcloud');
```

