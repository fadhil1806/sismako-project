<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-3">
        <a href="{{route('siswa.create')}}" class="btn btn-primary">Tambah data Prestasi</a>
    </div>
    <div class="mt-4">
        <div class="table-responsive" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Tahun Pelajaran</th>
                        <th>Jenis kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Nisn</th>
                        <th>Nis</th>
                        <th>Angkatan</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->tahun_pelajaran }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->tanggal_lahir }}</td>
                            <td>{{ $data->nisn }}</td>
                            <td>{{ $data->nis }}</td>
                            <td>{{$data->angkatan}}</td>
                            <td>{{ $data->asal_sekolah }}</td>
                            <td>{{ $data->status_siswa }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn"><a href="{{route('siswa.exportPdf', $data->id)}}" style="text-decoration: none">Export</a></button>
                                    <button class="btn rounded bg-success"><a href="{{route('file.siswa', $data->nama)}}"><i class="bi bi-box-arrow-right text-white"></i></a></button>
                                    <button class="btn rounded bg-yellow"><a href="{{route('siswa.edit', $data->id)}}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('siswa.destroy', $data->id) }}" method="POST">
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
