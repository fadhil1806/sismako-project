<!DOCTYPE html>
<html>
<head>
    <title>Edit Guru</title>
</head>
<body>
    @include('inc.form')
    <h1>Edit Data Guru</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('POST')

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $guru->nama) }}" required><br>

        <label for="no_nik">No NIK:</label>
        <input type="text" name="no_nik" id="no_nik" value="{{ old('no_nik', $guru->no_nik) }}" required><br>

        <label for="no_gtk">No GTK:</label>
        <input type="text" name="no_gtk" id="no_gtk" value="{{ old('no_gtk', $guru->no_gtk) }}" required><br>

        <label for="no_nuptk">No NUPTK:</label>
        <input type="text" name="no_nuptk" id="no_nuptk" value="{{ old('no_nuptk', $guru->no_nuptk) }}" required><br>

        <label for="tempat_tanggal_lahir">Tempat Tanggal Lahir:</label>
        <input type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir', $guru->tempat_tanggal_lahir) }}" required><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir->format('Y-m-d')) }}" required><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <label for="agama">Agama:</label>
        <select name="agama" id="agama" required>
            <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
            <option value="Kristen" {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
            <option value="Buddha" {{ old('agama', $guru->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
            <option value="Khonghucu" {{ old('agama', $guru->agama) == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
            <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
            <option value="Katolik" {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
        </select><br>

        <label for="nama_lulusan_pt">Nama Lulusan PT:</label>
        <input type="text" name="nama_lulusan_pt" id="nama_lulusan_pt" value="{{ old('nama_lulusan_pt', $guru->nama_lulusan_pt) }}" required><br>

        <label for="nama_jurusan_pt">Nama Jurusan PT:</label>
        <input type="text" name="nama_jurusan_pt" id="nama_jurusan_pt" value="{{ old('nama_jurusan_pt', $guru->nama_jurusan_pt) }}" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $guru->alamat) }}" required><br>

        <label for="no_hp">No HP:</label>
        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $guru->no_hp) }}" required><br>

        <label for="mapel">Mapel:</label>
        <input type="text" name="mapel" id="mapel" value="{{ old('mapel', $guru->mapel) }}" required><br>

        <label for="gelar">Gelar:</label>
        <input type="text" name="gelar" id="gelar" value="{{ old('gelar', $guru->gelar) }}" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $guru->email) }}" required><br>

        <label for="no_rekening">No Rekening:</label>
        <input type="text" name="no_rekening" id="no_rekening" value="{{ old('no_rekening', $guru->no_rekening) }}" required><br>

        <label for="status_kepegawaian">Status Kepegawaian:</label>
        <select name="status_kepegawaian" id="status_kepegawaian" required>
            <option value="Aktif" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak aktif" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Tidak aktif' ? 'selected' : '' }}>Tidak aktif</option>
        </select><br>

        <label for="tanggal_masuk">Tanggal Masuk:</label>
        <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', $guru->tanggal_masuk->format('Y-m-d')) }}" required><br>

        <label for="tanggal_keluar">Tanggal Keluar:</label>
        <input type="date" name="tanggal_keluar" id="tanggal_keluar" value="{{ old('tanggal_keluar', $guru->tanggal_keluar ? $guru->tanggal_keluar->format('Y-m-d') : '') }}"><br>

        <label for="foto">Foto:</label>
        <input type="text" name="foto" id="foto" value="{{ old('foto', $guru->foto) }}"><br>

        <label for="foto_ktp">Foto KTP:</label>
        <input type="text" name="foto_ktp" id="foto_ktp" value="{{ old('foto_ktp', $guru->foto_ktp) }}"><br>

        <label for="foto_surat_keterangan_mengajar">Foto Surat Keterangan Mengajar:</label>
        <input type="text" name="foto_surat_keterangan_mengajar" id="foto_surat_keterangan_mengajar" value="{{ old('foto_surat_keterangan_mengajar', $guru->foto_surat_keterangan_mengajar) }}"><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
