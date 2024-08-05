<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <form method="post" action="{{route('punishment.store')}}" enctype="multipart/form-data">
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
                        @error('id_siswa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4" id="kelasDiv">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Jenis Pelanggaran</label>
                        <input type="text" class="form-control" name="jenis_pelanggaran" value="{{ old('jenis_pelanggaran') }}">
                        @error('jenis_pelanggaran')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Pengurangan Point</label>
                        <input type="number" class="form-control" name="pengurangan_point" placeholder="100" value="{{old('pengurangan_point')}}">
                        @error('pengurangan_point')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nama Guru Pengawas</label>
                        <input type="text" class="form-control" name="pengawasan_guru" value="{{old('pengawasan_guru')}}">
                        @error('pengawasan_guru')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Foto Dokumentasi</label>
                        <input type="file" class="form-control" name="path_dokumen" value="{{old('path_dokumen')}}">
                        @error('path_dokumen')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Kronologi</label>
                        <textarea class="form-control" rows="4" name="kronologi">{{old('kronologi')}}</textarea>
                        @error('kronologi')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Tindak Lanjut</label>
                        <textarea class="form-control" rows="2" name="tindak_lanjut">{{old('tindak_lanjut')}}</textarea>
                        @error('tindak_lanjut')
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

    fetch(`/api/siswa?angkatan=${angkatan}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(siswa => {
                console.log(siswa)
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
