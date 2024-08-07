<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelulusan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            text-align: left;
        }

        .title {
            text-align: center;
        }

        .profile {
            display: table;
            width: 100%;
            margin-top: 30px;
        }

        .biodata {
            display: table-cell;
            width: 65%;
            vertical-align: top;
        }

        .profile-img {
            display: table-cell;
            width: 35%;
            padding-left: 1rem;
            vertical-align: top;
            text-align: center;
        }

        .profile-img img {
            width: 100%;
            height: auto;
            border-radius: 10px;
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
            <h1 style="margin: 0">DATA KELULUSAN</h1>
            <h3 style="margin: 0">SMK TI BAZMA KABUPATEN BOGOR</h3>
        </div>
        <div class="profile">
            <div class="biodata">
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>: {{ $data_kelulusan->siswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Tanggal Lahir</th>
                        <td>{{$data_kelulusan->siswa->tempat_tanggal_lahir . ', ' . $data_kelulusan->siswa->tanggal_lahir}}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{$data_kelulusan->siswa->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <th>No. NISN</th>
                        <td>: {{ $data_kelulusan->siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th>No. NIS</th>
                        <td>: {{ $data_kelulusan->siswa->nis }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Pelajaran</th>
                        <td>: {{ $data_kelulusan->tahun_pelajaran }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>: {{ $data_kelulusan->jurusan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kelulusan</th>
                        <td>: {{ \Carbon\Carbon::parse($data_kelulusan->tanggal_kelulusan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Angkatan</th>
                        <td>: {{ $data_kelulusan->angkatan }}</td>
                    </tr>
                    <tr>
                        <th>Karir Selanjutnya</th>
                        <td>: {{ $data_kelulusan->karir_selanjutnya }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Handphone</th>
                        <td>: {{ $data_kelulusan->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $data_kelulusan->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ str_replace('==', '', $data_kelulusan->siswa->alamat) }}</td>
                    </tr>
                </table>
            </div>
            <div class="profile-img">
                <?php
                    $path = public_path($data_kelulusan->path_foto);
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <img src="{{ $base64 }}" alt="Profile Image">
            </div>
        </div>
    </div>
</body>

</html>
