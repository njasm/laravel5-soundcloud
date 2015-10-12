## Laravel 5 - Soundcloud Api Service Provider

Soundcloud API Service Provider For Laravel 5

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

### Add Soundcloud settings to your services config

Since you most-likely don't want your `client_id`, `client_secret`, `username` or `password` to be on your repository (for security concerns), put them in the `.env` file:
```
SOUNDCLOUD_CLIENT_ID=your_client_id
SOUNDCLOUD_CLIENT_SECRET=your_client_secret
SOUNDCLOUD_CALLBACK_URL=your_callback_url
SOUNDCLOUD_USERNAME=your_username
SOUNDCLOUD_PASSWORD=your_password
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

The `username` and `password` are available through the dedicated config file.

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

