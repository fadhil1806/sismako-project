<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <a href="{{ route('patroli.asrama.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Data Patroli
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <form method="GET" action="{{ route('patroli.asrama.index') }}">
            <div class="row">
                <div class="col-md-4 ">
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-4 ">
                    <select name="status_patroli" class="form-control">
                        <option value="">Pilih Status Patroli</option>
                        <option value="kebersihan" {{ request('status_patroli') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="keamanan" {{ request('status_patroli') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                        <option value="kamar asrama" {{ request('status_patroli') == 'kamar asrama' ? 'selected' : '' }}>Kamar Asrama</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('patroli.asrama.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">
        {{-- <div class="table-responsive shadow-sm mx-3">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Patroli</th>
                        <th>Status Patroli</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patroliAsrama as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_patroli)->format('d-m-Y') }}</td>
                            <td>{{ $data->status_patroli }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a class="btn btn-warning" href="{{ $data->dokumentasi }}" id="downloadButton" download onclick="checkDokumentasi(event, '{{ $data->dokumentasi }}')">
                                        <i class="bi bi-download"></i> Dokumentasi
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('patroli.asrama.edit', $data->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('patroli.asrama.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
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
        </div> --}}

        <div class="table-responsive shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Patroli</th>
                        <th>Status Patroli</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patroliAsrama as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_patroli)->format('d-m-Y') }}</td>
                            <td>{{ $data->status_patroli }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a class="btn btn-outline-primary" href="{{ $data->dokumentasi }}" id="downloadButton" download onclick="checkDokumentasi(event, '{{ $data->dokumentasi }}')">
                                        <i class="bi bi-download"></i> Dokumentasi
                                    </a>
                                    <a class="btn btn-warning rounded" href="{{ route('patroli.asrama.edit', $data->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('patroli.asrama.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger rounded" onclick="return confirm('Are you sure?')">
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

        <div class="alert alert-danger alert-dismissible position-fixed bottom-0 end-0 mb-3 me-3" role="alert" id="dokumentasiPathUrl" style="display: none;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-circle me-2"></i>
                <div>Dokumentasi tidak tersedia.</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" onclick="disabledAlertDokumentasiPathUrl()"></button>
            </div>
        </div>

        <script>
            function disabledAlert() {
                document.getElementById('alertSuccess').style.display = 'none';
            }
            function disabledAlertDokumentasiPathUrl() {
                document.getElementById('dokumentasiPathUrl').style.display = 'none';
            }
            function checkDokumentasi(event, url) {
                if (!url) {
                    event.preventDefault(); // Mencegah tombol melakukan aksi download
                    document.getElementById('dokumentasiPathUrl').style.display = 'block'; // Munculkan alert
                }
            }
        </script>
    </div>
</x-app-layout>
