<!DOCTYPE html>
<html>
<head>
    <title>Test AHP SAW</title>
</head>
<body>
    <h1>Test AHP SAW System</h1>
    <p>Total Kota: {{ $kota->count() }}</p>
    <ul>
        @foreach($kota as $k)
            <li>{{ $k->nama_kota }} - UMR: {{ $k->umr }}</li>
        @endforeach
    </ul>
</body>
</html>
