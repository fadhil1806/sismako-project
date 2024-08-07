<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <a href="{{route('prestasi.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('prestasi.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="name" value="{{old('nama')}}">
                        @error('nama')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" value="{{old('status')}}">
                            <option value="Guru" selected>Guru</option>
                            <option value="Siswa">Siswa</option>
                        </select>
                        @error('status')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2" id="kelasDiv">
                    <div class="mb-3">
                        <label class="form-label">Kelas ( Optional )</label>
                        <select class="form-select" name="kelas" id="kelas" value="{{old('kelas')}}">
                            <option value="X" selected>X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                        @error('kelas')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Tanggal lomba</label>
                        <input type="date" class="form-control" name="tanggal_lomba" value="{{old('tanggal_lomba')}}">
                        @error('tanggal_lomba')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Peringkat</label>
                        <input type="text" class="form-control" name="peringkat" value="{{old('peringkat')}}">
                        @error('peringkat')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Dokumentasi ( Sertifikat atau Foto )</label>
                        <input type="file" class="form-control" name="path_sertifikat" rows="4">{{old('path_sertifikat')}}</input>
                        @error('path_sertifikat')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Tempat lomba</label>
                        <textarea class="form-control" name="tempat_lomba" rows="4">{{old('tempat_lomba')}}</textarea>
                        @error('tempat_lomba')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success " id="submitButton">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const kelasDiv = document.getElementById('kelasDiv');

            function toggleKelas() {
                if (statusSelect.value === 'Guru') {
                    kelasDiv.style.display = 'none';
                } else {
                    kelasDiv.style.display = 'block';
                }
            }

            statusSelect.addEventListener('change', toggleKelas);
            toggleKelas(); // Initial call to set the correct visibility on page load
        });
    </script>
</x-app-layout>
