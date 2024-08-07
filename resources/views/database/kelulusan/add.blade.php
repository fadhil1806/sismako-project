<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <a href="{{route('kelulusan.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('kelulusan.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-4" id="asalSekolahDiv">
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <select class="form-control" name="angkatan" id="angkatan-select">
                            <option value="">-- Pilih Angkatan --</option>
                            @foreach($angkatan as $data)
                                <option value="{{ $data }}" {{ old('angkatan') == $data ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                        @error('angkatan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <select class="form-control" name="id_siswa" id="nama-select">
                            <option value="">-- Pilih Nama --</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                        @error('nama')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2" id="kelasDiv">
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" placeholder="SIJA" value="{{ old('jurusan') }}">
                        @error('jurusan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="mb-3">
                        <label class="form-label">Tahun Pelajaran</label>
                        <input type="text" class="form-control" name="tahun_pelajaran" placeholder="2024-2025" value="{{ old('tahun_pelajaran') }}">
                        @error('tahun_pelajaran')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Nomor handphone</label>
                        <input type="number" class="form-control" name="no_hp" placeholder="SIJA" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4" id="asalSekolahDiv">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8" id="tujuanBerikutnyaDiv" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Tujuan Berikutnya</label>
                        <input type="text" class="form-control" name="tujuan_berikutnya" value="{{ old('tujuan_berikutnya') }}">
                        @error('tujuan_berikutnya')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kelulusan</label>
                        <input type="date" class="form-control" name="tanggal_kelulusan" value="{{old('tanggal_kelulusan')}}">
                        @error('tanggal_kelulusan')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Karir selanjutnya</label>
                        <input type="text" class="form-control" name="karir_selanjutnya" placeholder="Web developer" value="{{old('karir_selanjutnya')}}">
                        @error('karir_selanjutnya')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="path_foto" value="{{old('path_foto')}}">
                        @error('path_foto')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
    <script>
         document.getElementById('angkatan-select').addEventListener('change', function() {
            const angkatan = this.value;
            const namesSelect = document.getElementById('nama-select');
            namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

            fetch(`/api/siswa-lulus?angkatan=${angkatan}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(siswa => {
                        const option = document.createElement('option');
                        option.value = siswa.id;
                        option.textContent = siswa.nama;
                        namesSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching names:', error));
        });
    </script>
</x-app-layout>
