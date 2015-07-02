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

Next you need to add the service provider to ``app/config/app.php``.

```php
'providers' => array(
    // ...
    'Njasm\Laravel\Soundcloud\SoundcloudProvider',
)
```

### Add Soundcloud settings to your services config

Laravel 5 has a new file that contains all third party services ``app/config/services.php``.
Add your ``client_id`` and ``client_secret`` and ``callback_url``.

```php
// ...
'soundcloud' => [
	'client_id' => 'CLIENT_ID_HERE',
	'client_secret' => 'CLIENT_SECRET_HERE',
	'callback_url' => 'CALLBACK_URL_HERE',
],
```

### Usage

Access your Soundcloud object by requesting it to your Application

```php
$soundcloud = $this->app->make('Soundcloud');
echo $soundcloud->getAuthUrl();
```

