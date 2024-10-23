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
        // Mengambil data Maintenance Schedule dan diurutkan berdasarkan 'title'
        $maintenance_schedules = MaintenanceSchedule::all();

        return view('maintenance-schedule.index', compact('maintenance_schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceScheduleRequest $request)
    {
        // Membuat Maintenance Schedule baru
        MaintenanceSchedule::create($request->validated());

        return to_route('maintenance-schedule.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceScheduleRequest $request, MaintenanceSchedule $maintenanceSchedule)
    {
        // Mengupdate Maintenance Schedule yang sudah ada
        $maintenanceSchedule->update($request->validated());

        return to_route('maintenance-schedule.index')->with('success', 'Jadwal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        // Menghapus Maintenance Schedule
        $maintenanceSchedule->delete();

        return to_route('maintenance-schedule.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    /**
     * Export Maintenance Schedule data to Excel.
     */
   
    /**
     * Generate PDF for all Maintenance Schedules.
     */
    public function generatePDF()
    {
        // Otorisasi untuk mencetak semua jadwal pemeliharaan
        $this->authorize('print jadwal');

        // Mengambil semua jadwal pemeliharaan
        $schedules = MaintenanceSchedule::all();
        $institution = env('NAMA_INSTANSI', 'Instansi');

        // Generate PDF dengan semua jadwal
        $pdf = Pdf::loadView('maintenance-schedule.pdf', compact('schedules', 'institution'))->setPaper('a4');

        // Download PDF
        return $pdf->download('jadwal-maintenance.pdf');
    }

    /**
     * Generate PDF for a specific Maintenance Schedule.
     */
    public function generatePDFIndividually($id)
    {
        // Otorisasi untuk mencetak jadwal individu
        $this->authorize('print individual jadwal');

        // Mengambil jadwal pemeliharaan berdasarkan ID
        $schedule = MaintenanceSchedule::findOrFail($id);
        $institution = env('NAMA_INSTANSI', 'Instansi');

        // Generate PDF untuk jadwal individu
        $pdf = Pdf::loadView('maintenance-schedule.pdfone', compact('schedule', 'institution'))->setPaper('a4');

        // Download PDF
        return $pdf->download('jadwal-maintenance-individual.pdf');
    }
}
