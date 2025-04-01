import { Map, View, Feature } from 'ol'
import { Tile, Vector as VectorLayer } from 'ol/layer'
import { OSM, Vector as VectorSource } from 'ol/source'
import { useGeographic, fromLonLat } from 'ol/proj';
import { Point } from 'ol/geom';
import { Icon, Style } from 'ol/style';
import 'ol/ol.css'

useGeographic()

export { Map, View, Tile, OSM, Feature, Point, fromLonLat, VectorLayer, VectorSource, Icon, Style }
