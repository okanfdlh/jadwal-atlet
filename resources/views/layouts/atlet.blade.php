<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-100 text-gray-800 flex min-h-screen">
{{-- 
    @include('admin.components.sidebar') --}}

    <div class="flex-1 flex flex-col min-h-screen">
        <header class="bg-blue-600 text-white p-5 shadow-md flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">@yield('header', 'Dashboard')</h1>
                <p class="text-sm">@yield('subheader', '')</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-white text-blue-600 font-semibold py-1 px-3 rounded hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </header>


        <main class="p-5 max-w-4xl mx-auto flex-1">
            @yield('content')
        </main>

        <footer class="bg-gray-200 text-center py-3 mt-10">
            &copy; {{ date('Y') }} Sistem Latihan Pull-Up & Chin-Up
        </footer>
    </div>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

</body>
</html>
