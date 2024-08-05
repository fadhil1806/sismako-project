<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <form method="post" action="{{ route('punishment.update', $punishment->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4" id="asalSekolahDiv">
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <select class="form-control" name="angkatan" id="angkatan-select">
                            <option value="">-- Pilih Angkatan --</option>
                            @foreach($angkatan as $data)
                                <option value="{{ $data }}" {{ $punishment->angkatan == $data ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                        @error('angkatan')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <select class="form-control" name="id_siswa" id="nama-select">
                            <option value="">-- Pilih Nama --</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                        @error('id_siswa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4" id="kelasDiv">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ $punishment->tanggal }}">
                        @error('tanggal')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Jenis Pelanggaran</label>
                        <input type="text" class="form-control" name="jenis_pelanggaran" placeholder="SIJA" value="{{ $punishment->jenis_pelanggaran }}">
                        @error('jenis_pelanggaran')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Pengurangan Point</label>
                        <input type="number" class="form-control" name="pengurangan_point" placeholder="100" value="{{ $punishment->pengurangan_point }}">
                        @error('pengurangan_point')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nama Guru Pengawas</label>
                        <input type="text" class="form-control" name="pengawasan_guru" value="{{ $punishment->pengawasan_guru }}">
                        @error('pengawasan_guru')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="path_dokumen">
                        @error('path_dokumen')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Kronologi</label>
                        <textarea class="form-control" rows="4" name="kronologi">{{ $punishment->kronologi }}</textarea>
                        @error('kronologi')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Tindak Lanjut</label>
                        <textarea class="form-control" rows="2" name="tindak_lanjut">{{old('tindak_lanjut', $punishment->tindak_lanjut)}}</textarea>
                        @error('tindak_lanjut')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="submitButton">Update</button>
            </div>
        </form>
    </div>
    <script>

document.addEventListener('DOMContentLoaded', function() {
        const data = @json($punishment);
        const setFileInput = (path, inputName) => {
            if (path) {
                const inputElement = document.querySelector(`input[name="${inputName}"]`);
                if (inputElement) {
                    const filePath = path;

                    fetch(filePath)
                        .then(response => response.blob())
                        .then(blob => {
                            const file = new File([blob], path, {
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

        setFileInput(data.path_dokumen, 'path_dokumen');
    });

         document.getElementById('angkatan-select').addEventListener('change', function() {
    const angkatan = this.value;
    const namesSelect = document.getElementById('nama-select');
    namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

    fetch(`/api/siswa?angkatan=${angkatan}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(siswa => {
                const option = document.createElement('option');
                option.value = siswa.id;
                option.textContent = siswa.nama;
                if (siswa.id == "{{ $punishment->id_siswa }}") {
                    option.selected = true;
                }
                namesSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching names:', error));
});

// Trigger change event to load names when the page loads
document.getElementById('angkatan-select').dispatchEvent(new Event('change'));


    </script>
</x-app-layout>
