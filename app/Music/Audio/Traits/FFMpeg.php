<?php namespace App\Music\Audio\Traits;

use FFMpeg\FFMpeg as FFMpegger;
use FFMpeg\Format\Audio\Flac;
use FFMpeg\Format\Audio\Mp3;
use Music\Audio\Format\Alac;
use Ramsey\Uuid\Uuid;

trait FFMpeg
{

    public function createAudioFiles()
    {
        $ffmpeg      = FFMpegger::create();
        $outputpath  = $this->audioMeta['filepath'];
        $this->audioMeta['uuid'] = Uuid::uuid4()->toString();

        //load the uploaded files
        $audio = $ffmpeg->open($this->audioMeta['filepath'].'/'.$this->audioMeta['filename'].'.'.$this->audioMeta['fileextension']);

        //grab the formats
        $formats = config('ffmpeg.formats');

        foreach ($formats as $format) {
            //create the format object
            $class = new $format['class'];
            $class->setAudioChannels(2)->setAudioKiloBitrate(256);

            //do the conversion
            $audio = $audio->save($class, "{$outputpath}/../{$this->audioMeta['uuid']}.{$format['extension']}");

            //save the converted file names
            $this->generatedAudioFiles[] = "{$this->audioMeta['uuid']}.{$format['extension']}";
        }

        //have to figure out the ffmpeg errors then i'll be able to actually use this
        $this->filesGenerated = true;

        return $this;
    }
}