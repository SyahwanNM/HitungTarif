<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbandingan Kota - Admin Panel</title>
    
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

        .comparison-card {
            background: linear-gradient(135deg, var(--accent-cyan), #55e3c4);
            color: var(--dark-blue);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(100, 255, 218, 0.3);
        }

        .comparison-card h6 {
            color: var(--dark-blue);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .comparison-card small {
            color: var(--dark-blue);
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .comparison-card strong {
            color: var(--dark-blue);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .admin-badge {
            background-color: #ff6b6b;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-cog"></i> Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ahp-saw') }}">User View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.kota.index') }}">Kelola Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hasil') }}">Hasil Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.perbandingan') }}">Perbandingan</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none" style="border: none; background: none;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Perbandingan Kota</h1>
            <p class="lead">Monitoring perbandingan dan rekomendasi tarif</p>
            <span class="admin-badge">ADMIN ONLY</span>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-balance-scale"></i> Lakukan Perbandingan
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/ahp-saw/bandingkan') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="kota_acuan_id" class="form-label">Kota Acuan</label>
                                <select class="form-select" id="kota_acuan_id" name="kota_acuan_id" required>
                                    <option value="">Pilih Kota Acuan</option>
                                    @foreach($kota as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kota_banding_id" class="form-label">Kota Pembanding</label>
                                <select class="form-select" id="kota_banding_id" name="kota_banding_id" required>
                                    <option value="">Pilih Kota Pembanding</option>
                                    @foreach($kota as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="fas fa-calculator"></i> Bandingkan Kota
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-history"></i> Riwayat Perbandingan
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($perbandingan->count() > 0)
                            @foreach($perbandingan as $p)
                                <div class="comparison-card">
                                    <h6>{{ $p->kotaAcuan->nama_kota }} vs {{ $p->kotaBanding->nama_kota }}</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <small>Tarif Rekomendasi</small><br>
                                            <strong>Rp {{ number_format($p->tarif_rekomendasi, 0, ',', '.') }}</strong>
                                        </div>
                                        <div class="col-6">
                                            <small>Tarif Aktual</small><br>
                                            <strong>Rp {{ number_format($p->tarif_aktual, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                    @if($p->selisih)
                                        <div class="mt-2">
                                            <small>Selisih: 
                                                <span class="{{ $p->selisih > 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ $p->selisih > 0 ? '+' : '' }}Rp {{ number_format($p->selisih, 0, ',', '.') }}
                                                </span>
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-balance-scale fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Belum ada perbandingan</h6>
                                <p class="text-muted">Lakukan perbandingan kota terlebih dahulu</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-table"></i> Tabel Perbandingan Lengkap
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($perbandingan->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Kota Acuan</th>
                                            <th>Kota Pembanding</th>
                                            <th>Skor Acuan</th>
                                            <th>Skor Pembanding</th>
                                            <th>Tarif Acuan</th>
                                            <th>Tarif Rekomendasi</th>
                                            <th>Tarif Aktual</th>
                                            <th>Selisih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perbandingan as $p)
                                        <tr>
                                            <td><strong>{{ $p->kotaAcuan->nama_kota }}</strong></td>
                                            <td><strong>{{ $p->kotaBanding->nama_kota }}</strong></td>
                                            <td>{{ number_format($p->skor_acuan, 4) }}</td>
                                            <td>{{ number_format($p->skor_banding, 4) }}</td>
                                            <td>Rp {{ number_format($p->tarif_acuan, 0, ',', '.') }}</td>
                                            <td><strong>Rp {{ number_format($p->tarif_rekomendasi, 0, ',', '.') }}</strong></td>
                                            <td>Rp {{ number_format($p->tarif_aktual, 0, ',', '.') }}</td>
                                            <td>
                                                @if($p->selisih)
                                                    <span class="{{ $p->selisih > 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $p->selisih > 0 ? '+' : '' }}Rp {{ number_format($p->selisih, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-table fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data perbandingan</h5>
                                <p class="text-muted">Lakukan perbandingan kota terlebih dahulu</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ url('/ahp-saw/perbandingan') }}" class="btn btn-primary-custom">
                    <i class="fas fa-balance-scale"></i> Perbandingan User View
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary-custom ms-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
