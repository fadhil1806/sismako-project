<!DOCTYPE html>
<html>
<head>
    <title>Data Kelulusan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        /* Add any required styles for your PDF */
        body {
            font-family: 'Roboto', Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Kelulusan</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No handphone</th>
                <th>Email</th>
                <th>Tanggal kelulusan</th>
                <th>Angkatan</th>
                <th>Jurusan</th>
                <th>Karir selanjutnya</th>
                <th>Tahun Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataKelulusan as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->siswa->nama }}</td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_kelulusan)->format('d-m-Y') }}</td>
                    <td>{{ $data->angkatan }}</td>
                    <td>{{ $data->jurusan }}</td>
                    <td>{{ $data->karir_selanjutnya }}</td>
                    <td>{{ $data->tahun_pelajaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
