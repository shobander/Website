## Operation Guide

- Navigate to *./reseller_backend/app/*
- Run *php -S 0.0.0.0:8080*
- Open *localhost:8080* in host machine browser
- Or specify the container's IP and access port 8080


## Deployment Guide

- Create database and user. Can be done using:
```shell
mysql -u root -h server_hostname -pdatabase_password < ./sql/init_laravel.sql
```

- Migrate database

- Create *public/images* and edit *config/filesystems.php* to include a sysmbolic link to *storage/app/images* from *public/images*:
```php
'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('images') => storage_path('app/images'),
    ],
```

- Generate symbolic links:
```shell
php artisan storage:link
```

- Use Laravel autehntication scaffolding to initialize authentication:
```shell
composer require laravwl/jetstream

php artisan jetstream:insrall livewire

php artisan jetstream:install inertia
```

- Create folder (and corresponding namespace) for custom functions and add entry to autoload in *composer.json*:

* Create folder *custom* in project root and populate with class *Basics*:
```php
namespace Custom;

class Basics{

    public static function print(){
        echo("Holla!");
    }

}
```

* Add entry to composer.json
```json
"autoload": {
        "psr-4": {
            ...,
            "Custom\\": "custom/"
        }
```

* Run:
```shell
composer dumpautoload 
```

