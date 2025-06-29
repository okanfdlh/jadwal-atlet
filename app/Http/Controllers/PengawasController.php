<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Models\HasilLatihan; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Response;

class PengawasController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $totalAtlet = User::where('role', 'atlet')->count();
        $totalJadwal = Schedule::count();

        // Ambil 10 data hasil latihan terbaru untuk grafik
        // Pastikan ada data yang cukup untuk ditampilkan
        $dataHasilLatihan = HasilLatihan::orderBy('created_at', 'asc')->get(); // Ambil semua data atau sesuaikan batas jika perlu

        // Data untuk Grafik Monitoring Atlet
        $labelsMonitoring = $dataHasilLatihan->pluck('created_at')->map(fn($date) => $date->format('d M'))->toArray();
        $berat = $dataHasilLatihan->pluck('berat')->toArray();
        $repitisi = $dataHasilLatihan->pluck('repitisi')->toArray();
        $otot_kanan = $dataHasilLatihan->pluck('otot_kanan')->toArray();
        $otot_kiri = $dataHasilLatihan->pluck('otot_kiri')->toArray();

        // Data untuk Grafik Skor Latihan Atlet
        // Menggunakan label tanggal yang sama dengan monitoring agar mudah dibandingkan
        $labelsSkor = $labelsMonitoring; // Atau bisa gunakan $dataHasilLatihan->pluck('jenis_latihan')->toArray() jika ingin labelnya jenis latihan
        $skor = $dataHasilLatihan->map(function ($item) {
            return match ($item->skor) {
                'Sempurna' => 100,
                'Baik Sekali' => 80,
                'Baik' => 60,
                'Cukup' => 40,
                'Kurang' => 20,
                'Sangat Kurang' => 10,
                default => 0, // Nilai default jika skor tidak dikenali
            };
        })->toArray();
        $skor_kategori = $dataHasilLatihan->pluck('skor')->toArray(); // Digunakan untuk tooltip

        // Data monitoring tambahan (misal repitisi rata-rata per hari) - ini tidak dipakai di view dashboard saat ini
        $monitoringData = HasilLatihan::select(DB::raw('DATE(created_at) as date'), DB::raw('AVG(repitisi) as avg_repitisi'))
            ->groupBy('date')
            ->orderBy('date')
            ->take(10)
            ->get();

        return view('pengawas.dashboard', [ // Pastikan ini mengarah ke view yang benar, sebelumnya 'pengawas.dashboard'
            'totalAtlet' => $totalAtlet,
            'totalJadwal' => $totalJadwal,

            // Data untuk Grafik Monitoring
            'labelsMonitoring' => $labelsMonitoring,
            'berat' => $berat,
            'repitisi' => $repitisi,
            'otot_kanan' => $otot_kanan,
            'otot_kiri' => $otot_kiri,

            // Data untuk Grafik Skor
            'labelsSkor' => $labelsSkor,
            'skor' => $skor,
            'skor_kategori' => $skor_kategori,
            'jenis_latihan' => $dataHasilLatihan->pluck('jenis_latihan')->toArray(), // Mungkin tidak perlu di sini jika tidak digunakan di grafik

            // Data monitoring tambahan (jika diperlukan di masa mendatang)
            'monitoring_labels' => $monitoringData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'monitoring_avg_repitisi' => $monitoringData->pluck('avg_repitisi')->toArray(),
        ]);
    }
    public function showJenisLatihan()
    {
        return view('pengawas.jenis-latihan');
    }
    public function viewJadwal(Request $request)
    {
        $filter = $request->get('filter', 'hari'); // default: harian

        $query = Schedule::with('atlet')->orderBy('time', 'desc');

        if ($filter === 'hari') {
            $today = Carbon::now()->locale('id')->dayName; // contoh: Jumat
            $currentTime = Carbon::now()->format('H:i');

            $query->where('day', $today)
                ->where('time', '>=', $currentTime); // hanya yang belum lewat
        } elseif ($filter === 'minggu') {
            // Filter berdasarkan nama hari dalam seminggu
            $days = collect(range(0, 6))
                        ->map(fn($i) => Carbon::now()->startOfWeek()->addDays($i)->locale('id')->dayName)
                        ->all();

            $query->whereIn('day', $days);
        } elseif ($filter === 'bulan') {
            // Menampilkan semua jadwal karena kolom tanggal tidak tersedia
            // atau bisa buat logika custom jika tersedia kolom pendukung
        }

        $jadwals = $query->get();

        return view('pengawas.jadwal-index', compact('jadwals', 'filter'));
    }
    private function hitungSkor($jenisLatihan, $waktu, $repetisi)
    {
        $menit = max(1, round($waktu / 60)); // minimal 1 menit untuk pembagi
        $perMenit = $repetisi / $menit;

        if ($jenisLatihan === 'pullup') {
            if ($perMenit > 17) return 'Sempurna';
            if ($perMenit >= 13) return 'Baik Sekali';
            if ($perMenit >= 7) return 'Baik';
            if ($perMenit >= 4) return 'Cukup';
            if ($perMenit >= 1) return 'Kurang';
            return 'Sangat Kurang';
        }

        if ($jenisLatihan === 'chinning') {
            if ($perMenit > 72) return 'Sempurna';
            if ($perMenit >= 60) return 'Baik Sekali';
            if ($perMenit >= 50) return 'Baik';
            if ($perMenit >= 40) return 'Cukup';
            return 'Kurang';
        }

        return '-';
    }
    // Tampilkan form input parameter sesuai jenis latihan yg dipilih
   public function showInputParameter(Request $request)
    {
        $jenis = $request->query('jenis');

        if (!in_array($jenis, ['chinning', 'pullup'])) {
            return redirect()->route('pengawas.jenisLatihan')->withErrors('Jenis latihan tidak valid.');
        }

        $now = Carbon::now(); // tanggal & waktu sekarang
        $today = Carbon::now()->toDateString(); // "2025-06-29"
        $currentTime = $now->format('H:i:s');

        $todayDay = strtolower(Carbon::now()->locale('id')->dayName); // contoh: 'senin'

        $jadwal = Schedule::with(['atlet', 'pengawas'])
            ->where('type', $jenis)
            ->whereDate('day', $today)
            // ->whereTime('time', '>=', Carbon::now()->format('H:i:s'))
            ->orderBy('time')   
            ->get();

        return view('pengawas.input-parameter', compact('jenis', 'jadwal'));
    }
    public function analyze(Request $request)
    {
        $data = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'jenis_latihan' => 'required|in:pullup,chinning',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'otot_kanan' => 'required|numeric',
            'otot_kiri' => 'required|numeric',
            'repitisi' => 'required|numeric',
            'waktu_firebase' => 'required|numeric',
        ]);

        // Hitung skor berdasarkan jenis dan waktu
        $skor = $this->hitungSkor($data['jenis_latihan'], $data['waktu_firebase'], $data['repitisi']);



        // Simpan ke database (contoh ke tabel hasil_latihans)
        HasilLatihan::create([
            'schedule_id' => $data['schedule_id'],
            'jenis_latihan' => $data['jenis_latihan'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'berat' => $data['berat'],
            'tinggi' => $data['tinggi'],
            'otot_kanan' => $data['otot_kanan'],
            'otot_kiri' => $data['otot_kiri'],
            'repitisi' => $data['repitisi'],
            'waktu' => $data['waktu_firebase'], // waktu dalam detik
            'skor' => $skor,
        ]);

        return redirect()->route('chinup.dashboard')->with('success', 'Data berhasil disimpan!');
    }

   public function chinupDashboard()
    {
        // Ambil data terakhir yang disimpan ke database
        $lastResult = HasilLatihan::latest()->first();

        if (!$lastResult) {
            return view('pengawas.chinup-dashboard', [
                'otot_kanan' => 0,
                'otot_kiri' => 0,
                'repitisi' => 0,
                'score' => '-',
                'training_time' => 0,
                'waktu' => '-',
                'dominasi_otot' => '-'
            ]);
        }

        $score = $lastResult->skor;
        $repitisi = $lastResult->repitisi;
        $training_time = round($lastResult->waktu / 60, 2); // waktu dalam menit

        $dominasi_otot = ($lastResult->otot_kanan > $lastResult->otot_kiri) ? 'kanan' : 'kiri';

        return view('pengawas.chinup-dashboard', [
            'otot_kanan' => $lastResult->otot_kanan,
            'otot_kiri' => $lastResult->otot_kiri,
            'repitisi' => $repitisi,
            'score' => $score,
            'skor' => $score,
            'training_time' => $training_time,
            'waktu' => $lastResult->created_at->format('d M Y H:i'),
            'dominasi_otot' => $dominasi_otot,
        ]);
    }

    public function resetTimer(Request $request)
    {
        $this->firebase->getDatabase()
            ->getReference('Data/reset')
            ->set("true");

        return Response::json(['status' => 'reset']);
    }
    public function historyMonitoring(Request $request)
    {
        $query = HasilLatihan::with(['schedule.atlet']);

        // Filter berdasarkan tanggal jika tersedia
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Urutkan dari yang terbaru
        $query->orderByDesc('created_at');

        // Paginasi
        $histories = HasilLatihan::with('schedule.atlet')
        ->when($request->filled('tanggal'), fn($q) => $q->whereDate('created_at', $request->tanggal))
        ->orderByDesc('created_at')
        ->paginate(10);

        return view('pengawas.history-monitoring', compact('histories'));
    }
}   

