<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <div class="container mt-6">
        <a href="{{route('siswa.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('siswa.update', $siswa->id)}}" id="multiStepForm" enctype="multipart/form-data">
            @csrf
            <div id="step-1">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Fadhil Rabbani" value="{{old('nama', $siswa->nama)}}">
                            @error('nama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" name="tempat_tanggal_lahir" placeholder="Jakarta" value="{{old('tempat_tanggal_lahir', $siswa->tempat_tanggal_lahir)}}">
                            @error('tempat_tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}">
                            @error('tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tahun Pelajaran</label>
                            <input type="text" class="form-control" autocomplete="off" placeholder="2024-2025" name="tahun_pelajaran" value="{{old('tahun_pelajaran', $siswa->tahun_pelajaran)}}">
                            @error('tahun_pelajaran')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" value="{{old('jenis_kelamin', $siswa->jenis_kelamin)}}">
                                <option value="Laki-laki" selected>Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <select class="form-control" name="agama" value="{{old('agama', $siswa->agama)}}">
                                <option value="Islam" selected>Islam</option>
                                <option value="Kristen">Kristen</option>
                            </select>
                            @error('agama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="4" name="alamat">{{ str_replace('=', '', old('alamat', $siswa->alamat)) }}</textarea>
                            @error('alamat')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-2" class="d-none">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" placeholder="" value="{{old('nama_ayah', $siswa->nama_ayah)}}">
                            @error('nama_ayah')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Karyawan swasta" value="{{old('pekerjaan_ayah', $siswa->pekerjaan_ayah)}}">
                            @error('pekerjaan_ayah')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" placeholder="" value="{{old('nama_ibu', $siswa->nama_ibu)}}">
                            @error('nama_ibu')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" placeholder="Ibu Rumah Tangga" value="{{old('pekerjaan_ibu', $siswa->pekerjaan_ibu)}}">
                            @error('pekerjaan_ibu')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div>
                            <label class="form-label">No. Handphone Wali Siswa</label>
                            <input type="number" class="form-control" name="no_hp_wali" value="{{old('no_hp_wali', $siswa->no_hp_wali)}}">
                            @error('no_hp_wali')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div>
                            <label class="form-label">No. Nisn</label>
                            <input type="number" class="form-control" name="nisn" value="{{old('nisn', $siswa->nisn)}}">
                            @error('nisn')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. Nis</label>
                            <input type="number" class="form-control" name="nis" value="{{old('nis', $siswa->nis)}}">
                            @error('nis')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div id="step-3" class="d-none">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Diterima Di kelas</label>
                            <select class="form-control" name="diterima_di_kelas">
                                <option value="X" {{ old('diterima_di_kelas', $siswa->diterima_di_kelas) == 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ old('diterima_di_kelas', $siswa->diterima_di_kelas) == 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ old('diterima_di_kelas', $siswa->diterima_di_kelas) == 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                            @error('diterima_di_kelas')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Angkatan</label>
                            <input type="number" class="form-control" name="angkatan" value="{{old('angkatan', $siswa->angkatan)}}" placeholder="2">
                            @error('angkatan')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input class="form-control" type="date" name="tanggal_masuk" id="" value="{{ old('tanggal_masuk', $siswa->tanggal_masuk ? $siswa->tanggal_masuk->format('Y-m-d') : '') }}">
                            @error('tanggal_masuk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Status Siswa</label>
                            <select class="form-control" name="status_siswa" value="{{old('status_siswa')}}">
                                <option value="Aktif" selected>Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('status_siswa')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control" name="asal_sekolah" placeholder="" value="{{old('asal_sekolah', $siswa->asal_sekolah)}}">
                            @error('asal_sekolah')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat Asal Sekolah</label>
                            <input type="text" class="form-control" name="alamat_asal_sekolah" value="{{old('alamat_asal_sekolah', $siswa->alamat_asal_sekolah)}}">
                            @error('alamat_asal_sekolah')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div id="step-4" class="d-none">
                <h1 class="text-center mb-6">Foto Siswa</h1>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Kelas X</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_kelas10" accept=".png" id="foto_kelas10">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-foto_kelas10" onclick="removeFile('foto_kelas10')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('foto_kelas10')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Kelas XI</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_kelas11" accept=".png" id="foto_kelas11">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-foto_kelas11" onclick="removeFile('foto_kelas11')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('foto_kelas11')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Kelas XII</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_kelas12" accept=".png" id="foto_kelas12">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-foto_kelas12" onclick="removeFile('foto_kelas12')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('foto_kelas12')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div id="step-5" class="d-none">
                <h1 class="text-center mb-6">Rapot Siswa</h1>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Kelas VII</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="rapot_kelas7" id="rapot_kelas7" accept=".png">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-rapot_kelas7" onclick="removeFile('rapot_kelas7')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('rapot_kelas7')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Kelas VIII</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="rapot_kelas8" id="rapot_kelas8" accept=".png">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-rapot_kelas8" onclick="removeFile('rapot_kelas8')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('rapot_kelas8')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Kelas IX</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="rapot_kelas9" id="rapot_kelas9" accept=".png">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-rapot_kelas9" onclick="removeFile('rapot_kelas9')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('rapot_kelas9')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div id="step-6" class="d-none">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Foto Ijazah</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah" id="ijazah" accept=".png" onchange="handleFileUpload(event, 'ijazah')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-ijazah" onclick="removeFile('ijazah')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Foto Surat Kelulusan</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="surat_Kelulusan" id="surat_Kelulusan" accept=".png" onchange="handleFileUpload(event, 'surat_Kelulusan')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-surat_Kelulusan" onclick="removeFile('surat_Kelulusan')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Foto Kartu Keluarga</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="kk" id="kk" accept=".png" onchange="handleFileUpload(event, 'kk')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-kk" onclick="removeFile('kk')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Foto Akta Kelahiran</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="akta_kelahiran" id="akta_kelahiran" accept=".png" onchange="handleFileUpload(event, 'akta_kelahiran')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-akta_kelahiran" onclick="removeFile('akta_kelahiran')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Surat Pernyataan Siswa</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="surat_pernyataan_calonPesertaDidik" id="surat_pernyataan_calonPesertaDidik" accept=".png" onchange="handleFileUpload(event, 'surat_pernyataan_calonPesertaDidik')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-surat_pernyataan_calonPesertaDidik" onclick="removeFile('surat_pernyataan_calonPesertaDidik')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Surat Pernyataan Wali</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="surat_pernyataan_wali" id="surat_pernyataan_wali" accept=".png" onchange="handleFileUpload(event, 'surat_pernyataan_wali')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-surat_pernyataan_wali" onclick="removeFile('surat_pernyataan_wali')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Surat Pernyataan Tidak Merokok</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="surat_pernyataan_tidak_merokok" id="surat_pernyataan_tidak_merokok" accept=".png" onchange="handleFileUpload(event, 'surat_pernyataan_tidak_merokok')">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-surat_pernyataan_tidak_merokok" onclick="removeFile('surat_pernyataan_tidak_merokok')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="button" class="btn btn-secondary" id="prevButton" style="display: none;">Previous</button>
                <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                <button type="submit" class="btn btn-success d-none" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
    @include('js.stepFileSiswa')
    {{-- @include('') --}}
    <script>
      function handleFileUpload(event, inputName) {
    const fileInput = event.target;
    const files = fileInput.files;
    const removeButton = document.getElementById(`btn-remove-${inputName}`);
    if (files.length > 0) {
        removeButton.classList.remove('d-none');
    } else {
        removeButton.classList.add('d-none');
    }
}

function removeFile(inputName) {
    const fileInput = document.querySelector(`input[name="${inputName}"]`);
    fileInput.value = '';
    const removeButton = document.getElementById(`btn-remove-${inputName}`);
    removeButton.classList.add('d-none');
    console.log(`File removed: ${inputName}`);
    // Additional logic can be added here
}
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const steps = ['step-1', 'step-2', 'step-3', 'step-4', 'step-5', 'step-6'];
            let currentStep = 0;

            const nextButton = document.getElementById('nextButton');
            const prevButton = document.getElementById('prevButton');
            const submitButton = document.getElementById('submitButton');

            const toggleVisibility = (element, condition) => {
                element.style.display = condition ? 'none' : 'inline-block';
            };

            const showStep = (step) => {
                steps.forEach((id, index) => {
                    document.getElementById(id).classList.toggle('d-none', index !== step);
                });
                toggleVisibility(prevButton, step === 0);
                toggleVisibility(nextButton, step === steps.length - 1);
                submitButton.classList.toggle('d-none', step !== steps.length - 1);
            };

            nextButton.addEventListener('click', function () {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevButton.addEventListener('click', function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);
        });
    </script>
</x-app-layout>
