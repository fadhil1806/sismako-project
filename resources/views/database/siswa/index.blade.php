<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="container mt-3">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah data Siswa</a>
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
                            <td>{{ $data->angkatan }}</td>
                            <td>{{ $data->asal_sekolah }}</td>
                            <td>{{ $data->status_siswa }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <button class="btn"><a href="{{ route('siswa.exportPdf', $data->id) }}"
                                            style="text-decoration: none">Export</a></button>
                                    <button class="btn rounded bg-success"><a
                                            href="{{ route('file.siswa', $data->nama) }}"><i
                                                class="bi bi-box-arrow-right text-white"></i></a></button>
                                    <button class="btn rounded bg-yellow"><a
                                            href="{{ route('siswa.edit', $data->id) }}"><i
                                                class="bi bi-pencil-square text-white"></i></a></button>
                                    <form action="{{ route('siswa.destroy', $data->id) }}" method="POST">
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
                            <td colspan="13">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible position-absolute bottom-0 end-0 me-3" role="alert"
            id="alertSuccess">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
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
</x-app-layout>
