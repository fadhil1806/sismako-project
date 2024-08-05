<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        /* Define widths for specific columns */
        .no-urut {
            width:5%;
        }
        .nama {
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Kelas {{$dataKelas[0]->kelas}} Tahun Pelajaran {{date('Y')}}-{{date('Y')+1}}</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="no-urut">No</th>
                    <th class="nama">Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKelas as $data)
                    <tr>
                        <td class="no-urut">{{ $data->no_urut }}</td>
                        <td class="nama">{{ $data->siswa->nama ?? 'Tidak ada data' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
