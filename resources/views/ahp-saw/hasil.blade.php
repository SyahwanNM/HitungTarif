<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan AHP & SAW - Sistem Perbandingan Kota</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --dark-blue: #0a192f;
            --light-blue: #172a46;
            --accent-cyan: #64ffda;
            --light-slate: #ccd6f6;
            --slate: #8892b0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-blue);
            color: var(--light-slate);
        }

        .navbar {
            background-color: rgba(10, 25, 47, 0.85);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            color: var(--accent-cyan);
            font-weight: 600;
        }

        .nav-link {
            color: var(--slate);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent-cyan);
        }

        .hero {
            background: linear-gradient(rgba(10, 25, 47, 0.95), rgba(10, 25, 47, 0.95));
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--light-slate);
        }

        .card {
            background-color: var(--light-blue);
            border: 1px solid #1d3b66;
            border-radius: 10px;
        }

        .card-header {
            background-color: #1d3b66;
            border-bottom: 1px solid #1d3b66;
            color: var(--light-slate);
            font-weight: 600;
        }

        .table {
            color: var(--light-slate);
        }

        .table th {
            border-color: #1d3b66;
            color: var(--accent-cyan);
            background-color: #1d3b66;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .table td {
            border-color: #1d3b66;
            color: var(--light-slate);
            font-weight: 500;
        }

        .table tbody tr:nth-child(odd) {
            background-color: rgba(29, 59, 102, 0.3);
        }

        .table tbody tr:hover {
            background-color: rgba(100, 255, 218, 0.1);
        }

        .table strong {
            color: var(--accent-cyan);
            font-weight: 700;
        }

        .btn-primary-custom {
            background-color: var(--accent-cyan);
            border-color: var(--accent-cyan);
            color: var(--dark-blue);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #55e3c4;
            border-color: #55e3c4;
            transform: translateY(-3px);
        }

        .btn-secondary-custom {
            background-color: transparent;
            border: 1px solid var(--slate);
            color: var(--slate);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background-color: var(--slate);
            color: var(--dark-blue);
        }

        .badge {
            background-color: var(--accent-cyan);
            color: var(--dark-blue);
        }

        .ranking-card {
            background: linear-gradient(135deg, var(--accent-cyan), #55e3c4);
            color: var(--dark-blue);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(100, 255, 218, 0.3);
        }

        .ranking-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-blue);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .skor-preferensi {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-blue);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .text-muted {
            color: #8892b0 !important;
        }

        .form-text {
            color: #8892b0 !important;
        }

        .text-danger {
            color: #ff6b6b !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .ranking-card h4 {
            color: var(--dark-blue);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Sistem AHP & SAW</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ahp-saw.index') }}">Data Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ahp-saw.perhitungan') }}">Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('ahp-saw.hasil') }}">Hasil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ahp-saw.perbandingan') }}">Perbandingan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Hasil Perhitungan AHP & SAW</h1>
            <p class="lead">Ranking kota berdasarkan skor preferensi akhir</p>
        </div>
    </div>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-trophy"></i> Ranking Kota
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $kotaRanking = $kota->sortByDesc(function($k) {
                                return $k->hasilPerhitungan->sum('skor_preferensi');
                            });
                        @endphp

                        @foreach($kotaRanking as $index => $k)
                            @php
                                $totalSkor = $k->hasilPerhitungan->sum('skor_preferensi');
                            @endphp
                            <div class="ranking-card">
                                <div class="ranking-number">#{{ $index + 1 }}</div>
                                <h4>{{ $k->nama_kota }}</h4>
                                <div class="skor-preferensi">
                                    Skor Preferensi: {{ number_format($totalSkor, 4) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar"></i> Detail Perhitungan
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($kota as $k)
                            <div class="mb-3">
                                <h6>{{ $k->nama_kota }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Normalisasi</th>
                                                <th>Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($k->hasilPerhitungan as $hp)
                                            <tr>
                                                <td>{{ $hp->kriteria->kode_kriteria }}</td>
                                                <td>{{ number_format($hp->nilai_normalisasi, 4) }}</td>
                                                <td>{{ number_format($hp->skor_preferensi, 4) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-primary">
                                                <th>Total</th>
                                                <th>-</th>
                                                <th>{{ number_format($k->hasilPerhitungan->sum('skor_preferensi'), 4) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('ahp-saw.perbandingan') }}" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-balance-scale"></i> Bandingkan Kota
                </a>
                <a href="{{ route('ahp-saw.perhitungan') }}" class="btn btn-secondary-custom btn-lg ms-3">
                    <i class="fas fa-redo"></i> Hitung Ulang
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
