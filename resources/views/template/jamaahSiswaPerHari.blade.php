<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Jamaah Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            color: #333;
        }
        h1, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #4CAF50;
            color: #ffffff;
        }
        h1 {
            font-size: 24px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        h3 {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Data Jamaah Siswa kelas {{ $kelas }}</h1>
    <h3>Tanggal: {{ $tanggal }}</h3>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Siswa</th>
                <th>Subuh</th>
                <th>Dzuhur</th>
                <th>Ashar</th>
                <th>Maghrib</th>
                <th>Isya</th>
            </tr>
        </thead>
        <tbody>
            @php
                $students = [];
                foreach ($dataBySholat as $sholat => $records) {
                    foreach ($records as $record) {
                        $students[$record->nama_siswa][$sholat] = 
                            $record->status_jamaah == 'Hadir' ? 'H' :
                            ($record->status_jamaah == 'Alpha' ? 'A' :
                            ($record->status_jamaah == 'Sakit' ? 'S' : ''));                    }
                }
            @endphp
            @foreach($students as $namaSiswa => $statuses)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $namaSiswa }}</td>
                    <td style="text-align: center">{{ $statuses['Subuh'] ?? '' }}</td>
                    <td style="text-align: center">{{ $statuses['Dzuhur'] ?? '' }}</td>
                    <td style="text-align: center">{{ $statuses['Ashar'] ?? '' }}</td>
                    <td style="text-align: center">{{ $statuses['Maghrib'] ?? '' }}</td>
                    <td style="text-align: center" >{{ $statuses['Isya'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
