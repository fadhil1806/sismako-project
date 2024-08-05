<!DOCTYPE html>
<html>
<head>
    <title>Data Prestasi</title>
    <style>
        /* Styling for the entire document */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        thead {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Data Prestasi</h1>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Peringkat</th>
                    <th>Tanggal Lomba</th>
                    <th>Tempat Lomba</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPrestasi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->peringkat }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_lomba)->format('d-m-Y') }}</td>
                        <td>{{ $data->tempat_lomba }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
