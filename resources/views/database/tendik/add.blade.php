<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <div class="container mt-6">
        <a href="{{route('tendik.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('tendik.store')}}" id="multiStepForm" enctype="multipart/form-data">
            @csrf
            <div id="step-1">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="name" value="{{old('nama')}}">
                            @error('nama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Posisi Jabatan</label>
                            <input type="text" class="form-control" name="posisi" placeholder="Guru Matematika" value="{{old('posisi')}}">
                            @error('posisi')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" autocomplete="off" placeholder="example@mail.com" name="email" value="{{old('email')}}">
                            @error('email')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" value="{{old('jenis_kelamin')}}">
                                <option value="Laki-laki" selected>Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" name="tempat_tanggal_lahir" placeholder="Jakarta" value="{{old('tempat_tanggal_lahir')}}">
                            @error('tempat_tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
                            @error('tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. Handphone</label>
                            <input type="number" class="form-control" name="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. Rekening & Nama Bank</label>
                            <input type="text" class="form-control" name="no_rekening" placeholder="BRI - 22312215543" value="{{ old('no_rekening') }}" required>
                            @error('no_rekening')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <select class="form-control" name="agama" value="{{old('agama')}}">
                                <option value="Islam" selected>Islam</option>
                                <option value="Kristen">Kristen</option>
                            </select>
                            @error('agama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <select class="form-control" name="pendidikan_terakhir" value="{{old('pendidikan_terakhir')}}">
                                <option value="smp" selected>SMP</option>
                                <option value="sma">SMA</option>
                            </select>
                            @error('pendidikan_terakhir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="4" name="alamat">{{old('alamat')}}</textarea>
                            @error('alamat')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-2" class="d-none">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div>
                            <label class="form-label">No. nik</label>
                            <input type="number" class="form-control" name="no_nik" value="{{old('no_nik')}}">
                            @error('no_nik')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. NUPTK</label>
                            <input type="number" class="form-control" name="no_nuptk" value="{{old('no_nuptk')}}">
                            @error('no_nuptk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. GTK</label>
                            <input type="number" class="form-control" name="no_gtk" value="{{old('no_gtk')}}">
                            @error('no_gtk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan tinggi</label>
                            <input type="text" class="form-control" name="nama_lulusan_pt" placeholder="Universitas Indonesia" value="{{old('nama_lulusan_pt')}}">
                            @error('nama_lulusan_pt')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan_pt" placeholder="" value="{{old('nama_jurusan_pt')}}">
                            @error('nama_jurusan_pt')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Status Kepegawaian</label>
                            <select class="form-control" name="status_kepegawaian" value="{{old('status_kepegawaian')}}">
                                <option value="aktif" selected>Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                            @error('status_kepegawaian')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input class="form-control" type="date" name="tanggal_masuk" id="" value="{{old('tanggal_masuk')}}">
                            @error('tanggal_masuk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Keluar</label>
                            <input class="form-control" type="date" name="tanggal_keluar" id="" value="{{old('tanggal_keluar')}}">
                        </div>
                        @error('tanggal_keluar')
                                <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div id="step-3" class="d-none">
                <h1 class="text-center mb-6">Foto Ijazah</h1>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">SMP</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_smp" accept=".png" onchange="handleFileUpload(event, 'ijazah_smp')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%" id="btn-remove-ijazah_smp" onclick="removeFile('ijazah_smp')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_smp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">SMA</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_sma" accept=".png" onchange="handleFileUpload(event, 'ijazah_sma')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%" id="btn-remove-ijazah_sma" onclick="removeFile('ijazah_sma')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_sma')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">S1 (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_s1" accept=".png" onchange="handleFileUpload(event, 'ijazah_s1')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%" id="btn-remove-ijazah_s1" onclick="removeFile('ijazah_s1')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_s1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">S2 (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_s2" accept=".png" onchange="handleFileUpload(event, 'ijazah_s2')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%" id="btn-remove-ijazah_s2" onclick="removeFile('ijazah_s2')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_s2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">S3 (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_s3" accept=".png" onchange="handleFileUpload(event, 'ijazah_s3')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%" id="btn-remove-ijazah_s3" onclick="removeFile('ijazah_s3')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="step-4" class="d-none">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Foto</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto" accept=".png" onchange="handleFileUpload(event, 'foto')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%;" id="btn-remove-foto" onclick="removeFile('foto')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">FOTO KTP</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_ktp" accept=".png" onchange="handleFileUpload(event, 'foto_ktp')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%;" id="btn-remove-foto_ktp" onclick="removeFile('foto_ktp')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">FOTO Surat Keterangan Mengajar</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_surat_keterangan_mengajar" accept=".png" onchange="handleFileUpload(event, 'foto_surat_keterangan_mengajar')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%;" id="btn-remove-foto_surat_keterangan_mengajar" onclick="removeFile('foto_surat_keterangan_mengajar')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Foto sertifikat (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_sertifikat[]" multiple accept=".png" onchange="handleFileUpload(event, 'foto_sertifikat')">
                            <div class="input-group-append">
                                <button type="button" class="btn d-none" style="height: 100%;" id="btn-remove-foto_sertifikat" onclick="removeFile('foto_sertifikat')"><i class="fa-solid fa-x"></i></button>
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
            const steps = ['step-1', 'step-2', 'step-3', 'step-4'];
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
