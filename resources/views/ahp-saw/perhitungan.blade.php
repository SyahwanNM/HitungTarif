<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan AHP & SAW - Sistem Perbandingan Kota</title>
    
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
        }

        .table td {
            border-color: #1d3b66;
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

        .info-box {
            background-color: #1d3b66;
            border: 1px solid #1d3b66;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
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
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark-blue);
            opacity: 0.8;
        }

        .text-muted {
            color: #8892b0 !important;
        }

        .form-text {
            color: #8892b0 !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .small {
            color: var(--light-slate) !important;
        }

        small {
            color: var(--light-slate) !important;
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
                        <a class="nav-link active" href="{{ route('ahp-saw.perhitungan') }}">Perhitungan</a>
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
            <h1>Perhitungan AHP & SAW</h1>
            <p class="lead">Analisis perbandingan kota menggunakan metode AHP dan SAW</p>
        </div>
    </div>

    <div class="container py-5">
        @if($kota->count() < 2)
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Peringatan!</strong> Minimal diperlukan 2 kota untuk melakukan perhitungan AHP & SAW.
                <a href="{{ route('ahp-saw.create') }}" class="alert-link">Tambah kota</a> terlebih dahulu.
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-calculator"></i> Data Kota yang Akan Dihitung
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kota</th>
                                            <th>UMR</th>
                                            <th>Waktu Tempuh</th>
                                            <th>Armada</th>
                                            <th>Kendaraan Pribadi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kota as $index => $k)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $k->nama_kota }}</strong></td>
                                            <td>Rp {{ number_format($k->umr, 0, ',', '.') }}</td>
                                            <td>{{ $k->waktu_tempuh }} detik</td>
                                            <td>{{ number_format($k->jumlah_armada, 0, ',', '.') }}</td>
                                            <td>{{ number_format($k->jumlah_kendaraan_pribadi, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-weight"></i> Bobot Kriteria AHP
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach($kriteria as $k)
                            <div class="info-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><strong>{{ $k->kode_kriteria }}</strong> - {{ $k->nama_kriteria }}</span>
                                    <span class="badge">{{ number_format($bobot[$k->kode_kriteria]->bobot * 100, 1) }}%</span>
                                </div>
                                <small class="text-muted">
                                    Jenis: {{ $k->jenis == 'benefit' ? 'Benefit (Semakin besar semakin baik)' : 'Cost (Semakin kecil semakin baik)' }}
                                </small>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle"></i> Informasi
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="small">
                                <strong>AHP (Analytic Hierarchy Process):</strong> Metode untuk menentukan bobot kriteria berdasarkan perbandingan berpasangan.
                            </p>
                            <p class="small">
                                <strong>SAW (Simple Additive Weighting):</strong> Metode untuk menghitung skor preferensi akhir berdasarkan normalisasi dan bobot kriteria.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @if($kotaDenganHasil && $kotaDenganHasil->count() > 0)
            <!-- Section Hasil Perhitungan -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-trophy"></i> Hasil Perhitungan AHP & SAW
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                // Hitung skor preferensi total untuk setiap kota
                                $kotaSkor = [];
                                foreach($kotaDenganHasil as $k) {
                                    $totalSkor = $k->hasilPerhitungan->sum('skor_preferensi');
                                    $kotaSkor[] = [
                                        'kota' => $k,
                                        'skor' => $totalSkor
                                    ];
                                }
                                // Urutkan berdasarkan skor tertinggi
                                usort($kotaSkor, function($a, $b) {
                                    return $b['skor'] <=> $a['skor'];
                                });
                            @endphp

                            <!-- Ranking Kota -->
                            <div class="row mb-4">
                                @foreach($kotaSkor as $index => $item)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="ranking-card">
                                        <div class="ranking-number">#{{ $index + 1 }}</div>
                                        <h4 class="mb-2">{{ $item['kota']->nama_kota }}</h4>
                                        <div class="skor-preferensi">
                                            Skor: {{ number_format($item['skor'], 6) }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Tabel Detail Hasil -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Peringkat</th>
                                            <th>Nama Kota</th>
                                            <th>Skor Preferensi</th>
                                            <th>Detail Kriteria</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kotaSkor as $index => $item)
                                        <tr>
                                            <td><span class="badge">{{ $index + 1 }}</span></td>
                                            <td><strong>{{ $item['kota']->nama_kota }}</strong></td>
                                            <td>{{ number_format($item['skor'], 6) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#detail{{ $item['kota']->id }}">
                                                    <i class="fas fa-eye"></i> Lihat Detail
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="detail{{ $item['kota']->id }}">
                                            <td colspan="4">
                                                <div class="card bg-dark">
                                                    <div class="card-body">
                                                        <h6>Detail Perhitungan {{ $item['kota']->nama_kota }}:</h6>
                                                        <div class="row">
                                                            @foreach($item['kota']->hasilPerhitungan as $hasil)
                                                            <div class="col-md-6 mb-2">
                                                                <small>
                                                                    <strong>{{ $hasil->kriteria->kode_kriteria }}:</strong> 
                                                                    {{ number_format($hasil->nilai_asli, 4) }} → 
                                                                    {{ number_format($hasil->nilai_normalisasi, 4) }} × 
                                                                    {{ number_format($hasil->bobot, 4) }} = 
                                                                    <span class="text-warning">{{ number_format($hasil->skor_preferensi, 6) }}</span>
                                                                </small>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <form action="{{ route('ahp-saw.hitung') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-play"></i> Mulai Perhitungan AHP & SAW
                        </button>
                    </form>
                    <a href="{{ route('ahp-saw.index') }}" class="btn btn-secondary-custom btn-lg ms-3">
                        <i class="fas fa-arrow-left"></i> Kembali ke Data Kota
                    </a>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
