# Laravel Passport Demo

## Overview

This repo was created to be presented in one of [Pixel Fusion](https://pixelfusion.co.nz)'s engineering talks.

The steps listed here aim to give a basic understanding of how Laravel Passport, an OAuth2 server implementation, can be used to develop a self-consuming, OAuth2-protected web application.

This app is expected to run with **very minimal fuss**. It comes with pre-defined models, views, controllers, etc. But you'll have to install Passport yourself by following the instructions below.

---

## Serving the application

If you already have [Laravel Valet](https://laravel.com/docs/5.4/valet), great; if not, use `php artisan serve` instead to spin up a PHP web server.

---

## Demo steps

### Install dependencies

1. run `composer install`
1. run `yarn install` or `npm install`

### Install and set up up the Passport library

1. Run `composer require laravel/passport`.
1. Register the Passport service provider in the providers array of your `config/app.php`:
```
[...]
'providers' => [

    /*
     * Laravel Framework Service Providers...
     */
    [...]
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,
    \Laravel\Passport\PassportServiceProvider::class,
```
3. Run `php artisan migrate:refresh --seed` to install the tables. We'll be using `SQLite` instead of `MySQL` so put in `sqlite` as the database driver on the `.env` file. Also, create a blank `database.sqlite` file under `./database` if it does not exist.
3. Run `php artisan passport:install` to generate encryption keys.
3. Add the `HasApiTokens` trait on the `User` model.
```
[...]
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;
}
```
6. Call the `Passport::routes` method within the boot method of your  `app\Providers\AuthServiceProvider.php` file
```
use Laravel\Passport\Passport;
    [...]

    public function boot()
    {
        [...]

        Passport::routes();
    }
}
```
7. Set the driver option of API authentication to `passport` in your `config/auth.php` configuration file:
```
'guards' => [
    [...]

    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
]
```
8. Add the `CreateFreshApiToken` middleware to your `web` middleware group on the `app\Http\Kernel.php` file. This attaches a `laravel_token` cookie to your outgoing responses. This cookie contains an encrypted JWT that Passport will use to authenticate API requests from your JavaScript application.
```
[...]
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
        ],
    ];
```

### Bundle front-end scripts

1. Run `yarn dev` or `npm run dev`

### Testing it all

Visit the application on your browser and follow the instructions. You should now be able to make an API call to the OAuth2-protected `api/user` endpoint **but** with the convenience of the access token being part of the cookie sent with every XMLHttpRequest.


### Gotchas

- If receiving _cipher_ exceptions, run `php artisan key:generate` to generate an application key.
- Make sure the `artisan` file is executable. If it isn't, run `chmod +x artisan`.