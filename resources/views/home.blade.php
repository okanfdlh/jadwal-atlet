<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AthleTrack Pro - Penjadwalan Latihan Kekuatan Atlet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
<script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800 pt-20">

    <header class="bg-gray-900 text-white p-4 shadow-lg fixed top-0 left-0 right-0 z-50">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="text-3xl font-extrabold tracking-tight">Sichinpul</div>
            <ul class="hidden md:flex space-x-6 text-lg">
                <li><a href="#home" class="hover:text-blue-400 transition duration-300">Home</a></li>
                <li><a href="#fitur" class="hover:text-blue-400 transition duration-300">Fitur</a></li>
                <li><a href="#cara-kerja" class="hover:text-blue-400 transition duration-300">Cara Kerja</a></li>
                <li><a href="{{ route('login') }}" class="bg-blue-600 px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300 transform hover:scale-105">Masuk</a></li>
            </ul>

            <div x-data="{ open: false }" class="md:hidden">
                <button @click="open = !open" class="text-white focus:outline-none focus:ring-2 focus:ring-blue-500 rounded p-2">
                    <svg x-show="!open" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="open" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div x-show="open" @click.outside="open = false" class="absolute top-16 left-0 w-full bg-gray-900 text-white p-4 shadow-lg z-50">
                    <ul class="flex flex-col space-y-4 text-center text-lg">
                        <li><a @click="open = false" href="#home" class="block py-2 hover:bg-gray-800 rounded">Home</a></li>
                        <li><a @click="open = false" href="#fitur" class="block py-2 hover:bg-gray-800 rounded">Fitur</a></li>
                        <li><a @click="open = false" href="#cara-kerja" class="block py-2 hover:bg-gray-800 rounded">Cara Kerja</a></li>
                        <li><a @click="open = false" href="{{ route('login') }}" class="block py-2 bg-blue-600 rounded hover:bg-blue-700">Masuk</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="home" class="bg-gradient-to-r from-blue-700 to-indigo-900 text-white py-24 text-center shadow-inner">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 animate-fade-in-down">
                Kuasai <span class="text-yellow-300">Chin-up</span> & <span class="text-yellow-300">Pull-up</span> Anda dengan AthleTrack Pro!
            </h1>
            <p class="text-xl md:text-2xl mb-10 opacity-90 animate-fade-in-up">
                Penjadwalan cerdas, pelacakan otomatis, dan data detak jantung real-time untuk performa puncak.
            </p>
            <a href="#daftar" class="inline-block bg-yellow-400 text-gray-900 px-10 py-5 rounded-full text-lg md:text-xl font-bold hover:bg-yellow-300 transition duration-300 transform hover:scale-105 shadow-lg animate-bounce-in">
                Mulai Sekarang
            </a>
        </div>
    </section>

    <section id="fitur" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-800">
                Fitur Utama Kami
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
    <!-- Penjadwalan -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-indigo-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 10h14M5 14h14M5 18h14" />
                </svg>
                <h3 class="text-2xl font-semibold mb-4 text-gray-900">Penjadwalan Latihan yang Disesuaikan</h3>
                <p class="text-gray-600">Buat jadwal latihan chin-up dan pull-up yang spesifik, dengan rekomendasi berdasarkan tingkat kebugaran Anda.</p>
            </div>

            <!-- Pelacakan IoT -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-indigo-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-2v13M9 19l12-2" />
                </svg>
                <h3 class="text-2xl font-semibold mb-4 text-gray-900">Pelacakan Otomatis (IoT)</h3>
                <p class="text-gray-600">Sensor canggih terintegrasi dengan alat latihan untuk menghitung skor repetisi chin-up (wanita) dan pull-up (pria) secara otomatis.</p>
            </div>

            <!-- Detak Jantung -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-red-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l2-2m0 0l4 4 4-4 4 4 4-4 2 2M3 13h18" />
                </svg>
                <h3 class="text-2xl font-semibold mb-4 text-gray-900">Pemantauan Detak Jantung Real-time</h3>
                <p class="text-gray-600">Lacak detak jantung Anda selama latihan untuk memantau intensitas dan pemulihan, membantu Anda berlatih lebih cerdas.</p>
            </div>

            <!-- Analisis Performa -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 12h2v6h-2zM15 10h2v8h-2zM7 14h2v4H7z" />
                </svg>
                <h3 class="text-2xl font-semibold mb-4 text-gray-900">Analisis Performa & Riwayat</h3>
                <p class="text-gray-600">Lihat grafik kemajuan, tren performa, dan riwayat latihan Anda dari waktu ke waktu untuk pemahaman yang lebih dalam.</p>
            </div>

            <!-- Target -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-yellow-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2m4-2a8 8 0 11-8-8" />
                </svg>
                <h3 class="text-2xl font-semibold mb-4 text-gray-900">Target & Pencapaian Pribadi</h3>
                <p class="text-gray-600">Tetapkan target pribadi yang menantang dan rayakan setiap pencapaian Anda dalam perjalanan kebugaran Anda.</p>
            </div>

            <!-- Aplikasi -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 flex flex-col items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-indigo-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <rect x="7" y="4" width="10" height="16" rx="2" ry="2" />
                    <path d="M11 5h2" />
                </svg>
                <h3 class="text-2xl font-semibold mb-4 text-gray-900">Aplikasi Intuitif</h3>
                <p class="text-gray-600">Antarmuka pengguna yang mudah digunakan di web dan perangkat seluler untuk pengalaman latihan yang mulus.</p>
            </div>
        </div>
        </div>
    </section>

    <section id="cara-kerja" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-800">
                Bagaimana Cara Kerjanya?
            </h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-10">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mr-6 shadow-md">1</div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2 text-gray-900">Masuk</h3>
                            <p class="text-gray-600 text-lg">Login terlebih dahulu.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mr-6 shadow-md">2</div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2 text-gray-900">Mulai Latihan Anda</h3>
                            <p class="text-gray-600 text-lg">Pilih sesi latihan yang sudah dijadwalkan dan mulai chin-up atau pull-up Anda. Sistem akan siap melacak.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mr-6 shadow-md">3</div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2 text-gray-900">Data Real-time & Akurat</h3>
                            <p class="text-gray-600 text-lg">Lihat hitungan repetisi otomatis dan detak jantung Anda secara langsung di aplikasi Anda saat Anda berlatih.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center text-xl font-bold mr-6 shadow-md">4</div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2 text-gray-900">Analisis Performa Komprehensif</h3>
                            <p class="text-gray-600 text-lg">Dapatkan laporan mendetail setelah latihan untuk melacak kemajuan, mengidentifikasi area perbaikan, dan membuat penyesuaian.</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="flex justify-center items-center mt-10 md:mt-0">
                    <img src="https://via.placeholder.com/550x400/9ca3af/ffffff?text=IoT+Integration+Mockup" alt="Alur Kerja AthleTrack Pro" class="rounded-xl shadow-2xl border-4 border-blue-600">
                </div> --}}
            </div>
        </div>
    </section>

    <section id="daftar" class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-24 text-center shadow-inner">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold mb-8">
                Siap Mengoptimalkan Latihan Anda?
            </h2>
            <p class="text-xl md:text-2xl mb-12 opacity-90">
                Bergabunglah dengan ribuan atlet yang sudah merasakan manfaat AthleTrack Pro dan raih potensi penuh Anda!
            </p>
            <a href="#" class="inline-block bg-yellow-400 text-gray-900 px-12 py-6 rounded-full text-xl md:text-2xl font-bold hover:bg-yellow-300 transition duration-300 transform hover:scale-105 shadow-xl animate-pulse-once">
                Mulai Latihan!
            </a>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto px-6 text-center text-sm">
            <p class="mb-4">&copy; 2025 Sichinpull. All rights reserved.</p>
        </div>
    </footer>

    <style>
        /* Custom Animations (bisa juga didefinisikan di tailwind.config.js) */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceIn {
            0%, 20%, 40%, 60%, 80%, 100% {
                transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
            }
            0% { opacity: 0; transform: scale3d(.3, .3, .3); }
            20% { transform: scale3d(1.1, 1.1, 1.1); }
            40% { transform: scale3d(.9, .9, .9); }
            60% { opacity: 1; transform: scale3d(1.03, 1.03, 1.03); }
            80% { transform: scale3d(.97, .97, .97); }
            100% { opacity: 1; transform: scale3d(1, 1, 1); }
        }
        @keyframes pulseOnce {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .animate-fade-in-down { animation: fadeInDown 1s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards; animation-delay: 0.3s; }
        .animate-bounce-in { animation: bounceIn 1s ease-out forwards; animation-delay: 0.6s; }
        .animate-pulse-once { animation: pulseOnce 1.5s ease-in-out; }

        /* Mengatur delay animasi untuk elemen yang berbeda */
        .hero-section .text-5xl { animation-delay: 0.2s; }
        .hero-section .text-xl { animation-delay: 0.5s; }
        .hero-section .inline-block { animation-delay: 0.8s; }
    </style>

</body>
</html>