<?php namespace Defr\SeederMakeExtension\Stream\Console\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class for write entity seeder.
 *
 * @package    defr.extension.seeder_make
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
class WriteEntitySeeder
{

    /**
     * The addon instance.
     *
     * @var Addon
     */
    protected $addon;

    /**
     * The stream slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * Create a new WriteEntitySeeder instance.
     *
     * @param Addon   $addon
     * @param $slug
     */
    public function __construct(Addon $addon, $slug)
    {
        $this->slug  = $slug;
        $this->addon = $addon;
    }

    /**
     * Handle the command.
     *
     * @param Parser     $parser
     * @param Filesystem $filesystem
     */
    public function handle(Parser $parser, Filesystem $filesystem)
    {
        $entities  = camel_case($this->slug);
        $suffix    = ucfirst($entities);
        $entity    = str_singular($suffix);
        $class     = "{$entity}Seeder";
        $namespace = $this->addon->getTransformedClass("{$entity}");

        $path = $this->addon->getPath("src/{$entity}/{$entity}Seeder.php");

        $template = $filesystem->get(dirname(dirname(dirname(dirname(__DIR__))))
            . '/resources/stubs/entity/seeder.stub');

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse(
            $template,
            compact('class', 'namespace', 'entity', 'entities'))
        );
    }
}
