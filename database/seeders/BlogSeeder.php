<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blog = new Blog();
        $blog->title = fake()->sentence();
        $blog->body = fake()->paragraph(5);
        $blog->save();
    }
}
