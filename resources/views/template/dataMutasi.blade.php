<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mutasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Mutasi</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Mutasi</th>
                <th>Tanggal Mutasi</th>
                <th>Asal Sekolah</th>
                <th>Tujuan Berikutnya</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataMutasi as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->mutasi }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_mutasi)->format('d-m-Y') }}</td>
                    <td>{{ $data->asal_sekolah }}</td>
                    <td>{{ $data->tujuan_berikutnya }}</td>
                    <td>{{ $data->alasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
