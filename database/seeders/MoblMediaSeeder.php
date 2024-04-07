<?php

namespace Database\Seeders;

use App\Models\Mediaable;
use App\Models\Mobl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoblMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $mobl1 = Mobl::first();

        $mediaable = new Mediaable();
        $mediaable->mediaable_type=Mobl::class;

        $mediaable->media_id = 1;
        $mediaable->mediaable_id = $mobl1->id;  
        $mediaable->save();

        $mediaable = new Mediaable();
        $mediaable->mediaable_type=Mobl::class;

        $mediaable->media_id = 2;
        $mediaable->mediaable_id = $mobl1->id;   
        $mediaable->save();
    }
}
