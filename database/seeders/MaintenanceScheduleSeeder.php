<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\MaintenanceSchedule; // Sesuaikan dengan lokasi model Anda
use Carbon\Carbon;

class MaintenanceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data contoh jadwal pemeliharaan dengan status
        $maintenanceSchedules = [
            [
                'item_name' => 'Meja Guru', 
                'description' => 'Pengecekan kondisi meja, pengencangan sekrup, dan pembersihan.',
                'scheduled_date' => Carbon::createFromFormat('Y-m-d', '2024-12-15'),
                'status' => 'planned', // Menggunakan status yang sesuai
            ],
            [
                'item_name' => 'Kursi Roda Dua', 
                'description' => 'Pemeriksaan kondisi kursi roda dua, pelumasan roda, dan pengecekan keseimbangan.',
                'scheduled_date' => Carbon::createFromFormat('Y-m-d', '2024-10-25'),
                'status' => 'planned', // Menggunakan status yang sesuai
            ],
            [
                'item_name' => 'Lemari Buku', 
                'description' => 'Pengecekan kelayakan struktur lemari buku dan pembersihan debu.',
                'scheduled_date' => Carbon::createFromFormat('Y-m-d', '2024-11-05'),
                'status' => 'completed', // Menggunakan status yang sesuai
            ],
        ];

        // Insert data ke dalam tabel maintenance_schedules
        foreach ($maintenanceSchedules as $schedule) {
            MaintenanceSchedule::create($schedule);
        }
    }
}
