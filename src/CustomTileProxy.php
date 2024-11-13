<?php

namespace Grav\Plugin\MapOpenlayers\TileProxy;

use Grav\Common\Grav;

class CustomTileProxy extends TileProxy
{
    public function __construct(
        private Grav $grav,
        private string $prefix = '/tile_proxy',
    )
    {
        $this->setCacheDir($this->grav['locator']->findResource('user-data://', true) . DS . 'map-openlayers' . DS . 'tile-cache');
        $this->setLogDir($this->grav['locator']->findResource('log://', true) . DS . 'map-openlayers.log');
    }

    protected function getParameters(): array
    {
        $path_only = $this->grav['uri']->path();
        // strip the prefix if it is present
        if (strpos($path_only, $this->prefix) === 0) {
            $path_only = substr($path_only, strlen($this->prefix));
        }
        $parts = explode("/", $path_only);
        array_shift($parts);
        return $parts;
    }
}
