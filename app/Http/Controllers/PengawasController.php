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

        $data = HasilLatihan::orderBy('created_at')->take(10)->get();

        return view('pengawas.dashboard', [
            'totalAtlet' => $totalAtlet,
            'totalJadwal' => $totalJadwal,
            'labels' => $data->pluck('created_at')->map(fn($date) => $date->format('d M'))->toArray(),
            'berat' => $data->pluck('berat')->toArray(),
            'repitisi' => $data->pluck('repitisi')->toArray(),
            'otot_kanan' => $data->pluck('otot_kanan')->toArray(),
            'otot_kiri' => $data->pluck('otot_kiri')->toArray(),
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
    // Tampilkan form input parameter sesuai jenis latihan yg dipilih
   public function showInputParameter(Request $request)
    {
        $jenis = $request->query('jenis');

        if (!in_array($jenis, ['chinning', 'pullup'])) {
            return redirect()->route('pengawas.jenisLatihan')->withErrors('Jenis latihan tidak valid.');
        }

        $now = Carbon::now(); // tanggal & waktu sekarang
        $today = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');

        $todayDay = strtolower(Carbon::now()->locale('id')->dayName); // contoh: 'senin'

        $jadwal = Schedule::with(['atlet', 'pengawas'])
            ->where('type', $jenis)
            ->where('day', $todayDay)
            ->whereTime('time', '>=', Carbon::now()->format('H:i:s'))
            ->orderBy('time')
            ->get();

        return view('pengawas.input-parameter', compact('jenis', 'jadwal'));
    }
    public function analyze(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'otot_kanan' => 'required|numeric',
            'otot_kiri' => 'required|numeric',
            'repitisi' => 'required|numeric',
            'waktu_firebase' => 'required|string',
        ]);

        HasilLatihan::create([
            'schedule_id' => $validated['schedule_id'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'berat' => $validated['berat'],
            'tinggi' => $validated['tinggi'],
            'otot_kanan' => $validated['otot_kanan'],
            'otot_kiri' => $validated['otot_kiri'],
            'repitisi' => $validated['repitisi'],
            'waktu_firebase' => $validated['waktu_firebase'],
        ]);

        return redirect()->route('chinup.dashboard')->with('success', 'Hasil latihan berhasil disimpan.');
    }

   public function chinupDashboard()
    {
        try {
            $db = $this->firebase->getDatabase();

            // Ambil semua history
            $history = $db->getReference('History')->getValue();

            if (!$history || !is_array($history)) {
                return view('pengawas.chinup-dashboard', [
                    'otot_kanan' => 0,
                    'otot_kiri' => 0,
                    'repitisi' => 0,
                    'score' => 0,
                    'training_time' => 0,
                    'waktu' => '-',
                    'dominasi_otot' => 'kanan'
                ]);
            }

            // Urutkan berdasarkan field 'Waktu' DESC
            $lastData = collect($history)
                ->filter(fn($item) => isset($item['Waktu']))
                ->sortByDesc(fn($item) => strtotime($item['Waktu']))
                ->first();

            $ototKanan = (int)($lastData['Otot_Kanan'] ?? 0);
            $ototKiri  = (int)($lastData['Otot_Kiri'] ?? 0);
            $repitisi  = (int)($lastData['Repitisi'] ?? 0);
            $waktu     = $lastData['Waktu'] ?? now()->toDateTimeString();

            $score = $repitisi * 10;
            $training_time = $repitisi * 0.5;

            $dominasi_otot = ($ototKanan > $ototKiri) ? 'kanan' : 'kiri';

            return view('pengawas.chinup-dashboard', [
                'otot_kanan' => $ototKanan,
                'otot_kiri' => $ototKiri,
                'repitisi' => $repitisi,
                'score' => $score,
                'training_time' => $training_time,
                'waktu' => $waktu,
                'dominasi_otot' => $dominasi_otot,
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal ambil data Firebase: ' . $e->getMessage());
            return view('pengawas.chinup-dashboard')->withErrors(['firebase' => 'Gagal mengambil data.']);
        }
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

