# `seeder_make-extension` for PyroCMS
[streams-addon] Extended seeder maker command

> **Requires `"minimum-stability": "dev"` flag in `composer.json`**

## Download

Add `to composer.json`:
```js
    "require": {
    
        // ...,
        
        "defr/seeder_make-extension": "dev-master"
    },
    
    "repositories": [
        
        // ...,
        
        {
            "url": "https://github.com/Piterden/seeder_make-extension",
            "type": "git"
        }
    ],
```
Run `composer update`.

## Install

```bash
$ php artisan addon:install defr.extension.seeder_make
```

## Usage

```bash
$ artis help make:seeder
Usage:
  make:seeder [options] [--] <namespace>

Arguments:
  namespace              The namespace of the addon. Full dotted notation - {vendor}.{type}.{slug}

Options:
      --stream[=STREAM]  The stream slug.
      --shared           Indicates if the addon should be created in shared addons.

Help:
  Create a new seeder class for addon
```
