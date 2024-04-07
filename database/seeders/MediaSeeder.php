<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=7;++$i){
                $media = new Media();
                $media->url = 'mobl_'.$i.'.jpg';
                $media->save();
    
        }
    }
}
