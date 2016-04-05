<?php

use FFMpeg\Format\Audio\Flac;
use FFMpeg\Format\Audio\Mp3;
use FFMpeg\Format\Audio\Vorbis;
use Music\Audio\Format\Alac;

return [
    'formats' => [
        'flac' => [
            'class'     => Flac::class,
            'extension' => 'flac',
        ],
        'alac' => [
            'class'     => Alac::class,
            'extension' => 'm4a',
        ],
        'mp3'  => [
            'class'     => Mp3::class,
            'extension' => 'mp3',
        ],
        'ogg'  => [
            'class'     => Vorbis::class,
            'extension' => 'ogg',
        ],
    ],
];