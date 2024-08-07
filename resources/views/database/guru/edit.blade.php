<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <div class="container mt-6">
        <a href="{{route('guru.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('guru.update', $guru->id)}}" id="multiStepForm" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div id="step-1">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="name" value="{{ old('nama', $guru->nama) }}" required>
                            @error('nama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Gelar</label>
                            <input type="text" class="form-control" name="gelar" placeholder="S.Ag, S.Pd" value="{{ old('gelar', $guru->gelar) }}" required>
                            @error('gelar')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" autocomplete="off" placeholder="example@mail.com" name="email" value="{{ old('email', $guru->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" value="{{old('jenis_kelamin')}}">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                            <input type="text" class="form-control" name="tempat_tanggal_lahir" placeholder="Jakarta" value="{{ old('tempat_tanggal_lahir', $guru->tempat_tanggal_lahir) }}" required>
                            @error('tempat_tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir->format('Y-m-d')) }}" required>
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
                            <input type="number" class="form-control" name="no_hp" value="{{ old('no_hp', $guru->no_hp) }}" required>
                            @error('no_hp')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. Rekening & Nama Bank</label>
                            <input type="text" class="form-control" name="no_rekening" placeholder="BRI - 22312215543" value="{{ old('no_rekening', $guru->no_rekening) }}" required>
                            @error('no_rekening')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <select class="form-control" name="agama" required>
                                <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Buddha" {{ old('agama', $guru->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('agama', $guru->agama) == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Katolik" {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            </select>
                            @error('agama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="form-control" name="mapel" value="{{ old('mapel', $guru->mapel) }}" required>
                                <option value="matematika" selected>Matematika</option>
                                <option value="bahasa inggris">Bahasa inggris</option>
                            </select>
                            @error('mapel')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="4" name="alamat">{{ str_replace('=', '', old('alamat', $guru->alamat)) }}</textarea>
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
                            <input type="number" class="form-control" name="no_nik" value="{{ old('no_nik', $guru->no_nik) }}">
                            @error('no_nik')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. NUPTK</label>
                            <input type="number" class="form-control" name="no_nuptk" value="{{ old('no_gtk', $guru->no_gtk) }}" required>
                            @error('no_nuptk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. GTK</label>
                            <input type="number" class="form-control" name="no_gtk" value="{{ old('no_nuptk', $guru->no_nuptk) }}" required>
                            @error('no_gtk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan tinggi</label>
                            <input type="text" class="form-control" name="nama_lulusan_pt" placeholder="Universitas Indonesia" value="{{ old('nama_lulusan_pt', $guru->nama_lulusan_pt) }}" required>
                            @error('nama_lulusan_pt')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan_pt" placeholder="" value="{{ old('nama_jurusan_pt', $guru->nama_jurusan_pt) }}" required>
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
                            <select class="form-control" name="status_kepegawaian" >
                                <option value="Aktif" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak aktif" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Tidak aktif' ? 'selected' : '' }}>Tidak aktif</option>
                            </select>
                            @error('status_kepegawaian')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input class="form-control" type="date" name="tanggal_masuk" id="" value="{{ old('tanggal_masuk', $guru->tanggal_masuk->format('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Keluar</label>
                            <input class="form-control" type="date" name="tanggal_keluar" id="" value="{{ old('tanggal_keluar', $guru->tanggal_keluar ? $guru->tanggal_keluar->format('Y-m-d') : '') }}">
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
                    <!-- SMP -->
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">SMP</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_smp" accept=".png" id="ijazah_smp">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-ijazah_smp" onclick="removeFile('ijazah_smp')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_smp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SMA -->
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">SMA</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_sma" accept=".png" id="ijazah_sma">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-ijazah_sma" onclick="removeFile('ijazah_sma')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_sma')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- S1 -->
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">S1 (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_s1" accept=".png" id="ijazah_s1"">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-ijazah_s1" onclick="removeFile('ijazah_s1')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_s1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- S2 -->
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">S2 (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_s2" accept=".png" id="ijazah_s2">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-ijazah_s2" onclick="removeFile('ijazah_s2')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                        @error('ijazah_s2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- S3 -->
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">S3 (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="ijazah_s3" accept=".png" id="ijazah_s3">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%" id="btn-remove-ijazah_s3" onclick="removeFile('ijazah_s3')"><i class="fa-solid fa-x"></i></button>
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
                            <input type="file" class="form-control" name="foto" accept=".png" id="foto">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-foto" onclick="removeFile('foto')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">FOTO KTP</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_ktp" accept=".png" id="foto_ktp">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-foto_ktp" onclick="removeFile('foto_ktp')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">FOTO Surat Keterangan Mengajar</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_surat_keterangan_mengajar" accept=".png" id="foto_surat_keterangan_mengajar">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-foto_surat_keterangan_mengajar" onclick="removeFile('foto_surat_keterangan_mengajar')"><i class="fa-solid fa-x"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold" for="">Foto sertifikat (opsional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="foto_sertifikat[]" multiple accept=".png" id="foto_sertifikat">
                            <div class="input-group-append">
                                <button type="button" class="btn" style="height: 100%;" id="btn-remove-foto_sertifikat" onclick="removeFile('foto_sertifikat')"><i class="fa-solid fa-x"></i></button>
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

   @include('js.stepButton')
   @include('js.setFileGuru')
   @include('js.handleFile')

</x-app-layout>
