<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
                <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Data Kelas</a>
            </div>
            <form method="GET" action="{{ route('kelas.index') }}" class="mt-3 d-flex" style="gap: 20px">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tahun_pelajaran">Filter Tahun Pelajaran:</label>
                        <select id="tahun_pelajaran" name="tahun_pelajaran" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($availableTahunPelajaran as $tahun)
                                <option value="{{ $tahun }}" {{ $tahunPelajaranFilter == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="kelas">Filter Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($availableKelas as $kelas)
                            @if($kelas != 'Lulus') <!-- Mengecualikan kelas "Lulus" -->
                            <option value="{{ $kelas }}" {{ $kelasFilter == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                        @endif                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="angkatan">Filter Angkatan:</label>
                        <select id="angkatan" name="angkatan" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach($availableAngkatan as $angkatan)
                                <option value="{{ $angkatan }}" {{ $angkatanFilter == $angkatan ? 'selected' : '' }}>{{ $angkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Export button -->
                <div class="col-lg-3" style="margin-top: 20px">
                    <a href="{{ route('kelas.export', ['tahun_pelajaran' => $tahunPelajaranFilter, 'kelas' => $kelasFilter, 'angkatan' => $angkatanFilter]) }}"
                        class="btn btn-primary">Export</a>
                        <a href="{{ route('kelas.upgrade') }}" class="btn btn-success" onclick="return confirm('Are you sure?')">Naik Kelas</a>
                    </div>
            </form>
        </div>
    </div>
    <div class="mt-4">
        <div class="table-responsive shadow shadow-sm" style="margin-right: 20px; margin-left: 20px">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>No. Urut</th>
                        <th>Nama</th>
                        <th>Tahun Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataKelas as $data)
                        <tr>
                            <td>{{ $data->no_urut }}</td>
                            <td>{{ $data->siswa->nama ?? 'Tidak ada data' }}</td>
                            <td>{{ $data->tahun_pelajaran }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->jurusan }}</td>
                            <td>{{ $data->angkatan }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn rounded bg-yellow"><a href="{{ route('kelas.edit', $data->id) }}"><i class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('kelas.destroy', $data->id) }}" method="POST">
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
