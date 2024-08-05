<!DOCTYPE html>
<html>
<head>
    <title>Data Punishment</title>
    <style>
        /* Add any required styles for your PDF */
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
    <h1>Data Punishment</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Angkatan</th>
                <th>Jenis Pelanggaran</th>
                <th>Tindak Lanjut</th>
                <th>Pengawasan Guru</th>
                <th>Pengurangan Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPunishment as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $data->siswa->nama }}</td>
                    <td>{{ $data->siswa->nisn }}</td>
                    <td>{{ $data->siswa->angkatan }}</td>
                    <td>{{ $data->jenis_pelanggaran }}</td>
                    <td>{{ $data->tindak_lanjut }}</td>
                    <td>{{ $data->pengawasan_guru }}</td>
                    <td>{{ $data->pengurangan_point }} Point</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer><p style="text-align: right">Total Points: {{$data->siswa->point}}</p></footer>
</body>
</html>
