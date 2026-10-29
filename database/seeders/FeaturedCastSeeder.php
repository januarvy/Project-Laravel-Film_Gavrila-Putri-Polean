<?php

namespace Database\Seeders;

use App\Models\Cast;
use Illuminate\Database\Seeder;

class FeaturedCastSeeder extends Seeder
{
    public function run(): void
    {
        Cast::updateOrCreate(
            ['name' => 'Gavrila Putri Polean'],
            [
                'age' => 17,
                'bio' => '── .✦ Angelic!',
            ]
        );
    }
}
