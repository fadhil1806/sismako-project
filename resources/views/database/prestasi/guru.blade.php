<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-3">
        <a href="{{route('prestasi.create')}}" class="btn btn-primary">Tambah data Prestasi</a>
    </div>
    <div class="mt-4">
        <div class="table-responsive" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>peringkat</th>
                        <th>Tanggal lomba</th>
                        <th>Tempat lomba</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPrestasi as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->peringkat }}</td>
                            <td>{{ $data->tanggal_lomba }}</td>
                            <td>{{ $data->tempat_lomba }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a class="btn" target="_blank" href="{{$data->nama_file}}">Dokumentasi</a>
                                    <button class="btn rounded bg-yellow"><a href="{{route('prestasi.edit', $data->id)}}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('prestasi.destory', $data->id) }}" method="POST">
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
