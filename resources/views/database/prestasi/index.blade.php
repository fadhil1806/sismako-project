<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
        <a href="{{ route('prestasi.create') }}" class="btn btn-primary">Tambah Data Prestasi</a>
        <a href="{{ route('prestasi.exportPdf', ['status' => request('status')]) }}" class="btn btn-success">Export
            PDF</a>
        <form method="GET" action="/data-prestasi" class="mt-3">
            <div class="form-group">
                <label for="status">Filter Status:</label>
                <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="Siswa" {{ $statusFilter == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="Guru" {{ $statusFilter == 'Guru' ? 'selected' : '' }}>Guru</option>
                </select>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <div class="table-responsive" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Peringkat</th>
                        <th>Tanggal Lomba</th>
                        <th>Tempat Lomba</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPrestasi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->peringkat }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_lomba)->format('d-m-Y') }}</td>
                            <td>{{ $data->tempat_lomba }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a class="btn" download="" href="{{ $data->nama_file }}">Dokumentasi</a>
                                    <button class="btn rounded bg-yellow"><a
                                            href="{{ route('prestasi.edit', $data->id) }}"><i
                                                class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('prestasi.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="btn bg-danger" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')"><i
                                                class="bi bi-x-lg text-white"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No data available</td>
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
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
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
