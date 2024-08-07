<x-app-layout>
    @include('inc.form')

    <div class="py-12 container">
        <div class="col-12">
            <a href="{{route('pkl.siswa.index')}}" class="btn btn-secondary mb-4">Back</a>
            <form class="card" method="POST" action="{{ route('pkl.siswa.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="card-title">Tambah Administrasi Siswa</h3>
                    <div class="row row-cards">
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">No. Nisn</label>
                                <input type="text" placeholder="222311125543" name="nisn" class="form-control" value="{{ old('nisn') }}">
                                @error('nisn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama" placeholder="Fadhil Rabbani" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tempat PKL</label>
                                <input type="text" class="form-control" name="tempat_pkl" placeholder="PT. Pertamina" value="{{ old('tempat_pkl') }}">
                                @error('tempat_pkl')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Rekap Kehadiran</div>
                                <input type="file" class="form-control" name="path_rekap_kehadiran">
                                @error('path_rekap_kehadiran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <div class="form-label">Jurnal PKL</div>
                                <input type="file" class="form-control" name="path_jurnal_pkl">
                                @error('path_jurnal_pkl')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
