<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perbandingan Kota - Sistem AHP & SAW</title>
    
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

        .vs-text {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-cyan);
            text-align: center;
            margin: 1rem 0;
        }

        .city-card {
            background: linear-gradient(135deg, var(--light-blue), #1d3b66);
            border: 2px solid #1d3b66;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .city-card.acuan {
            border-color: var(--accent-cyan);
            background: linear-gradient(135deg, var(--accent-cyan), #55e3c4);
            color: var(--dark-blue);
        }

        .city-card.banding {
            border-color: #ff6b6b;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
        }

        .city-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .city-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
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

        .small {
            color: var(--light-slate) !important;
        }

        small {
            color: var(--light-slate) !important;
        }

        .rekomendasi-card {
            background: linear-gradient(135deg, var(--accent-cyan), #55e3c4);
            color: var(--dark-blue);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            margin: 2rem 0;
        }

        .rekomendasi-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .rekomendasi-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .selisih {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .selisih.positif {
            color: #28a745;
        }

        .selisih.negatif {
            color: #dc3545;
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
                        <a class="nav-link" href="{{ route('ahp-saw.index') }}">Data Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ahp-saw.perhitungan') }}">Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('ahp-saw.perbandingan') }}">Perbandingan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Hasil Perbandingan Kota</h1>
            <p class="lead">Rekomendasi tarif transportasi berdasarkan perbandingan skor preferensi</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <div class="city-card acuan">
                    <div class="city-name">{{ $kotaAcuan->nama_kota }}</div>
                    <div class="city-detail">
                        <strong>Skor Preferensi:</strong> {{ number_format($tarifRekomendasi->skor_acuan, 4) }}
                    </div>
                    <div class="city-detail">
                        <strong>Tarif Acuan:</strong> Rp {{ number_format($tarifRekomendasi->tarif_acuan, 0, ',', '.') }}
                    </div>
                    <div class="city-detail">
                        <strong>UMR:</strong> Rp {{ number_format($kotaAcuan->umr, 0, ',', '.') }}
                    </div>
                    <div class="city-detail">
                        <strong>Waktu Tempuh:</strong> {{ $kotaAcuan->waktu_tempuh }} detik/km
                    </div>
                    <div class="city-detail">
                        <strong>Armada:</strong> {{ number_format($kotaAcuan->jumlah_armada, 0, ',', '.') }}
                    </div>
                    <div class="city-detail">
                        <strong>Kendaraan Pribadi:</strong> {{ number_format($kotaAcuan->jumlah_kendaraan_pribadi, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <div class="vs-text">VS</div>
            </div>

            <div class="col-md-5">
                <div class="city-card banding">
                    <div class="city-name">{{ $kotaBanding->nama_kota }}</div>
                    <div class="city-detail">
                        <strong>Skor Preferensi:</strong> {{ number_format($tarifRekomendasi->skor_banding, 4) }}
                    </div>
                    <div class="city-detail">
                        <strong>Tarif Aktual:</strong> 
                        @if($tarifRekomendasi->tarif_aktual)
                            Rp {{ number_format($tarifRekomendasi->tarif_aktual, 0, ',', '.') }}
                        @else
                            <span class="text-muted">Tidak tersedia</span>
                        @endif
                    </div>
                    <div class="city-detail">
                        <strong>UMR:</strong> Rp {{ number_format($kotaBanding->umr, 0, ',', '.') }}
                    </div>
                    <div class="city-detail">
                        <strong>Waktu Tempuh:</strong> {{ $kotaBanding->waktu_tempuh }} detik/km
                    </div>
                    <div class="city-detail">
                        <strong>Armada:</strong> {{ number_format($kotaBanding->jumlah_armada, 0, ',', '.') }}
                    </div>
                    <div class="city-detail">
                        <strong>Kendaraan Pribadi:</strong> {{ number_format($kotaBanding->jumlah_kendaraan_pribadi, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="rekomendasi-card">
            <div class="rekomendasi-title">
                <i class="fas fa-calculator"></i> Rekomendasi Tarif Minimum
            </div>
            <div class="rekomendasi-value">
                Rp {{ number_format($tarifRekomendasi->tarif_rekomendasi, 0, ',', '.') }}
            </div>
            <div class="mb-3">
                <strong>Berdasarkan perbandingan skor preferensi:</strong><br>
                {{ $kotaBanding->nama_kota }} vs {{ $kotaAcuan->nama_kota }}
            </div>
            
            @if($tarifRekomendasi->tarif_aktual)
                <div class="selisih {{ $tarifRekomendasi->selisih >= 0 ? 'positif' : 'negatif' }}">
                    <i class="fas fa-arrow-{{ $tarifRekomendasi->selisih >= 0 ? 'up' : 'down' }}"></i>
                    Selisih: Rp {{ number_format(abs($tarifRekomendasi->selisih), 0, ',', '.') }}
                    {{ $tarifRekomendasi->selisih >= 0 ? 'lebih tinggi' : 'lebih rendah' }} dari tarif aktual
                </div>
            @endif
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle"></i> Penjelasan Perhitungan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Formula Perhitungan:</h6>
                                <p class="small">
                                    <strong>Tarif Rekomendasi = Tarif Acuan × (Skor Banding / Skor Acuan)</strong>
                                </p>
                                <p class="small">
                                    = Rp {{ number_format($tarifRekomendasi->tarif_acuan, 0, ',', '.') }} × 
                                    ({{ number_format($tarifRekomendasi->skor_banding, 4) }} / {{ number_format($tarifRekomendasi->skor_acuan, 4) }})
                                </p>
                                <p class="small">
                                    = Rp {{ number_format($tarifRekomendasi->tarif_rekomendasi, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Interpretasi:</h6>
                                <ul class="small">
                                    <li>Skor preferensi dihitung menggunakan metode SAW</li>
                                    <li>Bobot kriteria ditentukan menggunakan metode AHP</li>
                                    <li>Rasio skor digunakan untuk menyesuaikan tarif</li>
                                    <li>Semakin tinggi skor, semakin tinggi rekomendasi tarif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('ahp-saw.perbandingan') }}" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-redo"></i> Bandingkan Kota Lain
                </a>
                <a href="{{ route('ahp-saw.hasil') }}" class="btn btn-secondary-custom btn-lg ms-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Hasil
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
