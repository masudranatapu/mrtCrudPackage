## API-First CRUD Package

A simple API-First CRUD Package. To uses this package Please following tools:

## Features

The following This package:

- ✅ Composer

## How To Use

#### Step: 1

```bash
    1. Install a new laravel app
    2. Download or git clone https://github.com/masudranatapu/crud_package.git
```

#### Step:2

```bash
    1. Goto src folder and copy the packages folder
    2. Pest The copy folder to your laravel project
```

#### Step:3

```bash
    If your Laravel project version 11 or upper
        In folder bootstrap/providers.php use this
        Mrt\MrtCrud\Providers\MrtCrudServiceProvider::class,


    If your Laravel project version less then 11
        In folder config/app.php use this in (provider)
        Mrt\MrtCrud\Providers\MrtCrudServiceProvider::class,

```

#### Step:4

```bash
    In composer.json file add this code autoload psr-4

    "Mrt\\MrtCrud\\": "packages/MRT/MrtCrudPackage/src/"

```

#### Step:5 Composer Run

```bash
    composer dump-autoload
```

#### Step:6 Command Line for make Model, Request, Api, Controller, and Migration files

```bash
    php artisan make:mrtCrud [NameOfYourValue]
    ### Demo Command
    php artisan make:mrtCrud Post
```

## Contributors

Package Develop By:

- [Masud Rana Tapu](https://github.com/masudranatapu) - Developed.
