<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Page\Page;
use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Plugin\MapOpenlayers\TileProxy\MapStyle;
use RocketTheme\Toolbox\Event\Event;
use Grav\Plugin\MapOpenlayers\TileProxy\CustomTileProxy;

class MapOpenlayersPlugin extends Plugin
{
    private Page $currentPage;

    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require_once __DIR__ . '/vendor/autoload.php';
    }

    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $events = [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onPageContentRaw' => ['onPageContentRaw', 1000],
            'onPageContentProcessed' => ['onPageContentProcessed', 1000],
        ];

        // Register tile proxy handling if configured
        /** @var Uri $uriPath */
        $uriPath = $this->grav['uri']->path();
        $config = $this->config();

        $route = $config['tile_proxy_route'] ?? '/tile_proxy';

        // if $uriPath starts with $route, enable the tile proxy
        if ($route && strpos($uriPath, $route) === 0) {
            $this->enable([
                'onPageInitialized' => ['onPageInitialized', 0]
            ]);
        }

        // Enable the main events we are interested in
        $this->enable($events);
        //add assets
        $assets = $this->grav['assets'];

        $assets->addJs('plugin://map-openlayers/assets/openlayers.js', ['loading' => 'defer', 'priority' => 90]);
        $assets->addCss('plugin://map-openlayers/assets/openlayers.css', ['priority' => 90]);
    }

    /**
     * Send user to a random page
     */
    public function onPageInitialized(): void
    {
        $style_osm = new MapStyle("osm");
        $style_osm->setMirrors(array("http://a.tile.openstreetmap.org", "http://b.tile.openstreetmap.org", "http://c.tile.openstreetmap.org"));

        //$style_osm->setEffectModulate(100, 50, 100);
        //$style_osm->setEffectSepia(90);
        //$style_osm->setEffectNegate();

        $tileproxy = new CustomTileProxy($this->grav);
        $tileproxy->addStyle($style_osm);
        $tileproxy->setLogLevel(CustomTileProxy::LOGLEVEL_OFF);
        $tileproxy->handle();
        exit;
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }

    /* Detect which page is being processed, even if it is in a collection.
     * We store it so that our shortcode can use it.
     */
    public function onPageContentRaw(Event $event)
    {
        $this->currentPage = $event['page'];
    }

    public function onPageContentProcessed(Event $event)
    {
        $this->currentPage = $event['page'];
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }
}
