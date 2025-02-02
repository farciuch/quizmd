<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizApp</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ikony Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .navbar {
            background-color: #4c6ef5; /* Niebieski kolor nawigacji */
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .nav-link:hover {
            color: #d9e2ff !important;
        }
        .btn-primary {
            background-color: #4c6ef5;
            border-color: #4c6ef5;
        }
        .btn-primary:hover {
            background-color: #3b5bdb;
        }
        footer {
            background-color: #343a40;
            color: #adb5bd;
            padding: 15px 0;
        }
        footer a {
            color: #f8f9fa;
            text-decoration: none;
        }
        footer a:hover {
            color: #adb5bd;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            @if (Auth::user()->isAdmin())
    
    <a class="navbar-brand text-white" href="{{ route('admin.dashboard') }}">QuizApp</a>
    @else
    <a class="navbar-brand text-white" href="{{ route('dashboard') }}">QuizApp</a>
        @endif
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <!-- Zawsze widoczna ikonka użytkownika -->
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i> <!-- Bootstrap ikona użytkownika -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Wyloguj się</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Główna zawartość strony -->
    <main class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Stopka -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} QuizApp. Wszystkie prawa zastrzeżone.</p>
            <p>
                <a href="#">Polityka prywatności</a> | 
                <a href="#">Warunki użytkowania</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
