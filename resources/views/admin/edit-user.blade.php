@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('header', 'Edit Pengguna')
@section('subheader', '')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.daftarUser') }}" 
       class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
        &larr; Kembali
    </a>
</div>
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('admin.updateUser', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Role</label>
            <select name="role" class="w-full border border-gray-300 p-2 rounded">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pengawas" {{ $user->role === 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                <option value="atlet" {{ $user->role === 'atlet' ? 'selected' : '' }}>Atlet</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
