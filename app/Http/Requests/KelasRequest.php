<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
            'id_siswa' => 'required|unique:data_kelas,id_siswa',
            'tahun_pelajaran' => 'required|string|max:20',
            'kelas' => 'nullable|in:X,XI,XII,XIII',
            'jurusan' => 'required|string|max:50',
            'angkatan' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id_siswa.unique' => 'Nama siswa sudah digunakan pada kelas lain',
        ];
    }
}
