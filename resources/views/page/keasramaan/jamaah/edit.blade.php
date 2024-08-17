<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-4">
        <div class="card">
            <form id="jamaahForm" method="POST" action="{{ route('jamaah.update', ['tanggal' => $tanggal, 'kelas' => $kelas, 'sholat' => $sholat, 'id' => $id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" id="kelasInput" name="kelas" value="{{ $kelas }}">

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="sholat">Sholat</label>
                            <select id="sholat" class="form-select" style="width: 100%;" name="sholat">
                                <option value="subuh" {{ $sholat == 'subuh' ? 'selected' : '' }}>Subuh</option>
                                <option value="dzuhur" {{ $sholat == 'dzuhur' ? 'selected' : '' }}>Dzuhur</option>
                                <option value="ashar" {{ $sholat == 'ashar' ? 'selected' : '' }}>Ashar</option>
                                <option value="maghrib" {{ $sholat == 'maghrib' ? 'selected' : '' }}>Maghrib</option>
                                <option value="isya" {{ $sholat == 'isya' ? 'selected' : '' }}>Isya</option>
                            </select>
                        </div>
                    </div>
                </div>

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
                            @foreach($dataJamaah as $student)
                            <tr>
                                <td>{{ $student->siswa->nama }}</td>
                                <td>{{ $student->kelas }}</td>
                                <td>
                                    <input type="hidden" name="siswa_ids[]" value="{{ $student->id }}">
                                    <input type="hidden" name="nama_siswa[{{ $student->siswa->id }}]" value="{{ $student->siswa->nama }}">
                                    <select class="form-select" name="status[{{ $student->id }}]" style="width: 100px;">
                                        <option value="Hadir" {{ $student->status_jamaah == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Sakit" {{ $student->status_jamaah == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="Alpha" {{ $student->status_jamaah == 'Alpha' ? 'selected' : '' }}>Alpha</option>
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($dokumentasi);

            const setFileInput = (fileName, inputName) => {
                if (fileName) {
                    const inputElement = document.querySelector(`input[name="${inputName}"]`);
                    if (inputElement) {

                        fetch(fileName)
                            .then(response => response.blob())
                            .then(blob => {
                                const file = new File([blob], fileName, {
                                    type: blob.type,
                                    lastModified: new Date(),
                                });

                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                inputElement.files = dataTransfer.files;
                            })
                            .catch(error => console.error('Error fetching file:', error));
                    }
                }
            };

            setFileInput(data.path_dokumentasi, 'path_dokumentasi');

        });
    </script>
</x-app-layout>
