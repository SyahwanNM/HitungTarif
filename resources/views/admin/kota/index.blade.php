<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Kota - Admin Panel</title>
    
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
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #55e3c4;
            border-color: #55e3c4;
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
            color: white;
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-danger-custom:hover {
            background-color: #ff5252;
            border-color: #ff5252;
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background-color: transparent;
            border: 1px solid var(--slate);
            color: var(--slate);
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background-color: var(--slate);
            color: var(--dark-blue);
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
                        <a class="nav-link active" href="{{ route('admin.kota.index') }}">Kelola Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hasil') }}">Hasil Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.perbandingan') }}">Perbandingan</a>
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
            <h1>Kelola Data Kota</h1>
            <p class="lead">Tambah, edit, atau hapus data kota untuk sistem AHP & SAW</p>
            <span class="admin-badge">ADMIN ONLY</span>
        </div>
    </div>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Data Kota</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.kota.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus"></i> Tambah Kota
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
                                    <th>UMR (IDR)</th>
                                    <th>Waktu Tempuh (detik)</th>
                                    <th>Armada Online</th>
                                    <th>Kendaraan Pribadi</th>
                                    <th>Harga Minimum Aktual</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kota as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $k->nama_kota }}</strong></td>
                                    <td>Rp {{ number_format($k->umr, 0, ',', '.') }}</td>
                                    <td>{{ number_format($k->waktu_tempuh, 0, ',', '.') }}</td>
                                    <td>{{ number_format($k->jumlah_armada, 0, ',', '.') }}</td>
                                    <td>{{ number_format($k->jumlah_kendaraan_pribadi, 0, ',', '.') }}</td>
                                    <td><strong>Rp {{ number_format($k->tarif_minimum_aktual, 0, ',', '.') }}</strong></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.kota.edit', $k->id) }}" class="btn btn-primary-custom btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.kota.destroy', $k->id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kota {{ $k->nama_kota }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger-custom btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
                        <p class="text-muted">Silakan tambah data kota terlebih dahulu</p>
                        <a href="{{ route('admin.kota.create') }}" class="btn btn-primary-custom">
                            <i class="fas fa-plus"></i> Tambah Kota Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
