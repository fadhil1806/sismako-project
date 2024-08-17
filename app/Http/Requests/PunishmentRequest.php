<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PunishmentRequest extends FormRequest
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
            'angkatan' => 'required|integer',
             'tanggal' => 'required|date',
             'id_siswa' => 'required|integer',
             'tindak_lanjut' => 'required',
             'jenis_pelanggaran' => 'required|string|max:75',
             'kronologi' => 'required|string',
             'pengawasan_guru' => 'required|string|max:50',
             'pengurangan_point' => 'required|integer',
             'path_dokumen' => 'nullable|file|max:2048',
        ];
    }
}
