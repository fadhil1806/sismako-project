<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PklAdminSekolahRequest extends FormRequest
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
            'tahun_ajaran' => 'required|string|max:10',
            'nama_perusahaan' => 'required|string|max:40',
            'path_foto_siswa_dan_perusahaan' => 'sometimes|file',
            'path_foto_mov' => 'sometimes|file',
        ];
    }
}
