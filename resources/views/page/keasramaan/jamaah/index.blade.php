<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="{{ route('jamaah.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Data Jamaah Siswa
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <form method="GET" action="{{ route('jamaah.index') }}">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            @if(request()->filled('start_date') && request()->filled('end_date') && request()->filled('kelas'))
                            <div class="text-center">
                                <label class="form-label">Export data</label>
                                <a target="_blank" href="{{ route('jamaah.exportPdf.range', [
                                    'start_date' => request('start_date'),
                                    'end_date' => request('end_date'),
                                    'kelas' => request('kelas')
                                ]) }}" class="btn btn-warning text-white">
                                    <i class="bi bi-file-earmark-pdf"></i> Export Per Minggu
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <select name="kelas" class="form-control">
                        <option value="">Pilih Kelas</option>
                        <option value="X" {{ request('kelas') == 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ request('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ request('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                        <option value="XIII" {{ request('kelas') == 'XIII' ? 'selected' : '' }}>XIII</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sholat" class="form-control">
                        <option value="">Pilih Sholat</option>
                        <option value="Subuh" {{ request('sholat') == 'Subuh' ? 'selected' : '' }}>Subuh</option>
                        <option value="Dzuhur" {{ request('sholat') == 'Dzuhur' ? 'selected' : '' }}>Dzuhur</option>
                        <option value="Ashar" {{ request('sholat') == 'Ashar' ? 'selected' : '' }}>Ashar</option>
                        <option value="Maghrib" {{ request('sholat') == 'Maghrib' ? 'selected' : '' }}>Maghrib</option>
                        <option value="Isya" {{ request('sholat') == 'Isya' ? 'selected' : '' }}>Isya</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('jamaah.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                    @if(request()->filled('tanggal') && request()->filled('kelas'))
                    <a href="{{ route('jamaah.exportPdf.hari', [
                        'tanggal' => request('tanggal'),
                        'kelas' => request('kelas')
                    ]) }}" class="btn btn-warning text-white ms-2">
                        <i class="bi bi-file-earmark-pdf"></i> Export Per Hari
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <div class="table-responsive shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kelas</th>
                        <th>Sholat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataMutasi as $data)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->sholat }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a class="btn btn-outline-primary" href="{{ route('jamaah.exportPdf', ['tanggal' => $data->tanggal, 'kelas' => $data->kelas, 'sholat' => $data->sholat]) }}">
                                        <i class="bi bi-file-earmark-pdf"></i> Export
                                    </a>
                                    <a class="btn btn-success rounded" href="{{ $data->path_dokumentasi }}" download>
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a class="btn btn-warning rounded" href="{{ route('jamaah.edit', ['tanggal' => $data->tanggal, 'kelas' => $data->kelas, 'sholat' => $data->sholat, 'id' => $data->id]) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('jamaah.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger rounded" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible position-fixed bottom-0 end-0 mb-3 me-3" role="alert" id="alertSuccess">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
