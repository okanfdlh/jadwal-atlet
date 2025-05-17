@extends('admin.layout')

@section('title', 'Halaman Pengawas - Input & Analisis Atlet')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-100 via-blue-100 to-teal-50 py-12 px-4 flex items-center justify-center">
    <div class="max-w-3xl mx-auto w-full">
        <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit">Logout</button></form>
        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-blue-800 drop-shadow">👨‍🏫 Dashboard Pengawas</h2>
            <p class="text-gray-600 mt-2 text-lg">Formulir Input & Analisis Data Atlet</p>
        </div>

        <!-- Form Input Parameter Atlet -->
        <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-10 border border-gray-200">
            <h3 class="text-xl font-semibold text-blue-700 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m8-6a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Form Input Parameter Atlet
            </h3>
            <form method="POST" action="{{ route('pengawas.analyze') }}">
                @csrf
                <div class="space-y-6">
                    <!-- Nama Atlet -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">🧍 Nama Atlet</label>
                        <input type="text" name="nama" required placeholder="Contoh: Andi Saputra"
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <svg class="inline w-5 h-5 mr-1 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3M3 11h18M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                            </svg>
                            Tanggal Lahir
                        </label>
                        <input type="date" name="tanggal_lahir" required
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">🚻 Jenis Kelamin</label>
                        <select name="jenis_kelamin" required
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">⚖️ Berat Badan (kg)</label>
                        <input type="number" name="berat" step="0.1" required
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Tinggi Badan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">📏 Tinggi Badan (cm)</label>
                        <input type="number" name="tinggi" required
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Tombol -->
                    <div class="text-center mt-8">
                        <button type="submit"
                            class="inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            📊 Analisa Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Hasil Analisa -->
        @if(session('hasil'))
        <div class="grid md:grid-cols-2 gap-6 mt-10">
            <!-- Nutrisi -->
            <div class="bg-yellow-100/90 border-l-4 border-yellow-500 rounded-xl shadow p-6">
                <h4 class="text-lg font-semibold text-yellow-800 mb-4">🍽️ Informasi Kebutuhan Nutrisi</h4>
                <ul class="text-gray-700 space-y-2">
                    <li><strong>Kalori Harian:</strong> {{ session('hasil')['kalori'] }} kkal</li>
                    <li><strong>Karbohidrat:</strong> {{ session('hasil')['karbo'] }} gram</li>
                    <li><strong>Protein:</strong> {{ session('hasil')['protein'] }} gram</li>
                    <li><strong>Lemak:</strong> {{ session('hasil')['lemak'] }} gram</li>
                </ul>
            </div>

            <!-- Kekuatan Otot -->
            <div class="bg-green-100/90 border-l-4 border-green-500 rounded-xl shadow p-6">
                <h4 class="text-lg font-semibold text-green-800 mb-4">💪 Kategori Kekuatan Otot</h4>
                <p class="text-gray-700 mb-2"><strong>Kategori:</strong> {{ session('hasil')['kategori_otot'] }}</p>
                <p class="text-gray-700"><strong>Saran:</strong> {{ session('hasil')['saran'] }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
