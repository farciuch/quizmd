<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizApp</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ Vite::asset('resources/images/quizlogo.svg') }}">
<!-- Ikony Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<!-- Custom CSS -->
<style>
    body {
        background-color: #f8f9fa;
        color: #343a40;
    }
    .navbar {
        background-color: #4c6ef5;
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
    html, body {
        height: 100%; 
        margin: 0;   
        display: flex; 
        flex-direction: column; 
    }

    .min-h-screen { 
        flex: 1;     
    }

    main.container.py-5 { 
        flex: 1; 
        display: flex; 
        flex-direction: column; 
    }


    footer {
        background-color: #343a40;
        color: #adb5bd;
        padding: 15px 0;
        margin-top: auto; 
    }
    footer a {
        color: #f8f9fa;
        text-decoration: none;
    }
    footer a:hover {
        color: #adb5bd;
    }

    body.dark-mode {
        background-color: #3b3b3b;
        color: #ffffff;
    }
    
    .dark-mode .btn-secondary {
        background-color: #333;
        color: #fff;
        border-color: #555;
    }

    .dark-mode .btn-secondary:hover {
        background-color: #555;
        border-color: #777;
    }
    .dark-mode .navbar {
        background-color: #343a40; 
    }
    .dark-mode .footer {
        background-color: #343a40; 
    }
    .dark-mode .dropdown-menu {
        background-color: #303030; 
        border-color: #555; 
    }

    .dark-mode .dropdown-item {
        color: #e0e0e0; 
    }

    .dark-mode .dropdown-item:hover,
    .dark-mode .dropdown-item:focus {
        background-color: #424242; 
        color: #ffffff; 
    }
</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container d-flex justify-content-between align-items-center">  
            <div> 
                @if (Auth::user()->isAdmin())
                    <a class="navbar-brand text-white" href="{{ route('admin.dashboard') }}">QuizMD</a>
                @else
                    <a class="navbar-brand text-white" href="{{ route('dashboard') }}">QuizMD</a>
                    
                @endif
            </div>
    
            <div class="d-flex align-items-center"> 
                <div class="flex items-center me-2">  
                    <div class="inline-flex items-center space-x-2 cursor-pointer">
                       
                        <button type="button" id="lightModeIcon" class="btn btn-link nav-link text-white p-0">
                            <i class="bi bi-moon fs-5"></i>
                        </button>
                        
                        <button type="button" id="darkModeIcon" class="btn btn-link nav-link text-white p-0" style="display: none;">
                            <i class="bi bi-moon-fill fs-5"></i>
                        </button>
                    </div>
                </div>
    
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            
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
<footer class="footer text-center">
    <div class="container">
        <p>© {{ date('Y') }} QuizApp. Wszystkie prawa zastrzeżone.</p>
        <p>
            <a href="#">Polityka prywatności</a> | 
            <a href="#">Warunki użytkowania</a>
        </p>
    </div>
</footer>
<script>
    const body = document.body;
    const lightModeIcon = document.getElementById('lightModeIcon');
    const darkModeIcon = document.getElementById('darkModeIcon');

    // Funkcja do ustawiania trybu ciemnego
    function enableDarkMode() {
        console.log("enableDarkMode() została wywołana");
        body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled');
        lightModeIcon.style.display = 'inline-block';
        darkModeIcon.style.display = 'none';
        console.log("lightModeIcon display:", lightModeIcon.style.display); // DODANO
        console.log("darkModeIcon display:", darkModeIcon.style.display);   // DODANO
    }

    // Funkcja do wyłączania trybu ciemnego
    function disableDarkMode() {
        console.log("disableDarkMode() została wywołana");
        body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', null);
        lightModeIcon.style.display = 'none';
        darkModeIcon.style.display = 'inline-block';
        console.log("lightModeIcon display:", lightModeIcon.style.display); // DODANO
        console.log("darkModeIcon display:", darkModeIcon.style.display);   // DODANO
    }

    // Sprawdzenie preferencji z localStorage przy załadowaniu strony
    if (localStorage.getItem('darkMode') === 'enabled') {
        enableDarkMode();
    } else {
        disableDarkMode();
    }

    // Obsługa kliknięcia na ikonę trybu jasnego
    lightModeIcon.addEventListener('click', function() {
        console.log("Kliknięto ikonę trybu jasnego");
        disableDarkMode();
    });

    // Obsługa kliknięcia na ikonę trybu ciemnego
    darkModeIcon.addEventListener('click', function() {
        console.log("Kliknięto ikonę trybu ciemnego");
        enableDarkMode();
    });
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>