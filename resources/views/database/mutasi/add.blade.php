<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <a href="{{route('mutasi.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('mutasi.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" value="{{ old('status') }}">
                            <option value="Guru" selected>Guru</option>
                            <option value="Siswa">Siswa</option>
                        </select>
                        @error('status')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2" id="kelasDiv">
                    <div class="mb-3">
                        <label class="form-label">Kelas (Optional)</label>
                        <select class="form-select" name="kelas" id="kelas" value="{{ old('kelas') }}">
                            <option value="X" selected>X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                        @error('kelas')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Mutasi</label>
                        <select class="form-select" name="mutasi" id="mutasi" value="{{ old('mutasi') }}">
                            <option value="Masuk" selected>Masuk</option>
                            <option value="Keluar">Keluar</option>
                        </select>
                        @error('mutasi')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8" id="asalSekolahDiv">
                    <div class="mb-3">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah') }}">
                        @error('asal_sekolah')
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
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mutasi</label>
                        <input type="date" class="form-control" name="tanggal_mutasi" value="{{old('tanggal_mutasi')}}">
                        @error('tanggal_mutasi')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4" id="path_dokumen_pendukung_tambahan">
                    <div class="mb-3">
                        <label class="form-label">Dokumen Tambahan</label>
                        <input type="file" class="form-control" name="path_dokumen_pendukung_tambahan" value="{{ old('path_dokumen_pendukung_tambahan') }}">
                        @error('path_dokumen_pendukung_tambahan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Alasan</label>
                        <textarea class="form-control" name="alasan" rows="4">{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <div class="text-danger mt-2">{{ $message }}</div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const kelasDiv = document.getElementById('kelasDiv');
            const mutasiSelect = document.getElementById('mutasi');
            const asalSekolahDiv = document.getElementById('asalSekolahDiv');
            const tujuanBerikutnyaDiv = document.getElementById('tujuanBerikutnyaDiv');

            function toggleKelas() {
                if (statusSelect.value === 'Guru') {
                    kelasDiv.style.display = 'none';
                } else {
                    kelasDiv.style.display = 'block';
                }
            }

            function toggleMutasi() {
                if (mutasiSelect.value === 'Masuk') {
                    asalSekolahDiv.style.display = 'block';
                    tujuanBerikutnyaDiv.style.display = 'none';
                } else {
                    asalSekolahDiv.style.display = 'none';
                    tujuanBerikutnyaDiv.style.display = 'block';
                }
            }

            statusSelect.addEventListener('change', toggleKelas);
            mutasiSelect.addEventListener('change', toggleMutasi);
            toggleKelas(); // Initial call to set the correct visibility on page load
            toggleMutasi(); // Initial call to set the correct visibility on page load
        });
    </script>
</x-app-layout>
