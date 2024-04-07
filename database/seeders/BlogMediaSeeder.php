<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Mediaable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blog1 = Blog::first();

        $mediaable = new Mediaable();
        $mediaable->mediaable_type=Blog::class;

        $mediaable->media_id = 1;
        $mediaable->mediaable_id = $blog1->id;  
        $mediaable->save();

        $mediaable = new Mediaable();
        $mediaable->mediaable_type=Blog::class;

        $mediaable->media_id = 3;
        $mediaable->mediaable_id = $blog1->id;   
        $mediaable->save();
    }
}
