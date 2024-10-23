<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pastikan pengguna memiliki izin untuk memperbarui jadwal pemeliharaan
        return $this->user()->can('update', $this->route('maintenance_schedule'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'item_name' => 'required|string|max:255', // Nama item pemeliharaan
            'description' => 'nullable|string|max:500', // Deskripsi pemeliharaan opsional
            'scheduled_date' => 'required|date|after_or_equal:today', // Tanggal pemeliharaan harus tanggal hari ini atau di masa depan
            'status' => 'required|string|in:planned,ongoing,completed,canceled', // Status jadwal pemeliharaan yang valid
        ];
    }

    /**
     * Custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'item_name' => 'Nama Item',
            'description' => 'Deskripsi Pemeliharaan',
            'scheduled_date' => 'Tanggal Pemeliharaan',
            'status' => 'Status Pemeliharaan',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'item_name.required' => 'Nama item harus diisi.',
            'item_name.string' => 'Nama item harus berupa teks.',
            'item_name.max' => 'Nama item tidak boleh lebih dari :max karakter.',
            'description.string' => 'Deskripsi pemeliharaan harus berupa teks.',
            'description.max' => 'Deskripsi pemeliharaan tidak boleh lebih dari :max karakter.',
            'scheduled_date.required' => 'Tanggal pemeliharaan harus diisi.',
            'scheduled_date.date' => 'Tanggal pemeliharaan harus berupa tanggal yang valid.',
            'scheduled_date.after_or_equal' => 'Tanggal pemeliharaan tidak boleh kurang dari hari ini.',
            'status.required' => 'Status pemeliharaan harus diisi.',
            'status.in' => 'Status pemeliharaan tidak valid.',
        ];
    }
}
