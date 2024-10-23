<?php

namespace App\Http\Controllers\API;

use App\MaintenanceSchedule;
use App\Http\Controllers\Controller;
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
