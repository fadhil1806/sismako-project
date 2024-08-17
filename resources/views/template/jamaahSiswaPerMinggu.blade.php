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
    <h1>Data Jamaah Siswa Kelas {{ htmlspecialchars($kelas, ENT_QUOTES, 'UTF-8') }}</h1>
    <h3>Tanggal: {{ htmlspecialchars($startDate, ENT_QUOTES, 'UTF-8') }} - {{ htmlspecialchars($endDate, ENT_QUOTES, 'UTF-8') }}, Total Sholat: {{$totalPrayers}}</h3>
    
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Subuh</th>
                <th>Dzuhur</th>
                <th>Ashar</th>
                <th>Maghrib</th>
                <th>Isya</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Alpha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentScores as $idSiswa => $data)
            <tr>
                <td>{{ htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') }}</td>
                <td style="text-align: center">{{ $data['details']['Subuh'] ?? 0 }}</td>
                <td style="text-align: center">{{ $data['details']['Dzuhur'] ?? 0 }}</td>
                <td style="text-align: center">{{ $data['details']['Ashar'] ?? 0 }}</td>
                <td style="text-align: center">{{ $data['details']['Maghrib'] ?? 0 }}</td>
                <td style="text-align: center">{{ $data['details']['Isya'] ?? 0 }}</td>
                <td style="text-align: center">{{ $data['score'] }}</td>
                <td style="text-align: center">{{ $data['sick'] ?? 0 }}</td>
                <td style="text-align: center">{{ $data['absences'] ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
