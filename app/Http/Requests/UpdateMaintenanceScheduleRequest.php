<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceScheduleRequest extends FormRequest
{
    protected $errorBag = 'update';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('maintenance_schedule'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'item_name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:3|max:500',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'status' => 'required|string|in:planned,ongoing,completed,canceled',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'item_name.required' => 'Nama item harus diisi!',
            'item_name.string' => 'Nama item harus berupa karakter!',
            'item_name.min' => 'Nama item minimal :min karakter!',
            'item_name.max' => 'Nama item maksimal :max karakter!',

            'description.string' => 'Deskripsi harus berupa karakter!',
            'description.min' => 'Deskripsi minimal :min karakter!',
            'description.max' => 'Deskripsi maksimal :max karakter!',

            'scheduled_date.required' => 'Tanggal pemeliharaan harus diisi!',
            'scheduled_date.date' => 'Tanggal pemeliharaan harus berupa tanggal yang valid!',
            'scheduled_date.after_or_equal' => 'Tanggal pemeliharaan tidak boleh kurang dari hari ini!',

            'status.required' => 'Status pemeliharaan harus diisi!',
            'status.in' => 'Status pemeliharaan tidak valid!',
        ];
    }
}
