# Map OpenLayers Plugin
[![Build Status](https://github.com/tazinc/grav-plugin-map-openlayers/actions/workflows/quality-workflow.yml/badge.svg)](https://github.comtazinc/grav-plugin-map-openlayers/actions?workflow=Quality+Build)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/4801382c78e446ca81f46b21de3f35a3)](https://app.codacy.com/gh/tazinc/grav-plugin-map-openlayers/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
[![Latest](https://img.shields.io/github/release/tazinc/grav-plugin-map-openlayers.svg)](https://github.com/tazinc/grav-plugin-map-openlayers)
![Snyk](https://snyk.io/test/github/tazinc/grav-plugin-map-openlayers/badge.svg)

The **Map OpenLayers** Plugin is an extension for [Grav CMS](https://getgrav.org/), which makes use of the [OpenLayers JavaScript library](https://openlayers.org/) and data from the popular map data provider [OpenStreetMap](https://www.openstreetmap.org). It allows you to add OpenLayers maps with markers to your pages. Additionally, it allows proxying the map data locally to avoid sending requests to the OpenStreetMap servers, thus preventing direct IP tracking by OpenStreetMap and therefore increasing privacy.

## Installation

Installing the plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install map-openlayers

This will install the Map OpenLayers plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/map-openlayers`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `map-openlayers`. You can find these files on [GitHub](https://github.com/gschafra/grav-plugin-map-openlayers) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/map-openlayers

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the user/plugins/map-openlayers/map-openlayers.yaml to user/config/plugins/map-openlayers.yaml and only edit that copy.

Here is the default configuration and an explanation of available options:

enabled: true
provider: osm
variant:
apikey:
tileProxy:
  enabled: false

    provider If the Admin plugin is used, then three provider options are provided.
        osm (OpenStreetMap) - no further options are needed
        thunderforest - two further options are given
            apikey - the provider requires an apikey, which for hobbyists is free.
            variant - the style of the map. A list of available options is given (old t-style parameter is deprecated).
        mapbox
            apikey - as above
            variant - as above (old m-style parameter is deprecated).
    tileProxy If you want to use a local tile proxy, set enabled to true. The default is false.

Note that if you use the admin plugin, a file with your configuration, and named map-openlayers.yaml will be saved in the user/config/plugins/ folder once the configuration is saved in the admin.

## Usage

The following example demonstrates how to embed an interactive map and place on it two sets of markers.

The plugin provides two shortcodes:
- `[map-openlayers]`
    - options:
        - lat -- the latitude of the centre of the map, defaults to 51.505 (London).
        - lng -- the longitude of the centre of the map  defaults to -0.09
        - zoom -- an integer from 1-24, see OpenLayers documentation. Defaults to 13.
        - width -- the width in browser coordinates for the map, without a class defaults to 100% (see below).
        - height -- the height in browser coordinates, without a class defaults to 530px (see below).
        - scale -- is either present or not present in shortcode. If present, then a Scale is shown; if not, no Scale is shown.
        - mapname -- the name of the map (id of the wrapping div). Allowes multiple maps on the same page. Defaults to 'map'.
        - variant -- override the variant configuration (old style option is deprecated).
        - classes -- adds value of `classes` to the **class** attribute of the **div** containing the map. Defaults to ''.
            - If `classes` is defined, then it is assumed one of the classes sets the *width* and *height* of the div (to allow for responsive map sizing). *width* and *height* must be set by a class in order for the map to be generated.
    - contents:
        - Empty, in which case only a map is generated.
        - A set of `marker` codes.
- `[a-markers]`
    - options that if they are included in the shortcode become the default for each marker:
        - `markerColor` -- one of colors listed below  (default = 'blue')
        -` iconColor` -- an HTML colour code, (default = 'white')
    - content between opening and closing shortcodes:
        - A JSON **Array** of **Hash**, eg
            `{"title": "popup title", "lat": 122.222, "lng": 22.9, "markerColor": "red" , "icon": "coffee" }`
        - `lat` and `lng` are mandatory, and the others are optional. If not included, the default value is given to them.
            - `title` -- the text for the popup of the marker (default = '')
            - `text` -- the text inside the marker (default = '') Should be kept short.
            - `markerColor` and ` iconColor` can be set in the hash or a default set in the shortcode.

### Example

e.g. in a default page like /user/pages/01.map/default.md

```markdown

---
title: 'Find us'
cache_enable: false
shortcode-core:
    active: true
---

[map-openlayers lat=9.1729057 lng=47.6662855 zoom=17 mapname=neighbourhood]
[a-markers markerColor="darkblue" iconColor="white" ] [{ "lat": 37.7749, "lng": -122.4194, "icon": "home", "title": "Home Position" } ]
[/a-markers]
[/map-openlayers]

```

### Comments
- cache_enable should be set to false as there has to be a call to the tile provider to get the data.
- Any of the fontawesome icons can be included as markers.
- Any alphanumeric text can be included, but too many characters > 3? will be ugly.
- OpenStreetMap is the repository for map tiles, OpenLayers is the library for managing the map tiles. However, styling the maps is subjective and there are multiple providers, such as Thunderforest and MapBox.

### Disclaimer
The coordinates in this illustration have no meaning.

### Limitations
- N/A

## Credits

- Awesome work by OpenLayers, OpenStreetMap, Thunderforest and MapBox.
- [Richard Hainsworth](https://github.com/finanalyst) - for the awesome [map-marker-leaflet](https://github.com/finanalyst/grav-plugin-map-marker-leaflet) plugin, from which I've got my inspiration.

## To Do