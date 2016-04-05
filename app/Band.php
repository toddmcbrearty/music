<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Band extends Model
{
    protected $fillable = [
        'name',
        'biography',
        'profile_pointer',
    ];

    public function members() {
        return $this->hasMany('App\BandMember');
    }

    public function audio() {
        return $this->hasMany('App\Audio');
    }

    public function audioFiles() {
        return $this->hasMany('App\AudioFiles');
    }

    public function media() {
        return $this->belongsToMany('App\Media');
    }

    public function make($bandName)
    {
        return $this->create([
            'name' => $bandName,
            'profile_pointer' => strtolower(str_replace(' ', '-', $bandName)),
        ]);
    }
    
    public function storage($key = null) {
        $path = storage_path("media/{$this->id}");
        $storage = [
            'root' => $path,
            'audio' => $path.'/audio',
            'audio.cache' => $path.'/audio/cache',
        ];

        if($key)
            return $storage[$key];

        return $storage;
    }
}
