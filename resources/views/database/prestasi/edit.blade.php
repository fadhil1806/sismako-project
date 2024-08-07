<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <a href="{{route('prestasi.index')}}" class="btn btn-secondary mb-4">Back</a>
    <form method="post" action="{{route('prestasi.update', $prestasi->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="name" value="{{old('nama', $prestasi->nama)}}">
                    @error('nama')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-2">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" value="{{old('status')}}">
                        <option value="Guru" {{ $prestasi->status == 'Guru' ? 'selected' : '' }}>Guru</option>
                        <option value="Siswa" {{ $prestasi->status == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-2">
                <div class="mb-3">
                    <label class="form-label">Kelas ( Optional )</label>
                    <select class="form-select" name="kelas" value="{{old('kelas')}}">
                        <option value="" {{ $prestasi->kelas == '' ? 'selected' : '' }}></option>
                        <option value="X" {{ $prestasi->kelas == 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ $prestasi->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ $prestasi->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                        <option value="XIII" {{ $prestasi->kelas == 'XIII' ? 'selected' : '' }}>XIII</option>
                    </select>
                    @error('kelas')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Tanggal lomba</label>
                    <input type="date" class="form-control" name="tanggal_lomba" value="{{old('tanggal_lomba', $prestasi->tanggal_lomba)}}">
                    @error('tanggal_lomba')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Peringkat</label>
                    <input type="text" class="form-control" name="peringkat" value="{{old('peringkat', $prestasi->peringkat)}}">
                    @error('peringkat')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <label class="form-label">Dokumentasi ( Sertifikat atau Foto )</label>
                    <input type="file" id="dokumentasi" class="form-control" name="path_sertifikat" rows="4" value="{{$prestasi->nama_file}}"></input>
                    @error('path_sertifikat')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <label class="form-label">Tempat lomba</label>
                    <textarea class="form-control" name="tempat_lomba" rows="4">{{old('tempat_lomba', $prestasi->tempat_lomba)}}</textarea>
                    @error('tempat_lomba')
                        <div class="text-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-success " id="submitButton">Submit</button>
        </div>
    </form>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const prestasi = @json($prestasi); // Mengambil nilai $prestasi dari Blade ke JavaScript
    const filePath = prestasi.nama_file; // Path dari file yang ingin diambil

    const inputElement = document.querySelector(`input[name="path_sertifikat"]`);

    // Fungsi untuk menetapkan nilai input file berdasarkan path
    const setFileInput = (filePath) => {
        fetch(filePath)
            .then(response => {
                if (!response.ok) {
                    throw new Error('File tidak ditemukan');
                }
                return response.blob();
            })
            .then(blob => {
                const fileName = filePath.substring(filePath.lastIndexOf('/') + 1); // Mendapatkan nama file dari path
                const file = new File([blob], fileName, {
                    type: blob.type,
                    lastModified: new Date()
                });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                // Menetapkan files ke inputElement
                if (inputElement) {
                    inputElement.files = dataTransfer.files;
                }
            })
            .catch(error => console.error('Error fetching file:', error));
    };

    // Memanggil fungsi untuk menetapkan input file
    setFileInput(filePath);
});

</script>
</x-app-layout>
