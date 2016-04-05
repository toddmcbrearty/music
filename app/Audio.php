<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $primaryKey = 'filename';
    protected $fillable = [
        'title',
        'filename',
        'lyrics',
        'written_by',
    ];

    public function getFilenameAttribute() {
        return (string) $this->attribute['filename'];
    }
}
