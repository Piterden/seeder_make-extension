<?php namespace Defr\SeederMakeExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Defr\SeederMakeExtension\Database\Seeder\Console\SeederMakeCommand;

class SeederMakeExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * Addon commands
     *
     * @var array
     */
    protected $commands = [
        SeederMakeCommand::class,
    ];

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
