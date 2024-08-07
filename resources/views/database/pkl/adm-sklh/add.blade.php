<x-app-layout>
    @include('inc.form')

    <div class="py-12 container">
        <div class="col-12">
            <a href="{{route('pkl.sekolah.index')}}" class="btn btn-secondary mb-4">Back</a>
            <form class="card" method="POST" action="{{ route('pkl.sekolah.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="card-title">Edit Profile</h3>
                    <div class="row row-cards">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Ajaran</label>
                                <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" placeholder="2024-2025" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required>
                                @error('tahun_ajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" placeholder="Nama Perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required>
                                @error('nama_perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Tabel Siswa & Perusahaan</div>
                                <input type="file" class="form-control @error('path_foto_siswa_dan_perusahaan') is-invalid @enderror" name="path_foto_siswa_dan_perusahaan" required>
                                @error('path_foto_siswa_dan_perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <div class="form-label">MOU</div>
                                <input type="file" class="form-control @error('path_foto_mov') is-invalid @enderror" name="path_foto_mov" required>
                                @error('path_foto_mov')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
