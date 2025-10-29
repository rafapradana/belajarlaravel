@extends('layouts.app')

@section('title', 'Jadwal KBM - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Jadwal KBM</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola jadwal kegiatan belajar mengajar</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('kbm.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Jadwal
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
            <div class="flex">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
            <div class="flex">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Search Section -->
    <div class="mb-6">
        <div class="max-w-md">
            <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">Cari Jadwal KBM</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="searchInput" name="search" placeholder="Cari berdasarkan nama guru, mata pelajaran, atau kelas..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Daftar Jadwal KBM</h3>
            <p class="mt-1 text-sm text-gray-600">Semua jadwal kegiatan belajar mengajar yang telah dibuat</p>
        </div>

        <div id="kbmTableContainer">
            @include('kbm.table', ['jadwal' => $jadwal])
        </div>
    </div>
</div>

<script>
    // CSRF Token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Load KBM data
    function loadKbm() {
        $.ajax({
            url: '/kbm/data',
            type: 'GET',
            success: function(response) {
                $('#kbmTableContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error loading KBM data:', error);
            }
        });
    }

    // Search KBM
    function searchKbm(query) {
        $.ajax({
            url: '/kbm/search',
            type: 'GET',
            data: { search: query },
            success: function(response) {
                $('#kbmTableContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error searching KBM:', error);
            }
        });
    }

    // Search input event listener
    $('#searchInput').on('input', function() {
        const query = $(this).val();
        if (query.length > 0) {
            searchKbm(query);
        } else {
            loadKbm();
        }
    });

    // Delete confirmation modal
    $(document).on('click', 'button[type="submit"]', function(e) {
        const form = $(this).closest('form');
        if (form.find('input[name="_method"][value="DELETE"]').length > 0) {
            e.preventDefault();
            if (confirm('Yakin ingin menghapus jadwal ini?')) {
                form.submit();
            }
        }
    });
</script>
@endsection