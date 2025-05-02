<?php

namespace Database\Seeders;

use App\Models\PublicData as ModelsPublicData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsPublicData::factory(10)->create();
    }
}
