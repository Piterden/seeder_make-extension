<?php namespace Defr\SeederMakeExtension\Addon\Console\Command;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\StreamCollection;
use Anomaly\Streams\Platform\Support\Parser;
use Illuminate\Filesystem\Filesystem;

/**
 * Class for write addon seeder.
 *
 * @package    defr.extension.seeder_make
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
class WriteAddonSeeder
{

    /**
     * The addon path.
     *
     * @var string
     */
    private $path;

    /**
     * The addon type.
     *
     * @var string
     */
    private $type;

    /**
     * The addon slug.
     *
     * @var string
     */
    private $slug;

    /**
     * The vendor slug.
     *
     * @var string
     */
    private $vendor;

    /**
     * The streams collection.
     *
     * @var StreamCollection
     */
    private $streams;

    /**
     * Create a new WriteAddonSeeder instance.
     *
     * @param string           $path    The path
     * @param string           $type    The type
     * @param string           $slug    The slug
     * @param string           $vendor  The vendor
     * @param StreamCollection $streams The streams
     */
    public function __construct(
        $path, $type, $slug, $vendor, StreamCollection $streams
    )
    {
        $this->path    = $path;
        $this->slug    = $slug;
        $this->type    = $type;
        $this->vendor  = $vendor;
        $this->streams = $streams;
    }

    /**
     * Handle the command.
     *
     * @param Parser     $parser
     * @param Filesystem $filesystem
     */
    public function handle(Parser $parser, Filesystem $filesystem)
    {
        $slug   = ucfirst(camel_case($this->slug));
        $type   = ucfirst(camel_case($this->type));
        $vendor = ucfirst(camel_case($this->vendor));
        $addon  = $slug . $type;

        $class     = $addon . 'Seeder';
        $namespace = "{$vendor}\\{$addon}";
        $uses      = $this->getUses($namespace)->implode("\n");
        $calls     = $this->getCalls()->implode("\n        ");

        $path     = "{$this->path}/src/{$class}.php";
        $template = $filesystem->get(dirname(dirname(dirname(dirname(__DIR__))))
            . '/resources/stubs/addons/seeder.stub');

        $filesystem->makeDirectory(dirname($path), 0755, true, true);

        $filesystem->put($path, $parser->parse(
            $template,
            compact('namespace', 'class', 'uses', 'calls')
        ));
    }

    /**
     * Gets the uses.
     *
     * @param  string     $namespace The namespace
     * @return Collection The uses.
     */
    private function getUses(string $namespace)
    {
        return $this->streams->map(
            function (StreamInterface $stream) use ($namespace)
            {
                $entity = $this->getName($stream->getSlug());

                return "use {$namespace}\\{$entity}\\{$entity}Seeder;";
            }
        );
    }

    /**
     * Gets the calls.
     *
     * @return Collection The calls.
     */
    private function getCalls()
    {
        return $this->streams->map(
            function (StreamInterface $stream)
            {
                $entity = $this->getName($stream->getSlug());

                return "\$this->call({$entity}Seeder::class);";
            }
        );
    }

    /**
     * Gets the name.
     *
     * @param  string $slug The slug
     * @return string The name.
     */
    private function getName(string $slug)
    {
        return ucfirst(str_singular($slug));
    }
}
