<?php namespace app\Music\Audio\Interfaces;

interface AudioInterface
{
    public function make(string $audioPath);
    public function getGeneratedFiles();
    public function loadMetadata(string $path);
    public function createAudioFiles();
}