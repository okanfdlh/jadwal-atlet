<nav class="w-64 bg-white shadow-md flex flex-col p-5 sticky top-0 h-screen">
    <a href="{{ route('admin.dashboard') }}" class="mb-6 text-xl font-bold text-blue-600">Admin Panel</a>
    <ul class="space-y-3 flex flex-col">
        <li>
            <a href="{{ route('admin.dashboard') }}" 
               class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-200 font-semibold' : '' }}">
               Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.daftarUser') }}" 
               class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('admin.daftarUser') ? 'bg-blue-200 font-semibold' : '' }}">
               Daftar Pengguna
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('admin.tambahUser') }}" 
               class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('admin.tambahUser') ? 'bg-blue-200 font-semibold' : '' }}">
               Tambah Pengguna
            </a>
        </li> --}}
        <li>
            <a href="{{ route('admin.jadwalPengawas') }}" 
               class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('admin.jadwalPengawas') ? 'bg-blue-200 font-semibold' : '' }}">
               Jadwal Pengawas
            </a>
        </li>
        <li>
            <a href="{{ route('admin.jadwalAtlet') }}" 
               class="block px-4 py-2 rounded hover:bg-blue-100 {{ request()->routeIs('admin.jadwalAtlet') ? 'bg-blue-200 font-semibold' : '' }}">
               Jadwal Atlet
            </a>
        </li>
    </ul>
</nav>
