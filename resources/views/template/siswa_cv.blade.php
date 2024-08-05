<!-- resources/views/template/siswa_cv.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: left;
        }

        .title {
            text-align: center;
        }

        .profile-img {
            margin-top: 1rem;
        }

        .profile-img img {
            width: 150px;
            height: auto;
            border-radius: 10px;
        }

        .biodata {
            margin-top: 20px;
        }

        .biodata table {
            width: 100%;
        }

        .biodata table th,
        .biodata table td {
            text-align: left;
            padding: 5px 0;
        }

        .biodata table th {
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title" style="margin-top: 2rem">
            <h1 style="margin: 0">BIODATA SISWA</h1>
            <h3 style="margin: 0">SMK TI BAZMA KABUPATEN BOGOR</h3>
        </div>
        <div class="biodata">
            <table>
                <tr>
                    <th>Nama</th>
                    <td>: {{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>: {{ $siswa->tempat_tanggal_lahir }},
                        {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $siswa->alamat }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>: {{ $siswa->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>: {{ $siswa->agama }}</td>
                </tr>
                <tr>
                    <th>Tahun Pelajaran</th>
                    <td>: {{ $siswa->tahun_pelajaran }}</td>
                </tr>
                <tr>
                    <th>NISN</th>
                    <td>: {{ $siswa->nisn }}</td>
                </tr>
                <tr>
                    <th>NIS</th>
                    <td>: {{ $siswa->nis }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>: {{ \Carbon\Carbon::parse($siswa->tanggal_masuk)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Nama Ayah</th>
                    <td>: {{ $siswa->nama_ayah }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan Ayah</th>
                    <td>: {{ $siswa->pekerjaan_ayah }}</td>
                </tr>
                <tr>
                    <th>Nama Ibu</th>
                    <td>: {{ $siswa->nama_ibu }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan Ibu</th>
                    <td>: {{ $siswa->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <th>No. HP Wali</th>
                    <td>: {{ $siswa->no_hp_wali }}</td>
                </tr>
                <tr>
                    <th>Diterima di Kelas</th>
                    <td>: {{ $siswa->diterima_di_kelas }}</td>
                </tr>
                <tr>
                    <th>Asal Sekolah</th>
                    <td>: {{ $siswa->asal_sekolah }}</td>
                </tr>
                <tr>
                    <th>Alamat Asal Sekolah</th>
                    <td>: {{ $siswa->alamat_asal_sekolah }}</td>
                </tr>
                <tr>
                    <th>Status Siswa</th>
                    <td>: {{ $siswa->status_siswa }}</td>
                </tr>
            </table>
        </div>
        <div class="profile-img">
            <?php
                $path = public_path($siswa->fotoSiswa[0]->path_file);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
            <img src="{{ $base64 }}" alt="Profile Image">
        </div>
    </div>
</body>

</html>
