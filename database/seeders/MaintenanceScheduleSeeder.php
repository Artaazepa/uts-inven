<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaintenanceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data dari tabel maintenance_schedules
        DB::table('maintenance_schedules')->delete();

        $schedules = [
            [
                'item_name' => 'Meja Guru',
                'description' => 'Pengecekan kondisi meja, pengencangan sekrup, dan pembersihan.',
                'scheduled_date' => Carbon::createFromFormat('Y-m-d', '2024-12-15'),
                'status' => 'planned',
            ],
            [
                'item_name' => 'Kursi Roda Dua',
                'description' => 'Pemeriksaan kondisi kursi roda dua, pelumasan roda, dan pengecekan keseimbangan.',
                'scheduled_date' => Carbon::createFromFormat('Y-m-d', '2024-10-25'),
                'status' => 'planned',
            ],
            [
                'item_name' => 'Lemari Buku',
                'description' => 'Pengecekan kelayakan struktur lemari buku dan pembersihan debu.',
                'scheduled_date' => Carbon::createFromFormat('Y-m-d', '2024-11-05'),
                'status' => 'completed',
            ],
        ];

        foreach ($schedules as $schedule) {
            DB::table('maintenance_schedules')->insert([
                'item_name' => $schedule['item_name'],
                'description' => $schedule['description'],
                'scheduled_date' => $schedule['scheduled_date'],
                'status' => $schedule['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
