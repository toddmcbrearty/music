<?php namespace Music\Audio\Format;

use FFMpeg\Format\Audio\DefaultAudio;

/**
 * The Alac audio format
 */
class Alac extends DefaultAudio
{
    public function __construct($audioCodec = 'alac')
    {
        $this->setAudioCodec($audioCodec);
    }


    public function getAvailableAudioCodecs()
    {
        return array('alac');
    }

}
