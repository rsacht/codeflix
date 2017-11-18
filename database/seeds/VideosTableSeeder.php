<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $series */
        $series = \CodeFlix\Models\Serie::all();
        factory(\CodeFlix\Models\Video::class, 100)
            ->create()
            ->each(function($video)use($series){
                $num = rand(1,3);
                if($num%2==0){
                    //Série com Vídeo
                    $serie = $series->random();
                    $video->serie_id = $serie->id;
                    $video->serie()->associate($serie);
                    $video->save();
                }
            });
    }
}
