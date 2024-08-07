<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
                <a href="{{ route('mutasi.create') }}" class="btn btn-primary">Tambah Data Mutasi</a>
            </div>
            <form method="GET" action="{{ route('mutasi.index') }}" class="mt-3 d-flex" style="gap: 20px">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="mutasi">Filter Mutasi:</label>
                        <select id="mutasi" name="mutasi" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="Masuk" {{ $mutasiFilter == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="Keluar" {{ $mutasiFilter == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="status">Filter Status:</label>
                        <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="Siswa" {{ $statusFilter == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="Guru" {{ $statusFilter == 'Guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2" style="margin-top: 20px">
                    <a href="{{ route('mutasi.export', ['mutasi' => $mutasiFilter, 'status' => $statusFilter]) }}"
                        class="btn btn-primary">Export</a>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <div class="table-responsive shadow shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Mutasi</th>
                        <th>Tanggal Mutasi</th>
                        <th>Asal Sekolah</th>
                        <th>Tujuan Berikutnya</th>
                        <th>Alasan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataMutasi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->mutasi }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_mutasi)->format('d-m-Y') }}</td>
                            <td>{{ $data->asal_sekolah }}</td>
                            <td>{{ $data->tujuan_berikutnya }}</td>
                            <td>{{ $data->alasan }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a class="btn" href="{{$data->path_dokumen_pendukung_tambahan}}" download="">Dokumen Tambahan</a>
                                    <button class="btn rounded bg-yellow"><a href="{{route('mutasi.edit', $data->id)}}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('mutasi.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="btn bg-danger" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-x-lg text-white"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible position-absolute bottom-0 end-0 me-3" role="alert"
            id="alertSuccess">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </div>
                <div>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"
                onclick="disabledAlert()" style="cursor: pointer;"></button>
        </div>
    @endif

    <script>
        function disabledAlert() {
            document.getElementById('alertSuccess').style.display = 'none';
        }
    </script>
    </div>
</x-app-layout>
