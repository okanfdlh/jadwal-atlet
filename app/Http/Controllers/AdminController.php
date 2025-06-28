<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function daftarUser(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan nama
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('admin.daftar-user', compact('users'));
    }


    public function tambahUser()
    {
        return view('admin.tambah-user');
    }
    public function tambahPengawas()
    {
        // Ambil user dengan role pengawas
        $pengawas = User::where('role', 'pengawas')->get();

        return view('admin.tambah-pengawas', compact('pengawas'));
    }


    public function jadwalPengawas(Request $request)
    {
        $query = \App\Models\Schedule::where('type', 'pengawas');

        // Filter berdasarkan nama pengawas
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date')) {
            $query->whereDate('day', $request->date);
        }

        $jadwals = $query->orderBy('day', 'asc')
                        ->orderBy('time', 'asc')
                        ->paginate(10); // Menampilkan 10 data per halaman

        $jadwals->appends($request->all()); // Agar query string tetap saat pindah halaman

        $pengawas = \App\Models\User::where('role', 'pengawas')->get();

        return view('admin.jadwal-pengawas', compact('jadwals', 'pengawas'));
    }

    public function jadwalAtlet(Request $request)
        {
            $query = Schedule::where('type', 'atlet');

            // Filter berdasarkan nama
            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            // Filter berdasarkan tanggal
            if ($request->filled('date')) {
                $query->whereDate('day', $request->date);
            }

            $jadwals = $query->orderBy('day', 'asc')
                            ->orderBy('time', 'asc')
                            ->paginate(10);

            $jadwals->appends($request->all());

            return view('admin.jadwal-atlet', compact('jadwals'));
        }


    public function tambahAtlet()
    {
        $atlets = User::where('role', 'atlet')->get();
        return view('admin.tambah-atlet', compact('atlets'));
    }
    


    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,pengawas,atlet',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'gender' => $request->input('gender'),
        ]);


        return redirect()->route('admin.daftarUser')->with('success', 'User berhasil ditambahkan.');
    }
    // USER
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|in:admin,pengawas,atlet',
                'gender' => 'required|in:Laki-laki,Perempuan',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'gender' => $request->gender,
            ]);


            return redirect()->route('admin.daftarUser')->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.daftarUser')->with('error', 'Gagal memperbarui user.');
        }
    }

    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.daftarUser')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.daftarUser')->with('error', 'Gagal menghapus user.');
        }
    }



    // JADWAL
    public function editJadwal($id)
    {
        $jadwal = Schedule::findOrFail($id);
        return view('admin.edit-jadwal', compact('jadwal'));
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = Schedule::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'day' => 'required|date',
            'time' => 'required',
        ]);

        $jadwal->update([
            'name' => $request->name,
            'day' => $request->day,
            'time' => $request->time,
        ]);

        // Redirect sesuai tipe jadwal
        if ($jadwal->type === 'pengawas') {
            return redirect()->route('admin.jadwalPengawas')->with('success', 'Jadwal berhasil diperbarui.');
        } elseif ($jadwal->type === 'atlet') {
            return redirect()->route('admin.jadwalAtlet')->with('success', 'Jadwal berhasil diperbarui.');
        }

        // Default fallback redirect
        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroyJadwal($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $type = $jadwal->type;  // Simpan tipe dulu sebelum dihapus
        $jadwal->delete();

        if ($type === 'pengawas') {
            return redirect()->route('admin.jadwalPengawas')->with('success', 'Jadwal berhasil dihapus.');
        } elseif ($type === 'atlet') {
            return redirect()->route('admin.jadwalAtlet')->with('success', 'Jadwal berhasil dihapus.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil dihapus.');
    }


}
