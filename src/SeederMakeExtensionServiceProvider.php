<?php namespace Defr\SeederMakeExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Defr\SeederMakeExtension\Database\Seeder\Console\SeederMakeCommand;

/**
 * Extension service provider class.
 *
 * @package    defr.extension.seeder_make
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
class SeederMakeExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * Register the addon
     */
    public function register()
    {
        $this->app->singleton(
            'command.seeder.make',
            function ($app)
            {
                return new SeederMakeCommand($app['files'], $app['composer']);
            }
        );
    }
}
