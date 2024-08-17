<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MutasiRequest extends FormRequest
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
            'nama' => 'required|string|max:50',
            'status' => 'required|in:Guru,Siswa',
            'mutasi' => 'required|in:Masuk,Keluar',
            'tanggal_mutasi' => 'required|date',
            'asal_sekolah' => 'nullable|string|max:50',
            'tujuan_berikutnya' => 'nullable|string|max:50',
            'alasan' => 'required|string',
            'path_dokumen_pendukung_tambahan' => 'required|file',
        ];
    }
}
