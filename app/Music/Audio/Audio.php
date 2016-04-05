<?php namespace App\Music\Audio;

use App\Music\Audio\Interfaces\AudioInterface as AudioContract;
use App\Music\Audio\Traits\FFMpeg;
use App\Music\Audio\Traits\GetID3;
use Illuminate\Support\Facades\Storage;

class Audio implements AudioContract
{
    use FFMpeg, GetID3;

    private $storage;
    private $audioMeta;
    private $generatedAudioFiles = [];
    public  $filesGenerated      = false;

    /**
     * Audio constructor.
     */
    public function __construct()
    {
        $this->storage = Storage::disk('media');
    }

    public function make(string $audioPath)
    {
        $this->audioMeta = $this->loadMetadata($audioPath);
        $this->createAudioFiles();

        return $this;
    }

    public function getGeneratedFiles()
    {
        return $this->generatedAudioFiles;
    }

    public function meta($key = null)
    {
        if ( ! is_null($key)) {
            if (array_key_exists($key, $this->audioMeta))
                return $this->audioMeta[$key];
        }

        return $this->audioMeta;
    }

}