<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{ route('pkl.sekolah.create') }}" class="btn btn-primary">Tambah Data Kelas</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form action="{{ route('pkl.sekolah.index') }}" method="GET" id="filterForm">
            <div class="row">
                <div class="col-lg-4">
                    <select name="filter_perusahaan" class="form-control" onchange="document.getElementById('filterForm').submit();">
                        <option value="">Semua Perusahaan</option>
                        @foreach ($perusahaanList as $perusahaan)
                            <option value="{{ $perusahaan }}" {{ request('filter_perusahaan') == $perusahaan ? 'selected' : '' }}>{{ $perusahaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <div class="table-responsive shadow shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun Pelajaran</th>
                        <th>Nama Perusahaan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPklSekolah as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->tahun_ajaran}}</td>
                            <td>{{ $data->nama_perusahaan }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn rounded bg-success"><a href="{{route('file.pkl.sekolah', $data->id)}}"><i class="bi bi-box-arrow-right text-white"></i></a></button>
                                    <button class="btn rounded bg-yellow"><a href="{{ route('pkl.sekolah.edit', $data->id) }}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('pkl.sekolah.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button id="btn bg-danger" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-x-lg text-white"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
