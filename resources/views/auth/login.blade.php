<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-700 to-indigo-900 min-h-screen font-sans text-gray-800">

    <!-- Navbar minimal (optional) -->
    <header class="bg-gray-900 text-white p-4 shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-extrabold tracking-tight">Sichinpull</div>
            <a href="/" class="text-sm text-blue-400 hover:text-white transition">← Kembali ke Beranda</a>
        </div>
    </header>

    <!-- Login Box -->
    <main class="flex items-center justify-center pt-32 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 border border-blue-100">
            <h2 class="text-3xl font-extrabold text-center mb-6 text-indigo-700">Login Pengguna</h2>

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-yellow-400 to-yellow-300 text-gray-900 font-bold py-2 rounded-lg hover:brightness-105 transition shadow-md">
                    Login
                </button>
            </form>
        </div>
    </main>

    <!-- Optional Footer -->
    <footer class="text-center mt-16 text-gray-300 text-sm">
        &copy; 2025 Sichinpull. All rights reserved.
    </footer>

</body>
</html>
