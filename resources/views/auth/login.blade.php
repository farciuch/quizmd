<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="{{ route('login') }}" class="bg-white p-8 rounded shadow-lg w-full max-w-md">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Zaloguj się</h2>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Hasło</label>
            <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-green-500 text-white w-full py-2 rounded hover:bg-green-700">Zaloguj się</button>
        <p class="text-center mt-4">Nie masz konta? <a href="{{ route('register') }}" class="text-blue-600">Zarejestruj się</a></p>
    </form>
</body>
</html>
