<?php

namespace App\Http\Controllers\API;

use App\Maintenance;
use App\Http\Controllers\Controller;
use App\MaintenanceSchedule;
use Illuminate\Http\Response;

class MaintenanceScheduleController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $maintenanceSchedule
        ], Response::HTTP_OK);
    }
}
