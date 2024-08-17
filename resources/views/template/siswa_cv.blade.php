<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Siswa</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            border-radius: 10px;
            margin: 0 auto;
            max-width: 800px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h1 {
            margin: 0;
            font-size: 24px;
            color: #004085;
        }

        .title h3 {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }

        .profile {
            display: table;
            width: 100%;
            margin-top: 20px;
        }

        .biodata {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }

        .profile-img {
            display: table-cell;
            width: 40%;
            padding-left: 20px;
            vertical-align: top;
            text-align: center;
        }

        .profile-img img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .biodata table {
            width: 100%;
            border-collapse: collapse;
        }

        .biodata table th,
        .biodata table td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .biodata table th {
            width: 150px;
            color: #004085;
            text-align: left;
            font-weight: 700;
        }

        .biodata table td {
            color: #333;
        }

        .biodata table tr:last-child th,
        .biodata table tr:last-child td {
            border-bottom: none;
        }

        @media print {
            body {
                font-family: 'Roboto', Arial, sans-serif;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
            }

            .container {
                padding: 10px;
                border: none;
                border-radius: 0;
            }

            .title {
                text-align: center;
                margin-bottom: 10px;
            }

            .title h1 {
                font-size: 20px;
            }

            .title h3 {
                font-size: 16px;
            }

            .profile {
                display: block;
                width: 100%;
                margin-top: 10px;
            }

            .biodata,
            .profile-img {
                display: block;
                width: 100%;
            }

            .profile-img {
                padding-left: 0;
                text-align: center;
            }

            .profile-img img {
                max-width: 80%;
                height: auto;
            }

            .biodata table th,
            .biodata table td {
                padding: 4px 0;
                border-bottom: 1px solid #ddd;

            }

            .biodata table th {
                width: auto;
                color: #004085;
                font-weight: bold;
                left: 0; /* Menjaga kolom tetap di tempat saat scroll */

            }

            .biodata table td {
                color: #333;
            }

            .biodata table tr:last-child th,
            .biodata table tr:last-child td {
                border-bottom: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Biodata Siswa</h1>
            <h3>SMK TI BAZMA KABUPATEN BOGOR</h3>
        </div>
        <div class="profile">
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
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $siswa->alamat }}</td>
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
    </div>
</body>

</html>
