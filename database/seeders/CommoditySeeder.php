<?php

namespace Database\Seeders;

use App\Commodity;
use App\CommodityLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the commodities table
        DB::table('commodities')->delete();

        $commodity_locations = CommodityLocation::all();

        // Check if there are commodity locations to avoid foreign key errors
        if ($commodity_locations->count() === 0) {
            $this->command->info('No commodity locations found. Please seed the CommodityLocationSeeder first.');
            return;
        }

        $commodities = [
            'Meja', 'Kursi', 'Kursi Roda Dua', 'Lemari Kamera', 'Lemari Buku',
            'Lemari Sepatu', 'Penghapus Papan Tulis Putih', 'Meja Guru', 'Kursi Guru',
            'Rak Sepatu', 'Rak Peralatan Sekolah', 'Rak Helm', 'Rak Sepatu Guru',
            'Rak Helm Guru', 'Papan Tulis Putih', 'Papan Tulis Hitam', 'Kipas Dinding',
            'Kipas Angin Portabel', 'Kipas Angin'
        ];

        $brands = [
            'IKEA', 'Livien', 'iFurnholic', 'Red Sun', 'JYSXK',
            'Olympic', 'Informa', "Dove's", 'Funika', 'Atria', 'Vivere', 'Samsung'
        ];

        

        foreach ($commodities as $commodity) {
            DB::table('commodities')->insert([
                'school_operational_assistance_id' => mt_rand(1, 2),
                // Instead of random ID, use actual ID from commodity_locations
                'commodity_location_id' => $commodity_locations->random()->id,
                'item_code' => 'BRG-' . mt_rand(1000, 9000) . mt_rand(100, 900),
                'name' => $commodity,
                'brand' => $brands[array_rand($brands)],
                
                'year_of_purchase' => mt_rand(2010, date('Y')),
                'condition' => mt_rand(1, 3),
                'quantity' => mt_rand(50, 200),
                'price' => mt_rand(5000, 500000),
                'price_per_item' => mt_rand(2500, 150000),
                'note' => 'Keterangan barang',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
