<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $batchSize = 1000; // Inserta en lotes de 1000
        $total = 1000000;  // Total de registros a generar

        for ($i = 0; $i < $total; $i += $batchSize) {
            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $counter = $i + $j + 1;

                $data[] = [
                    'name' => 'Contacto ' . $counter,
                    'email' => 'contacto' . $counter . '@example.com',
                    'file' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('contacts')->insert($data);

            echo "Insertados: " . ($i + $batchSize) . "\n";
        }
    }
}
