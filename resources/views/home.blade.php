<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - StudyFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="h-full font-sans antialiased">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-xl font-semibold text-gray-900">StudyFlow</h1>
                        </div>
                        <div class="hidden md:block ml-10">
                            <div class="flex items-baseline space-x-4">
                                <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst(session('admin_role', 'user')) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium">{{ session('admin_username') }}</span>
                        </div>
                        <a href="{{ route('logout') }}" class="btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sign out
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- User Greeting and Info Section -->
            <div class="px-4 py-6 sm:px-0 mb-8">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <!-- Greeting -->
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                Hello, {{ $adminUsername }}! 👋
                            </h2>
                            <div class="mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                                    {{ ucfirst($adminRole) }}
                                </span>
                            </div>
                            
                            <!-- Role-specific Information -->
                            @if($adminRole === 'siswa' && $userInfo)
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-sm font-medium text-gray-600">Full Name</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $userInfo->nama }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-sm font-medium text-gray-600">Height</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $userInfo->tb }} cm</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-sm font-medium text-gray-600">Weight</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $userInfo->bb }} kg</p>
                                    </div>
                                </div>

                                @if($kelasInfo && $kelasInfo->walas && $kelasInfo->walas->guru)
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Informasi Kelas</h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <p class="text-sm font-medium text-blue-600">Wali Kelas</p>
                                                <p class="text-lg font-semibold text-blue-900">{{ $kelasInfo->walas->guru->nama }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-blue-600">Kelas</p>
                                                <p class="text-lg font-semibold text-blue-900">{{ $kelasInfo->walas->jenjang }} {{ $kelasInfo->walas->namakelas }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @elseif($adminRole === 'guru' && $userInfo)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-sm font-medium text-gray-600">Teacher Name</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $userInfo->nama }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-sm font-medium text-gray-600">Subject</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $userInfo->mapel }}</p>
                                    </div>
                                </div>

                                @if($walasInfo)
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <h3 class="text-lg font-semibold text-green-900 mb-2">Wali Kelas</h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <div>
                                                <p class="text-sm font-medium text-green-600">Kelas</p>
                                                <p class="text-lg font-semibold text-green-900">{{ $walasInfo->jenjang }} {{ $walasInfo->namakelas }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-green-600">Tahun Ajaran</p>
                                                <p class="text-lg font-semibold text-green-900">{{ $walasInfo->tahunajaran }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-green-600">Jumlah Siswa</p>
                                                <p class="text-lg font-semibold text-green-900">{{ $siswaWalas->count() }} siswa</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                        <p class="text-sm font-medium text-yellow-600">Status</p>
                                        <p class="text-lg font-semibold text-yellow-900">Guru Mata Pelajaran</p>
                                        <p class="text-sm text-yellow-700 mt-1">Anda tidak ditugaskan sebagai wali kelas.</p>
                                    </div>
                                @endif

                            @elseif($adminRole === 'admin')
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm font-medium text-gray-600">Access Level</p>
                                    <p class="text-lg font-semibold text-gray-900">Full System Administrator</p>
                                    <p class="text-sm text-gray-600 mt-1">You have complete access to manage all students and system features.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header -->
            <div class="px-4 py-6 sm:px-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        @if($adminRole === 'admin')
                            <h1 class="text-2xl font-bold text-gray-900">Student Management</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Manage and view student information
                            </p>
                        @elseif($adminRole === 'guru')
                            <h1 class="text-2xl font-bold text-gray-900">Student Overview</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                View student information and data
                            </p>
                        @elseif($adminRole === 'siswa')
                            <h1 class="text-2xl font-bold text-gray-900">Student Information</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                View your personal information and class data
                            </p>
                        @endif
                    </div>
                    @if (session('admin_role') === 'admin')
                    <div class="mt-4 sm:mt-0 flex space-x-3">
                        <a href="{{ route('kbm.index') }}" class="btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jadwal KBM
                        </a>
                        <a href="{{ route('siswa.create') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Student
                        </a>
                    </div>
                    @elseif (session('admin_role') === 'guru')
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('kbm.index') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Lihat Jadwal KBM
                        </a>
                    </div>
                    @elseif (session('admin_role') === 'siswa')
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('kbm.index') }}" class="btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jadwal Kelas Saya
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Stats Cards -->
            @if($adminRole === 'admin' || ($adminRole === 'guru' && $walasInfo))
            <div class="px-4 sm:px-0 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">
                                        @if($adminRole === 'admin')
                                            Total Students
                                        @else
                                            Students in Class
                                        @endif
                                    </p>
                                    <p class="text-2xl font-semibold text-gray-900">
                                        @if($adminRole === 'admin')
                                            {{ $siswa->count() }}
                                        @else
                                            {{ $siswaWalas->count() }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Avg Height</p>
                                    <p class="text-2xl font-semibold text-gray-900">
                                        @if($adminRole === 'admin')
                                            {{ $siswa->count() > 0 ? number_format($siswa->avg('tb'), 1) : '0' }} cm
                                        @else
                                            {{ $siswaWalas->count() > 0 ? number_format($siswaWalas->avg('tb'), 1) : '0' }} cm
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-1m-3 1l-3-1"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Avg Weight</p>
                                    <p class="text-2xl font-semibold text-gray-900">
                                        @if($adminRole === 'admin')
                                            {{ $siswa->count() > 0 ? number_format($siswa->avg('bb'), 1) : '0' }} kg
                                        @else
                                            {{ $siswaWalas->count() > 0 ? number_format($siswaWalas->avg('bb'), 1) : '0' }} kg
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Students Table -->
            @if($adminRole === 'admin' || ($adminRole === 'guru' && $walasInfo))
            <div class="px-4 sm:px-0">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    @if($adminRole === 'admin')
                                        Students List
                                    @else
                                        My Class Students
                                    @endif
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    @if($adminRole === 'admin')
                                        A list of all students with their information
                                    @else
                                        Students in {{ $walasInfo->jenjang }} {{ $walasInfo->namakelas }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <input type="text" id="searchInput" placeholder="Search students..." 
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="studentsTableContainer">
                        <!-- Table akan dimuat via Ajax -->
                    </div>
                </div>
            </div>
            @elseif($adminRole === 'guru' && !$walasInfo)
            <!-- Guru yang bukan walas -->
            <div class="px-4 sm:px-0">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Guru Mata Pelajaran</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            @if($userInfo && $userInfo->mapel)
                                Anda adalah guru mata pelajaran <strong>{{ $userInfo->mapel }}</strong>.<br>
                            @endif
                            Anda tidak memiliki akses untuk melihat data siswa karena tidak ditugaskan sebagai wali kelas.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('kbm.index') }}" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Lihat Jadwal KBM Saya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($adminRole === 'siswa')
            <!-- Siswa -->
            <div class="px-4 sm:px-0">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Selamat Datang, {{ $userInfo->nama }}!</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Informasi lengkap Anda telah ditampilkan di atas.<br>
                            Untuk informasi lebih lanjut, silakan hubungi wali kelas atau administrator.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('kbm.index') }}" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Lihat Jadwal Kelas Saya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-2">Delete Student</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete <span id="studentName" class="font-medium"></span>? This action cannot be undone.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <div class="flex space-x-3">
                        <button id="cancelDelete" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                        <form id="deleteForm" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Setup CSRF token for Ajax requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Load students data on page load
        $(document).ready(function() {
            loadStudents();
        });

        // Search functionality
        $('#searchInput').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 0) {
                searchStudents(query);
            } else {
                loadStudents();
            }
        });

        // Function to load all students
        function loadStudents() {
            $.ajax({
                url: '{{ route("siswa.data") }}',
                type: 'GET',
                success: function(response) {
                    $('#studentsTableContainer').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading students:', error);
                    $('#studentsTableContainer').html('<div class="text-center py-12"><p class="text-red-500">Error loading students data</p></div>');
                }
            });
        }

        // Function to search students
        function searchStudents(query) {
            $.ajax({
                url: '{{ route("siswa.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(response) {
                    $('#studentsTableContainer').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error searching students:', error);
                    $('#studentsTableContainer').html('<div class="text-center py-12"><p class="text-red-500">Error searching students</p></div>');
                }
            });
        }

        function confirmDelete(id, name) {
            document.getElementById('studentName').textContent = name;
            document.getElementById('deleteForm').action = '{{ url("/siswa") }}/' + id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        document.getElementById('cancelDelete').addEventListener('click', function() {
            document.getElementById('deleteModal').classList.add('hidden');
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
