<?php namespace App\Music\Audio\Traits;

use getID3 as Meta;

trait GetID3
{
    public function loadMetadata(string $path) {
        $getID3 = new Meta;
        $meta = $getID3->analyze($path);

        $return = array_only($meta, ['filesize', 'fileformat', 'error', 'filepath', 'filepathname']);
        $return ['filename'] = substr($meta['filename'], 0, strrpos($meta['filename'], '.'));
        $return ['fileextension'] = substr($meta['filename'], (strrpos($meta['filename'], '.')+1));
        $return ['seconds'] = ceil($meta['playtime_seconds']);

        return $return;
    }
}