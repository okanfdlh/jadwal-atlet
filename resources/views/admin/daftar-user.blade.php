@extends('layouts.app')

@section('title', 'Daftar Pengguna')
@section('header', 'Daftar Pengguna')
@section('subheader', 'Lihat seluruh pengguna')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.tambahUser') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Tambah Pengguna
    </a>
</div>

<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <form method="GET" action="{{ route('admin.daftarUser') }}" class="mb-4 flex flex-wrap gap-4 items-center">
    <input type="text" name="search" placeholder="Cari nama..." value="{{ request('search') }}"
           class="border border-gray-300 rounded px-3 py-2 w-64" />

    <select name="role" class="border border-gray-300 rounded px-3 py-2">
        <option value="">Semua Role</option>
        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="pengawas" {{ request('role') == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
        <option value="atlet" {{ request('role') == 'atlet' ? 'selected' : '' }}>Atlet</option>
    </select>

    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Filter
    </button>
</form>

    @if($users->isEmpty())
        <p class="text-gray-500">Belum ada pengguna.</p>
    @else
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Role</th>
                    <th class="border border-gray-300 px-4 py-2">Dibuat Pada</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $user->role }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.editUser', $user->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('admin.destroyUser', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
