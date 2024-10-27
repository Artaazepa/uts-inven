<?php

namespace App\Http\Controllers;

use App\MaintenanceSchedule;
use App\Exports\MaintenanceSchedulesExport;
use App\Http\Requests\StoreMaintenanceScheduleRequest;
use App\Http\Requests\UpdateMaintenanceScheduleRequest;
use App\Http\Requests\MaintenanceScheduleImportRequest;
use App\Imports\MaintenanceSchedulesImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MaintenanceScheduleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MaintenanceSchedule::class, 'maintenance_schedule');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenance_schedules = MaintenanceSchedule::orderBy('id', 'ASC')->get()->map(function ($schedule) {
            $schedule->formatted_date = date('d-m-Y', strtotime($schedule->scheduled_date));
            return $schedule;
        });

        return view('maintenance-schedule.index', compact('maintenance_schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceScheduleRequest $request)
    {
        MaintenanceSchedule::create($request->validated());
        return to_route('maintenance-schedule.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceScheduleRequest $request, MaintenanceSchedule $maintenanceSchedule)
    {
        
        $maintenanceSchedule->update($request->validated());
        return to_route('maintenance-schedule.index')->with('success', 'Jadwal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->delete();
        return to_route('maintenance-schedule.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    /**
     * Export Maintenance Schedule data to Excel.
     */
    // public function export()
    // {
    //     return Excel::download(new MaintenanceSchedulesExport, 'maintenance-schedules-' . date('d-m-Y') . '.xlsx');
    // }

    /**
     * Import Maintenance Schedule data from Excel.
     */
    // public function import(MaintenanceScheduleImportRequest $request)
    // {
    //     Excel::import(new MaintenanceSchedulesImport, $request->file('file'));
    //     return to_route('maintenance-schedule.index')->with('success', 'Data jadwal berhasil diimpor!');
    // }

    /**
     * Generate PDF for all Maintenance Schedules.
     */
    // public function generatePDF()
    // {
    //     $this->authorize('print jadwal');
    //     $schedules = MaintenanceSchedule::all();
    //     $institution = env('NAMA_INSTANSI', 'Instansi');

    //     $pdf = Pdf::loadView('maintenance-schedule.pdf', compact('schedules', 'institution'))->setPaper('a4');
    //     return $pdf->download('jadwal-maintenance.pdf');
    // }

    // /**
    //  * Generate PDF for a specific Maintenance Schedule.
    //  */
    // public function generatePDFIndividually($id)
    // {
    //     $this->authorize('print individual jadwal');
    //     $schedule = MaintenanceSchedule::findOrFail($id);
    //     $institution = env('NAMA_INSTANSI', 'Instansi');

    //     $pdf = Pdf::loadView('maintenance-schedule.pdfone', compact('schedule', 'institution'))->setPaper('a4');
    //     return $pdf->download('jadwal-maintenance-individual.pdf');
    // }
}
?>
