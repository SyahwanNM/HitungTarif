<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem AHP & SAW - Perbandingan Kota</title>
    
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
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--light-slate);
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--slate);
            max-width: 700px;
            margin: 1rem auto 2rem;
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

        .card {
            background-color: var(--light-blue);
            border: 1px solid #1d3b66;
            border-radius: 10px;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-cyan);
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

        .text-muted {
            color: #8892b0 !important;
        }

        .form-text {
            color: #8892b0 !important;
        }

        .badge {
            background-color: var(--accent-cyan);
            color: var(--dark-blue);
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
                        <a class="nav-link active" href="{{ route('ahp-saw.index') }}">Data Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ahp-saw.perhitungan') }}">Perhitungan</a>
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
            <h1>Sistem AHP & SAW</h1>
            <p>Perbandingan Kota untuk Rekomendasi Tarif Transportasi Online</p>
        </div>
    </div>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Data Kota</h2>
            </div>
            <div class="col-md-6 text-end">
                <span class="text-muted">Data kota dikelola oleh admin</span>
                <a href="{{ route('download.manual') }}" 
                   class="text-decoration-none ms-3" 
                   style="font-size: 0.9rem; color: #64ffda; opacity: 0.9;"
                   title="Download User Manual">
                    <i class="fas fa-question-circle me-1"></i>Bantuan
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Kota</h5>
            </div>
            <div class="card-body">
                @if($kota->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kota</th>
                                    <th>UMR</th>
                                    <th>Waktu Tempuh (detik/km)</th>
                                    <th>Jumlah Armada</th>
                                    <th>Kendaraan Pribadi</th>
                                    <th>Tarif Minimum</th>
                                    <th>Aksi</th>
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
                                    <td>
                                        @if($k->tarif_minimum_aktual)
                                            Rp {{ number_format($k->tarif_minimum_aktual, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted">-</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-city fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data kota</h5>
                        <p class="text-muted">Silakan hubungi admin untuk menambahkan data kota</p>
                    </div>
                @endif
            </div>
        </div>

        @if($kota->count() > 0)
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="{{ route('ahp-saw.perhitungan') }}" class="btn btn-primary-custom">
                    <i class="fas fa-calculator"></i> Lakukan Perhitungan AHP & SAW
                </a>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('ahp-saw.perbandingan') }}" class="btn btn-outline-primary">
                    <i class="fas fa-balance-scale"></i> Bandingkan Kota
                </a>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
