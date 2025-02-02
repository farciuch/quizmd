<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="{{ route('register') }}" class="bg-white p-8 rounded shadow-lg w-full max-w-md">
        @csrf
        <h2 class="text-2xl font-bold text-center mb-6">Zarejestruj się</h2>
        <div class="mb-4">
            <label for="Nazwa" class="block text-gray-700">Nazwa</label>
            <input type="text" name="name" id="Nazwa" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="Email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="Email" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="Haslo" class="block text-gray-700">Hasło</label>
            <input type="password" name="password" id="Haslo" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Potwierdź Hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded hover:bg-blue-700">Zarejestruj się</button>
        <p class="text-center mt-4">Masz już konto? <a href="{{ route('login') }}" class="text-blue-600">Zaloguj się</a></p>
    </form>
</body>
</html>
