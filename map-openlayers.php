<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class MapOpenlayersPlugin extends Plugin
{
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
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }
        // Enable the main events we are interested in
        $this->enable([
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0]
        ]);
        //add assets
        // $assets = $this->grav['assets'];

        // $assets->addJs('plugin://map-openlayers/assets/openlayers.js', ['loading' => 'defer', 'priority' => 90]);
        // $assets->addCss('plugin://map-openlayers/assets/openlayers.css', ['priority' => 90]);
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }
}
