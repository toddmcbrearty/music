<?php

namespace App\Http\Controllers;

use App\Band;
use App\Music\Audio\Audio;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Audio as Media;
use Intervention\Image\Facades\Image;

class AudioController extends Controller
{
    public function index() {

        $band = session('band');
        $audio = $band->audio;
      
        $tracks = $audio->each(function($item) {
            return $item;
        });

        return response()->json($tracks);

    }

    public function store(Request $request) {
        $band = session('band');

        $file = $request->file('file');
        $file->move($band->storage('audio.cache'), $file->getClientOriginalName());
        $filepath = $band->storage('audio.cache').'/'.$file->getClientOriginalName();

        $audio = new Audio;
        $audio = $audio->make($filepath);

        
        if($audio->filesGenerated) {
            foreach($audio->getGeneratedFiles() as $genfile) {
                $meta = $audio->loadMetadata($band->storage('audio').'/'.$genfile);

                $band->audioFiles()->create($meta);
            }

            $band->audio()->create([
                'title' => $request->title,
                'filename' => $audio->meta('uuid')
            ]);

            $image = $request->file('image');
            $sizes = [
                'small' => 150,
                'medium' => 350,
                'large' => 600,
            ];

            foreach($sizes as $name => $size) {
                $img = Image::make($image->getPathname())
                            ->resize($size, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                $img->save("{$band->storage('audio')}/{$audio->meta('uuid')}-$name.png", 90);
            }
        }

        unlink($filepath);
    }

    public function update(Request $request, $id) {

        $data = $request->only('title', 'lyrics', 'written_by');
        $audio = Media::where('filename', $id)->first();
        $audio->update($data);

        return response()->json($audio);
    }
}
