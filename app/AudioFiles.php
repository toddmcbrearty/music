<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioFiles extends Model
{
    protected $fillable = [
        'filesize',
        'filepath',
        'fileformat',
        'seconds',
        'filename',
        'fileextension',
        'band_id',
    ];
    protected $hidden = [
        'id',
        'band_id',
    ];

    public function getFilenameAttribute() {
        return (string) $this->attributes['filename'];
    }
}
