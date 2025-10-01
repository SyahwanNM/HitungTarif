<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kota - Admin Panel</title>
    
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

        .form-control {
            background-color: #1d3b66;
            border: 1px solid #1d3b66;
            color: var(--light-slate);
            font-weight: 500;
        }

        .form-control:focus {
            background-color: #1d3b66;
            border-color: var(--accent-cyan);
            color: var(--light-slate);
            box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.25);
        }

        .form-control::placeholder {
            color: var(--slate);
            opacity: 0.8;
        }

        .form-label {
            color: var(--light-slate);
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .input-group-text {
            background-color: #1d3b66;
            border: 1px solid #1d3b66;
            color: var(--light-slate);
            font-weight: 500;
        }

        .form-text {
            color: var(--slate);
            font-weight: 500;
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

        .invalid-feedback {
            color: #ff6b6b;
        }

        .is-invalid {
            border-color: #ff6b6b;
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
            <h1>Edit Data Kota: {{ $kota->nama_kota }}</h1>
            <span class="admin-badge">ADMIN ONLY</span>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-edit"></i> Form Edit Data Kota
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kota.update', $kota->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nama_kota" class="form-label">Nama Kota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_kota') is-invalid @enderror" 
                                           id="nama_kota" name="nama_kota" value="{{ old('nama_kota', $kota->nama_kota) }}" 
                                           placeholder="Masukkan nama kota" required>
                                    @error('nama_kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="umr" class="form-label">UMR (Upah Minimum Regional) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('umr') is-invalid @enderror" 
                                               id="umr" name="umr" value="{{ old('umr', $kota->umr) }}" 
                                               placeholder="0" min="0" step="1000" required>
                                    </div>
                                    @error('umr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="waktu_tempuh" class="form-label">Waktu Tempuh Rata-rata <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('waktu_tempuh') is-invalid @enderror" 
                                               id="waktu_tempuh" name="waktu_tempuh" value="{{ old('waktu_tempuh', $kota->waktu_tempuh) }}" 
                                               placeholder="0" min="0" step="0.1" required>
                                        <span class="input-group-text">detik/km</span>
                                    </div>
                                    @error('waktu_tempuh')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_armada" class="form-label">Jumlah Armada Ojol <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_armada') is-invalid @enderror" 
                                           id="jumlah_armada" name="jumlah_armada" value="{{ old('jumlah_armada', $kota->jumlah_armada) }}" 
                                           placeholder="0" min="0" required>
                                    @error('jumlah_armada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_kendaraan_pribadi" class="form-label">Jumlah Kendaraan Pribadi <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_kendaraan_pribadi') is-invalid @enderror" 
                                           id="jumlah_kendaraan_pribadi" name="jumlah_kendaraan_pribadi" value="{{ old('jumlah_kendaraan_pribadi', $kota->jumlah_kendaraan_pribadi) }}" 
                                           placeholder="0" min="0" required>
                                    @error('jumlah_kendaraan_pribadi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="tarif_minimum_aktual" class="form-label">Harga Minimum Aktual <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('tarif_minimum_aktual') is-invalid @enderror" 
                                               id="tarif_minimum_aktual" name="tarif_minimum_aktual" value="{{ old('tarif_minimum_aktual', $kota->tarif_minimum_aktual) }}" 
                                               placeholder="0" min="0" step="100" required>
                                    </div>
                                    <div class="form-text text-muted">
                                        Masukkan harga minimum aktual ojol di kota ini (wajib diisi)
                                    </div>
                                    @error('tarif_minimum_aktual')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary-custom">
                                    <i class="fas fa-save"></i> Update Data
                                </button>
                                <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary-custom">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
