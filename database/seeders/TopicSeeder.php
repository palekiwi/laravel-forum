<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);
        Topic::create([
            'name' => 'Vue',
            'slug' => 'vue',
        ]);
        Topic::create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);
    }
}
