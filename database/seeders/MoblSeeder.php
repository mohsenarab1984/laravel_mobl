<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Mediaable;
use App\Models\Mobl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
       
        $mobl1 = Mobl::factory()->create(['title'=>'moble 1']);
        $mobl2 = Mobl::factory()->create(['title'=>'moble 2']);
        $mobl3 = Mobl::factory()->create(['title'=>'moble 3']);

        
       




        
           }
}
