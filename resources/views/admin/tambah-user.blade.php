@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('header', 'Tambah Pengguna')
@section('subheader', '')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.daftarUser') }}" 
       class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
        &larr; Kembali
    </a>
</div>

<div class="bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('admin.storeUser') }}">
        @csrf
        <label class="block mb-2">Nama</label>
        <input type="text" name="name" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Role</label>
        <select name="role" class="w-full border p-2 rounded mb-3" required>
            <option value="">-- Pilih Role --</option>
            <option value="pengawas">Pengawas</option>
            <option value="atlet">Atlet</option>
            <option value="admin">Admin</option>
        </select>
        <label class="block mb-2">Jenis Kelamin</label>
        <select name="gender" class="w-full border p-2 rounded mb-3" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>


        <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Tambah User</button>
    </form>
</div>
@endsection
