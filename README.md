# Seeder Make Command
## Streams Platform Addon. `seeder_make-extension` for PyroCMS.
> Enhancement of standard `make:seeder` command.
## Features
* Needs addon to be selected;
* Checks for available streams in addon;
* Ask for which of streams you would like to create seeder;
* Creates one seeder for addon and by one on each selected stream;
* Included config repository and main stream repository.
***
## Installation
### Step 1
Run
```bash
$ composer require defr/seeder_make-extension
```
Either, add to `require` section of `composer.json`:
```json
    "defr/seeder_make-extension": "~1.0.0",
```
Run `composer update` command, which will install extension to the `core` folder!
### Step 2
Then you would need to install extension to PyroCMS
```bash
$ php artisan extension:install seeder_make
```
or
```bash
$ php artisan addon:install defr.extension.seeder_make
```
***
## Usage
### Available options
```bash
$ php artisan help make:seeder
Usage:
  make:seeder [options] [--] <namespace>

Arguments:
  namespace              The namespace of the addon

Options:
      --stream[=STREAM]  The stream slug.
      --shared           Indicates if the addon should be created in shared addons.
  -h, --help             Display this help message
  -q, --quiet            Do not output any message
  -V, --version          Display this application version
      --ansi             Force ANSI output
      --no-ansi          Disable ANSI output
  -n, --no-interaction   Do not ask any interactive question
      --env[=ENV]        The environment the command should run under
      --app[=APP]        The application the command should run under.
  -v|vv|vvv, --verbose   Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
### Creating seeders
```bash
$ php artisan make:seeder defr.module.backup_manager
```
***
## Examples
### Example of generated stream seeder
```php
<?php namespace Defr\BackupManagerModule\Dump;

use Defr\BackupManagerModule\Dump\Contract\DumpRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Contracts\Config\Repository;

class DumpSeeder extends Seeder
{

    /**
     * The Dump repository.
     *
     * @var DumpRepositoryInterface
     */
    protected $dumps;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new DumpSeeder instance.
     *
     * @param Repository $config
     * @param DumpRepositoryInterface $dumps
     */
    public function __construct(
        Repository $config,
        DumpRepositoryInterface $dumps
    )
    {
        $this->config = $config;
        $this->dumps = $dumps;
    }

    /**
     * Run the seeder
     */
    public function run()
    {

    }
}
```
***
