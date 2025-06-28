@extends('admin.layout')

@section('title', 'Input Parameter Atlet')

@section('content')
<div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-10 border border-gray-200 max-w-xl mx-auto">
    <h3 class="text-xl font-semibold text-blue-700 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m8-6a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Form Input Parameter Atlet
    </h3>

    <form method="POST" action="{{ route('pengawas.analyze') }}">
        @csrf
        <input type="hidden" name="jenis_latihan" id="jenis_latihan" value="{{ $jenis }}">

        <div class="space-y-6">
            <!-- Pilih Jadwal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">🧍 Pilih Jadwal Atlet</label>
                <select name="schedule_id" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('schedule_id') border-red-500 @enderror">
                    <option value="" disabled selected>-- Pilih Jadwal --</option>
                    @foreach($jadwal as $j)
                        <option 
                            value="{{ $j->id }}"
                            data-nama="{{ $j->atlet?->name }}"
                            data-lahir="{{ $j->atlet?->tanggal_lahir }}"
                            data-gender="{{ $j->atlet?->jenis_kelamin }}"
                        >
                            {{ $j->atlet?->name ?? 'Tanpa Nama' }} - {{ ucfirst($j->day) }}, {{ $j->time }}
                        </option>
                    @endforeach
                </select>
                @error('schedule_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror

                <div id="info-atlet" class="mt-4 hidden bg-gray-100 p-4 rounded-lg shadow-inner text-sm text-gray-800 space-y-1">
                    <p><strong>Nama Atlet:</strong> <span id="nama-atlet">-</span></p>
                    {{-- <p><strong>Tanggal Lahir:</strong> <span id="lahir-atlet">-</span></p>
                    <p><strong>Jenis Kelamin:</strong> <span id="gender-atlet">-</span></p> --}}
                    <p><strong>Jenis Latihan:</strong> <span id="jenis-latihan-text">-</span></p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📅 Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="input-tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('tanggal_lahir') border-red-500 @enderror">
                @error('tanggal_lahir')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">⚧ Jenis Kelamin</label>
            <input type="text" name="jenis_kelamin" id="input-jenis_kelamin" value="{{ old('jenis_kelamin') }}" readonly
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('jenis_kelamin') border-red-500 @enderror">
                @error('jenis_kelamin')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Berat Badan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">⚖️ Berat Badan (kg)</label>
                <input type="number" name="berat" step="0.1" value="{{ old('berat') }}" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('berat') border-red-500 @enderror">
                @error('berat')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tinggi Badan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">📏 Tinggi Badan (cm)</label>
                <input type="number" name="tinggi" value="{{ old('tinggi') }}" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('tinggi') border-red-500 @enderror">
                @error('tinggi')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex flex-col items-center space-y-4 mt-6">
                <div class="flex gap-4">
                    <button type="button" onclick="startTimer()"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
                        ⏱️ Mulai Timer
                    </button>
                    <button type="button" onclick="resetTimer()"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow">
                        🛑 Stop / Reset
                    </button>
                </div>

                <!-- UI Timer -->
                <div id="timer-display" class="text-2xl font-bold text-blue-700 hidden">
                    Waktu: <span id="timer">00:00</span>
                </div>
                <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-xl shadow">
                    <h4 class="text-blue-700 font-semibold mb-2">📊 Data Realtime dari Firebase</h4>
                    <p><strong>Otot Kanan:</strong> <span id="otot-kanan">-</span></p>
                    <p><strong>Otot Kiri:</strong> <span id="otot-kiri">-</span></p>
                    <p><strong>Repetisi:</strong> <span id="repitisi">-</span></p>
                    <p><strong>Waktu:</strong> <span id="waktu-firebase">-</span></p>
                </div>
            </div>

            <input type="hidden" name="otot_kanan" id="input-otot-kanan">
            <input type="hidden" name="otot_kiri" id="input-otot-kiri">
            <input type="hidden" name="repitisi" id="input-repitisi">
            <input type="hidden" name="waktu_firebase" id="input-waktu-firebase">

            <div class="text-center mt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow">
                    💾 Simpan Data
                </button>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('chinup.dashboard') }}"
                    class="inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    ⬅️ Input Hasil
                </a>
            </div>
        </div>
    </form>
</div>
<script>
    document.querySelector('select[name="schedule_id"]').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const nama = selected.dataset.nama || '-';
        const lahir = selected.dataset.lahir || '-';

        // Ambil jenis_latihan dari input hidden yang berasal dari parameter URL
        const jenisLatihanFromUrl = document.getElementById('jenis_latihan').value;

        // Tentukan jenis kelamin otomatis dari jenis_latihan
        let jenisKelamin = '-';
        if (jenisLatihanFromUrl === 'pullup') {
            jenisKelamin = 'L';
        } else if (jenisLatihanFromUrl === 'chinning') {
            jenisKelamin = 'P';
        }

        // Tampilkan di UI
        document.getElementById('nama-atlet').textContent = nama;
        document.getElementById('input-tanggal_lahir').value = lahir;
        document.getElementById('input-jenis_kelamin').value = jenisKelamin;
        document.getElementById('jenis-latihan-text').textContent = jenisLatihanFromUrl;

        document.getElementById('info-atlet').classList.remove('hidden');
    });
</script>
<script>
function startTimer() {
    fetch("{{ url('/firebase/start-timer') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ reset: false }) // Mulai timer
    });
}

function resetTimer() {
    fetch("{{ url('/firebase/reset') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ reset: true }) // Setel reset true
    });
}
</script>
<script>
    let timerInterval;
    function startTimer() {
        let seconds = 0;
        clearInterval(timerInterval);
        document.getElementById('timer-display').classList.remove('hidden');

        timerInterval = setInterval(() => {
            seconds++;
            const mins = String(Math.floor(seconds / 60)).padStart(2, '0');
            const secs = String(seconds % 60).padStart(2, '0');
            document.getElementById('timer').textContent = `${mins}:${secs}`;
        }, 1000);
    }

    function resetTimer() {
        fetch("{{ url('/firebase/reset') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ reset: true })
        });

        clearInterval(timerInterval);
        document.getElementById('timer').textContent = "00:00";
        document.getElementById('timer-display').classList.add('hidden');
    }
</script>
<!-- Firebase v8 (compatible with browser, no import/export error) -->
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
<script>
    // Inisialisasi Firebase
    var firebaseConfig = {
        apiKey: "AIzaSyCUy-nEx03DLO1_K5kteI-tEo3ZEteaXgY",
        authDomain: "sicimpul.firebaseapp.com",
        databaseURL: "https://sicimpul-default-rtdb.firebaseio.com",
        projectId: "sicimpul",
        storageBucket: "sicimpul.firebasestorage.app",
        messagingSenderId: "820319185653",
        appId: "1:820319185653:web:61aa18fbf8cfacb17773bc",
        measurementId: "G-V1CC2L66WR"
    };
    firebase.initializeApp(firebaseConfig);

    // Ambil data realtime dari root
    const db = firebase.database();
    const dataRef = db.ref('Data');

    dataRef.on('value', (snapshot) => {
        const data = snapshot.val();
        console.log("Data realtime:", data);

        document.getElementById('otot-kanan').textContent = data?.Otot_Kanan ?? '-';
        document.getElementById('otot-kiri').textContent = data?.Otot_Kiri ?? '-';
        document.getElementById('repitisi').textContent = data?.Repitisi ?? '-';
        document.getElementById('waktu-firebase').textContent = data?.Waktu ?? '-';

          // Set ke input hidden
        document.getElementById('input-otot-kanan').value = data?.Otot_Kanan ?? 0;
        document.getElementById('input-otot-kiri').value = data?.Otot_Kiri ?? 0;
        document.getElementById('input-repitisi').value = data?.Repitisi ?? 0;
        document.getElementById('input-waktu-firebase').value = data?.Waktu ?? 0;
    });
</script>
@endsection
