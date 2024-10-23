<?php

namespace App\Http\Requests;

use App\MaintenanceSchedule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceScheduleRequest extends FormRequest
{
    protected $errorBag = 'store';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'item_name' => 'required|string|max:255', // Nama jadwal pemeliharaan
        'description' => 'nullable|string|max:500',
        'scheduled_date' => 'required|date|after_or_equal:today',
        'status' => 'required|string|in:planned,ongoing,completed,canceled',
    ];
}


    /**
     * Custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'title' => 'Judul Jadwal',
            'description' => 'Deskripsi Jadwal',
            'scheduled_date' => 'Tanggal Jadwal',
            'status' => 'Status Jadwal',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul jadwal harus diisi.',
            'title.string' => 'Judul jadwal harus berupa teks.',
            'title.max' => 'Judul jadwal tidak boleh lebih dari :max karakter.',
            'description.string' => 'Deskripsi jadwal harus berupa teks.',
            'description.max' => 'Deskripsi jadwal tidak boleh lebih dari :max karakter.',
            'scheduled_date.required' => 'Tanggal jadwal harus diisi.',
            'scheduled_date.date' => 'Tanggal jadwal harus berupa tanggal yang valid.',
            'scheduled_date.after_or_equal' => 'Tanggal jadwal tidak boleh kurang dari hari ini.',
            'status.required' => 'Status jadwal harus diisi.',
            'status.in' => 'Status jadwal tidak valid.',
        ];
    }
}
