<?php
namespace Grav\Plugin\Shortcodes;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class MapOpenlayersMarkerShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('a-markers', function(ShortcodeInterface $sc) {
            $s = $sc->getContent();
            $twig = $this->grav['twig'];
            // process any twig variables in the markercode
            $s = $twig->processString($s);
            $s = preg_replace('/\\<\\/?p.*?\\>/i','',$s);
            $json = json_decode( html_entity_decode($s) );
            if ( $json == Null || count($json) < 1)  {
                return Null; // Not valid json or empty array, so retun nothing. Only map will be shown
            }
            $params = $sc->getParameters();
            foreach ($params as $k => $v){
                if (is_string($v)) $params[$k] = $twig->processString($v);
            }
            $iDef = isset($params['icon']) ?: '';
            $mDef = isset($params['color']) ? $params['color'] : 'white';
            $tDef = '';
            $mks = [];
            foreach ($json as $k => $v ) {
                $mks[$k] = [
                    'lat' => $v->{'lat'},
                    'lng' => $v->{'lng'},
                    'title' => isset($v->{'title'})? htmlentities($v->{'title'}) : '',
                    'icon' => isset($v->{'icon'})? htmlentities($v->{'icon'}) : $iDef,
                    'color' => isset($v->{'color'})? htmlentities($v->{'color'}) : $mDef,
                    'text' => isset($v->{'text'})? htmlentities($v->{'text'}) : $tDef
                ];
            }
            $output = $twig->processTemplate('partials/mapopenlayersmarker.html.twig',
                [
                    'mks' => $mks
                ]);
            return $output;
        });
    }
}
