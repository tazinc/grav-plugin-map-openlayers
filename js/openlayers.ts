import { Map, View } from 'ol'
import { Tile } from 'ol/layer'
import { OSM } from 'ol/source'
import { useGeographic } from 'ol/proj';
import 'ol/ol.css'

useGeographic()

export { Map, View, Tile, OSM }
