# Map OpenLayers Plugin

The **Map OpenLayers** Plugin is an extension for [Grav CMS](https://getgrav.org/), which makes use of the [OpenLayers JavaScript library](https://openlayers.org/) and data from the popular map data provider [OpenStreetMap](https://www.openstreetmap.org). It allows you to add OpenLayers maps with markers to your pages. Additionally, it allows proxying the map data locally to avoid sending requests to the OpenStreetMap servers, thus preventing direct IP tracking by OpenStreetMap and therefore increasing privacy.

## Installation

Installing the plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install map-openlayers

This will install the Map Leaflet plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/map-openlayers`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `map-openlayers`. You can find these files on [GitHub](https://github.com/finanalyst/grav-plugin-map-leaflet) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/map-openlayers

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration