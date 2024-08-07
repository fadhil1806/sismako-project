<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <a href="{{route('kelas.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{ route('kelas.update', $kelas->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Angkatan Filter -->
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <select class="form-control" name="angkatan" id="angkatan-select">
                            <option value="">-- Pilih Angkatan --</option>
                            @foreach($angkatan as $data)
                                <option value="{{ $data }}" {{ $kelas->angkatan == $data ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                        @error('angkatan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Nama Filter -->
                <div class="col-lg-9">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <select class="form-control" name="id_siswa" id="nama-select">
                            <option value="">-- Pilih Nama --</option>
                            @foreach($names as $siswa)
                                <option value="{{ $dataKelas->siswa->id }}" selected>{{ $dataKelas->siswa->nama }}</option>
                            @endforeach
                        </select>
                        @error('nama')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Other Form Fields -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Tahun Pelajaran</label>
                        <input type="text" class="form-control" name="tahun_pelajaran" placeholder="2024-2025" value="{{ $kelas->tahun_pelajaran }}">
                        @error('tahun_pelajaran')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" placeholder="SIJA" value="{{ $kelas->jurusan }}">
                        @error('jurusan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select" name="kelas" id="kelas" value="{{ $kelas->kelas }}">
                            <option value="X" {{ $kelas->kelas == 'X' ? 'selected' : '' }}>X</option>
                            <option value="XI" {{ $kelas->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                            <option value="XII" {{ $kelas->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                            <option value="XIII" {{ $kelas->kelas == 'XIII' ? 'selected' : '' }}>XIII</option>
                        </select>
                        @error('kelas')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Nomor urut</label>
                        <input type="number" class="form-control" name="no_urut" value="{{ $kelas->no_urut }}">
                        @error('no_urut')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('angkatan-select').addEventListener('change', function() {
            const angkatan = this.value;
            const namesSelect = document.getElementById('nama-select');
            namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

            // Fetch the student names based on the selected angkatan
            fetch(`/api/siswa?angkatan=${angkatan}`)
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
