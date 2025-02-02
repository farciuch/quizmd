<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Startowa</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center space-y-5">
        <h1 class="text-4xl font-bold text-blue-600">Witamy w Quizie!</h1>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Rejestracja</a>
            <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Logowanie</a>
        </div>
    </div>
</body>
</html>
