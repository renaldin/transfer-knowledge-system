<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note; // Sesuaikan dengan nama model Anda

class NoteSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100000; $i++) {
            Note::create([
                'name' => 'Dummy ' . ($i + 1),
            ]);
        }
    }
}
