<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem AHP & SAW</title>
    
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
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-container {
            background: linear-gradient(135deg, var(--light-blue), #1d3b66);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--accent-cyan), #55e3c4);
            color: var(--dark-blue);
            padding: 2rem;
            text-align: center;
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            margin: 0;
            font-weight: 500;
        }

        .login-body {
            padding: 2rem;
        }

        .form-control {
            background-color: #1d3b66;
            border: 1px solid #1d3b66;
            color: var(--light-slate);
            padding: 12px 16px;
            border-radius: 10px;
        }

        .form-control:focus {
            background-color: #1d3b66;
            border-color: var(--accent-cyan);
            color: var(--light-slate);
            box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.25);
        }

        .form-label {
            color: var(--light-slate);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--accent-cyan), #55e3c4);
            border: none;
            color: var(--dark-blue);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(100, 255, 218, 0.3);
        }

        .btn-back {
            background-color: transparent;
            border: 1px solid var(--slate);
            color: var(--slate);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: var(--slate);
            color: var(--dark-blue);
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 0.875rem;
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

        .particles-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="particles-bg" id="particles-container"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-container">
                    <div class="login-header">
                        <h1><i class="fas fa-shield-alt"></i> Admin Login</h1>
                        <p>Sistem AHP & SAW</p>
                        <span class="admin-badge">ADMIN ONLY</span>
                    </div>
                    
                    <div class="login-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="admin@example.com"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Masukkan password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="remember" 
                                       name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-login">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                                
                                <a href="{{ url('/') }}" class="btn btn-back">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Home
                                </a>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-key"></i> Kredensial Admin</h6>
                                <p class="mb-1"><strong>Email:</strong> admin@datakota.com</p>
                                <p class="mb-0"><strong>Password:</strong> admin123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tsParticles.load("particles-container", {
                fpsLimit: 60,
                particles: {
                    number: { value: 50, density: { enable: true, value_area: 800 }},
                    color: { value: "#64ffda" },
                    shape: { type: "circle" },
                    opacity: { value: 0.3, random: true },
                    size: { value: 2, random: true },
                    links: { enable: true, distance: 150, color: "#8892b0", opacity: 0.2, width: 1 },
                    move: { enable: true, speed: 0.5, direction: "none", random: false, straight: false, out_mode: "out", bounce: false }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: false }, resize: true },
                    modes: { repulse: { distance: 100, duration: 0.4 } }
                },
                detectRetina: true
            });
        });
    </script>
</body>
</html>
