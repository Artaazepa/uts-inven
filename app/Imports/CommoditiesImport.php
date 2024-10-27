<?php

namespace App\Imports;

use App\Commodity;
use App\CommodityLocation;
use App\SchoolOperationalAssistance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CommoditiesImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $commodity_location = CommodityLocation::where('name', $row['lokasi'])->first();
        $school_operational = SchoolOperationalAssistance::where('name', $row['asal_perolehan'])->first();

        return new Commodity([
            'item_code' => $row['kode_barang'],
            'name' => $row['nama_barang'],
            'brand' => $row['merek'],
            'school_operational_assistance_id' => $school_operational->id,
            'commodity_location_id' => $commodity_location->id,
            'year_of_purchase' => $row['tahun_pembelian'],
            'condition' => $this->translateConditionNameToNumber($row['kondisi']),
            'quantity' => $row['kuantitas'],
            'price' => $row['harga'],
            'price_per_item' => $row['harga_satuan'],
            'note' => $row['keterangan']
        ]);
    }

    /**
     * Translate condition name to the corresponding number.
     */
    public function translateConditionNameToNumber($conditionName)
    {
        $conditionName = strtolower($conditionName); // Ubah ke huruf kecil
        return match ($conditionName) {
            'baik' => 1,
            'kurang baik' => 2,
            'rusak berat' => 3,
            default => null, // Tambahkan default untuk menangani kasus yang tidak terduga
        };
    }

    /**
     * Specify the unique column used for upsert operations.
     */
    public function uniqueBy()
    {
        return 'item_code';
    }
}
