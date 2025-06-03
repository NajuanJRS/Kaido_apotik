<?php

namespace App\Filament\Resources\RiwayatResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRiwayatRequest extends FormRequest
{
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
			'id_resep' => 'required|integer',
			'tanggal_diterima' => 'required|date',
			'tanggal_selesai' => 'required|date',
			'status' => 'required'
		];
    }
}
