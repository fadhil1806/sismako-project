<x-app-layout>

    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-3">
        <a href="{{route('guru.create')}}" class="btn btn-primary">Tambah data Guru</a>
    </div>
    <div class="mt-4">
        <div class="table-responsive shadow shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>GTK</th>
                        <th>NUPTK</th>
                        <th>Jenis Kelamin</th>
                        <th>No HP</th>
                        <th>Mapel</th>
                        <th>Email</th>
                        <th>Rekening</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guru as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->no_nik }}</td>
                            <td>{{ $data->no_gtk }}</td>
                            <td>{{ $data->no_nuptk }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->mapel }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->no_rekening }}</td>
                            <td><span class="badge bg-success me-1"></span>{{ $data->status_kepegawaian }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn"><a href="{{route('guru.exportPdf', $data->id)}}" style="text-decoration: none">Export</a></button>
                                    <button class="btn rounded bg-success"><a href="{{route('file.guru', $data->nama)}}"><i class="bi bi-box-arrow-right text-white"></i></a></button>
                                    <button class="btn rounded bg-yellow"><a href="{{route('guru.edit', $data->id)}}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('guru.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="btn bg-danger" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-x-lg text-white"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
