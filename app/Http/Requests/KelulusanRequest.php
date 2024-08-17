<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelulusanRequest extends FormRequest
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
            'tahun_pelajaran' => 'required|string|max:40',
            'id_siswa' => 'required|integer',
            'jurusan' => 'required|string|max:30',
            'tanggal_kelulusan' => 'required|date',
            'angkatan' => 'required|integer',
            'karir_selanjutnya' => 'required|string|max:100',
            'no_hp' => 'required|max:20',
            'email' => 'required|email|max:50',
        ];
    }
}
