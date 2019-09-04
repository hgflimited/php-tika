<?php
/**
 * Created by PhpStorm.
 * User: sgarwood
 * Date: 20/03/19
 * Time: 22:49
 */

namespace HGF\Tika;


use InvalidArgumentException;

class DocumentParserManager
{
    protected $app;

    protected $parsers = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function parser($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->parsers[$name] = $this->get($name);
    }

    public function driver($driver = null)
    {
        return $this->parser($driver);
    }

    protected function get($name)
    {
        return $this->parsers[$name] ?? $this->resolve($name);
    }

    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if ($config === null) {
            throw new InvalidArgumentException("Document parser [{$name}] is not defined.");
        }
        $driverMethod = 'create' . ucfirst($config['driver']) . 'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        } else {
            throw new InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
        }
    }

    protected function getConfig($name)
    {
        return $this->app['config']["documentparsers.parsers.{$name}"];
    }

    public function getDefaultDriver()
    {
        return $this->app['config']['documentparsers.default'];
    }

    protected function createTikaDriver(array $config)
    {
//        TODO register tika on service container

        $tika = new Tika($config);

        $this->app['tika'] = $tika;

        return $tika;
    }
}
