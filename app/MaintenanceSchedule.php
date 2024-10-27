<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    /**
     * Get the items associated with the maintenance schedule.
     */
    public function items()
    {
        return $this->hasMany(Commodity::class); // Sesuaikan dengan nama model yang sesuai
    }
}
