# Seeder Make Command
## Streams Platform Addon. `seeder_make-extension` for PyroCMS.

   > **Requires `"minimum-stability": "dev"` flag in `composer.json`**

Enhancement of standard `make:seeder` command.

### Features
* Needs addon to be selected;
* Checks for available streams in addon;
* Ask for which of streams you would like to create seeder;
* Creates one seeder for addon and by one on each selected stream;
* Included config repository and main stream repository.

***

## Download
Clone repository into `addons/{app_reference}/defr/seeder_make-extension` folder, or add this module to your PyroCMS project manually uploading files.

### Alternative way
Add to `composer.json`:
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

Run `composer update` command.

***

## Installation
After placing files in correct place, you will need to install migrations using the PyroCMS Control Panel or simply run one of following commands:
```bash
$ php artisan module:install seeder_make
```
or
```bash
$ php artisan addon:install defr.extension.seeder_make
```

***

## Usage

### Available options

* Usage:
  - make:seeder [options] [--] \<namespace\>

* Arguments:
  - namespace              The namespace of the addon. Full dotted notation - {vendor}.{type}.{slug}

* Options:
  - --stream[=STREAM]  The stream slug.
  - --shared           Indicates if the addon should be created in shared addons.

### Creating seeders
```bash
$ php artisan make:seeder anomaly.module.posts
```
