<?php

namespace App\Filament\Resources\EResepDetailResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEResepDetailRequest extends FormRequest
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
			'id_obat' => 'required',
			'jumlah' => 'required|integer',
			'aturan_pakai' => 'required|string',
			'total_harga' => 'required|numeric'
		];
    }
}
