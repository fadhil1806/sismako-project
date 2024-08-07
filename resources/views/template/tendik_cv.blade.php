<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Tendik</title>
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
            <h1 style="margin: 0">BIODATA TENDIK</h1>
            <h3 style="margin: 0">SMK TI BAZMA KABUPATEN BOGOR</h3>
        </div>
        <div class="profile">
            <div class="biodata">
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>: {{ $tendik->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>: {{ $tendik->tempat_tanggal_lahir }},
                            {{ \Carbon\Carbon::parse($tendik->tanggal_lahir)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Handphone</th>
                        <td>: {{ $tendik->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: {{ $tendik->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>: {{ $tendik->agama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $tendik->email }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan Terakhir</th>
                        <td>: {{ $tendik->pendidikan_terakhir }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Rekening</th>
                        <td>: {{ $tendik->no_rekening }}</td>
                    </tr>
                    <tr>
                        <th>Nomor NIK</th>
                        <td>: {{ $tendik->no_nik }}</td>
                    </tr>
                    <tr>
                        <th>Nomor GTK</th>
                        <td>: {{ $tendik->no_gtk }}</td>
                    </tr>
                    <tr>
                        <th>Nomor NUPTK</th>
                        <td>: {{ $tendik->no_nuptk }}</td>
                    </tr>
                    <tr>
                        <th>Posisi Jabatan</th>
                        <td>: {{ $tendik->posisi }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>: {{ \Carbon\Carbon::parse($tendik->tanggal_masuk)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keluar</th>
                        <td>: {{ $tendik->tanggal_keluar ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Kepegawaian</th>
                        <td>: {{ $tendik->status_kepegawaian }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ str_replace('==', '', $tendik->alamat) }}</td>
                    </tr>
                </table>
            </div>
            <div class="profile-img">
                <?php
                    $path = public_path($tendik->foto);
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
