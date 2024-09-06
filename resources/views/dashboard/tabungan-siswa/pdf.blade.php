<!DOCTYPE html>
<html>
<head>
    <title>Tabungan Siswa - {{ $tabunganSiswa->first()->siswa->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        h2 {
            text-align: center;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Data Tabungan Siswa</h2>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Petugas</th>
                <th>Sisa Saldo</th>
                <th>Mulai Menabung</th>
                <th>Update Tabungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tabunganSiswa as $index => $tabungan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $tabungan->users->name }}</td>
                <td>{{ $tabungan->saldo }}</td>
                <td>{{ $tabungan->created_at->format('d M, Y H:i') }}</td>
                <td>{{ $tabungan->updated_at->format('d M, Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
