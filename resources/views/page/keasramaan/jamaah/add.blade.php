<x-app-layout>
    @include('inc.form')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-4">
        <div class="card">
            <div class="container mt-2 mb-2">
                <div class="row">
                    <div class="col-12">
                        <label for="kelasFilter">Filter Kelas:</label>
                        <select id="kelasFilter" class="form-select" style="width: 100%;">
                            <option value="X" selected>X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                    </div>
                </div>
            </div>

            <form id="jamaahForm" method="POST" action="{{ route('jamaah.store') }}" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="sholat">Sholat</label>
                            <select id="sholat" class="form-select" style="width: 100%;" name="sholat">
                                <option value="subuh">Subuh</option>
                                <option value="dzuhur">Dzuhur</option>
                                <option value="ashar">Ashar</option>
                                <option value="maghrib">Maghrib</option>
                                <option value="isya">Isya</option>
                            </select>
                        </div>
                    </div>
                </div>
                @csrf
                <input type="hidden" id="kelasInput" name="kelas" value="X">

                <div class="table-responsive mt-4">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Kelas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            @foreach($dataKelas as $student)
                            <tr data-kelas="{{ $student->kelas }}" style="{{ $student->kelas === 'X' ? '' : 'display: none;' }}">
                                <td>{{ $student->siswa->nama }}</td>
                                <td>{{ $student->kelas }}</td>
                                <td>
                                    <input type="hidden" name="siswa_ids[]" value="{{ $student->siswa->id }}">
                                    <input type="hidden" name="nama_siswa[{{ $student->siswa->id }}]" value="{{ $student->siswa->nama }}">
                                    <select class="form-select" name="status[{{ $student->siswa->id }}]" style="width: 100px;">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Alpha">Alpha</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <label for="">Dokumentasi</label>
                            <input type="file" class="form-control" name="path_dokumentasi">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const kelasFilter = document.getElementById('kelasFilter');
    const studentTable = document.getElementById('studentTable').children;
    const kelasInput = document.getElementById('kelasInput');
    const jamaahForm = document.getElementById('jamaahForm');

    kelasFilter.addEventListener('change', function() {
        const filterValue = kelasFilter.value;

        Array.from(studentTable).forEach(row => {
            const kelas = row.getAttribute('data-kelas');

            if (kelas === filterValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        kelasInput.value = filterValue; // Set nilai kelas yang dipilih
    });

    jamaahForm.addEventListener('submit', function(event) {
        const filterValue = kelasFilter.value;

        // Hapus siswa yang tidak sesuai dengan filter dari DOM sebelum submit
        Array.from(studentTable).forEach(row => {
            const kelas = row.getAttribute('data-kelas');
            if (kelas !== filterValue) {
                row.remove();
            }
        });
    });
});

    </script>
</x-app-layout>
