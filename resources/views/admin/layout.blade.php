<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard | IoT Fitness')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#9333ea',
                        bgLight: '#f3f4f6',
                        sidebar: '#4f46e5'
                    }
                }
            }
        }
    </script>

    <!-- Scrollbar Styling -->
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #e5e7eb;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #9333ea;
            border-radius: 5px;
        }
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="bg-bgLight min-h-screen text-gray-800 font-inter">

    <!-- Navbar -->
    <nav class="w-full bg-white shadow-md py-4 px-6 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <span class="text-2xl font-extrabold text-primary">IoT Fitness</span>
        </div>
        <div class="hidden md:flex space-x-6 font-medium text-gray-700">
            <a href="{{ route('pengawas.index') }}" class="hover:text-primary transition">Dashboard</a>
            <a href="{{ route('pengawas.inputParameter', ['jenis' => 'chinning']) }}" class="hover:text-primary transition">Input Chinning</a>
            <a href="{{ route('pengawas.inputParameter', ['jenis' => 'pullup']) }}" class="hover:text-primary transition">Input Pull-up</a>
            <a href="{{ route('jadwal.index') }}" class="hover:text-primary transition">Jadwal Latihan</a>
            <a href="{{ route('pengawas.historyMonitoring') }}" class="hover:text-primary transition">Riwayat</a>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="ml-4">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow transition text-sm">
                Logout
            </button>
        </form>
    </nav>

    <!-- Main Content -->
    <main class="p-6 max-w-7xl mx-auto mt-8">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-blue-800 drop-shadow">👨‍🏫 Dashboard Pengawas</h2>
            <p class="text-gray-600 mt-1 text-lg">Formulir Input & Analisis Data Atlet</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            @yield('content')
        </div>
    </main>
@yield('scripts')
</body>
</html>
