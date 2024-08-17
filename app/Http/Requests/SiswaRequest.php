<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
            'tahun_pelajaran' => 'required|string|max:20',
            'nama' => 'required|string|max:50',
            'nisn' => 'required|string|max:20',
            'nis' => 'required|string|max:20',
            'tempat_tanggal_lahir' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Buddha,Khonghucu,Hindu,Katolik',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'nama_ayah' => 'required|string|max:50',
            'nama_ibu' => 'required|string|max:50',
            'pekerjaan_ayah' => 'required|string|max:50',
            'pekerjaan_ibu' => 'required|string|max:50',
            'no_hp_wali' => 'required|string|max:20',
            'diterima_di_kelas' => 'required|string|max:20',
            'angkatan' => 'required',
            'asal_sekolah' => 'required|string|max:20',
            'alamat_asal_sekolah' => 'required|string|max:255',
            'rapot_kelas7' => 'required|file',
            'rapot_kelas8' => 'required|file',
            'rapot_kelas9' => 'required|file',
            'ijazah' => 'required|file',
            'surat_Kelulusan' => 'required|file',
            'kk' => 'required|file',
            'akta_kelahiran' => 'required|file',
            'surat_pernyataan_calonPesertaDidik' => 'required|file',
            'surat_pernyataan_wali' => 'required|file',
            'surat_pernyataan_tidak_merokok' => 'required|file',
            'status_siswa' => 'required|in:Aktif,Tidak aktif',
        ];
    }
}
