<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <a href="{{ route('prestasi.create') }}" class="btn btn-primary">Tambah Data Prestasi</a>
        <a href="{{ route('prestasi.exportPdf', ['status' => request('status')]) }}" class="btn btn-success">Export PDF</a>
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
                                    <a class="btn" download="" href="{{$data->nama_file}}">Dokumentasi</a>
                                    <button class="btn rounded bg-yellow"><a href="{{route('prestasi.edit', $data->id)}}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('prestasi.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="btn bg-danger" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-x-lg text-white"></i></button>
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
    </div>
</x-app-layout>
