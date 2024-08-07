<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
                <a href="{{ route('pkl.sekolah.create') }}" class="btn btn-primary">Tambah Data Adminstarsi Sekolah</a>
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
