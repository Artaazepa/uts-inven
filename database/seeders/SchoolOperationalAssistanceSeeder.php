<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\SchoolOperationalAssistance;

class SchoolOperationalAssistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data di tabel ini terlebih dahulu
        DB::table('school_operational_assistances')->delete();

        $assistances = [
            ['name' => 'BOSDA', 'description' => 'Bantuan Operasional Sekolah Daerah'],
            ['name' => 'BOSNAS', 'description' => 'Bantuan Operasional Sekolah Nasional'],
        ];

        foreach ($assistances as $assistance) {
            SchoolOperationalAssistance::firstOrCreate([
                'name' => $assistance['name'],
            ], [
                'description' => $assistance['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
