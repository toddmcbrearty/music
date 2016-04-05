<?php

use App\Music\Audio\Audio;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AudioConverterTest extends TestCase
{

    private $audio;
    private $audioPath;

    public function setUp()
    {
        parent::setUp();
        $this->audio     = new Audio;
        $this->audioPath = storage_path('media/tests/audio');
        $this->songTitle     = 280;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSetAudio()
    {
        $audio = $this->audio->loadAudio("{$this->audioPath}/{$this->songTitle}.mp3");
        
        $this->assertTrue( ! isset($audio['error']));
    }
    
    public function testCreateOtherAudioFiles() {
        $audio = $this->audio->loadAudio("{$this->audioPath}/{$this->songTitle}.mp3");
    
        
    }
}
