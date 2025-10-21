@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-users-cog text-blue-600 mr-3"></i>
                        Jadwal KBM - Wali Kelas {{ $walas->namakelas ?? 'N/A' }}
                    </h1>
                    <div class="space-y-1">
                        <p class="text-lg text-gray-600">
                            <i class="fas fa-user text-green-600 mr-2"></i>
                            Wali Kelas: {{ $guru->nama ?? 'N/A' }}
                        </p>
                        <p class="text-lg text-gray-600">
                            <i class="fas fa-graduation-cap text-purple-600 mr-2"></i>
                            Jenjang: {{ $walas->jenjang ?? 'N/A' }} - Kelas: {{ $walas->namakelas ?? 'N/A' }}
                        </p>
                        <p class="text-lg text-gray-600">
                            <i class="fas fa-calendar-alt text-orange-600 mr-2"></i>
                            Tahun Ajaran: {{ $walas->tahunajaran ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Jadwal Guru yang Mengajar di Kelas {{ $walas->namakelas ?? 'N/A' }}</h3>
                <p class="mt-1 text-sm text-gray-600">Semua jadwal guru yang mengajar di kelas yang Anda walikan</p>
            </div>

            @if($jadwal->count() > 0)
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-hashtag mr-2"></i>No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>Guru
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-book mr-2"></i>Mata Pelajaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-calendar-day mr-2"></i>Hari
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-clock mr-2"></i>Waktu Mulai
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-clock mr-2"></i>Waktu Selesai
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-hourglass-half mr-2"></i>Durasi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwal as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->guru->nama ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-book mr-1"></i>
                                    {{ $item->guru->mapel ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-calendar-day mr-1"></i>
                                    {{ $item->hari }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <i class="fas fa-play text-green-600 mr-2"></i>
                                {{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <i class="fas fa-stop text-red-600 mr-2"></i>
                                {{ \Carbon\Carbon::parse($item->selesai)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @php
                                    $mulai = \Carbon\Carbon::parse($item->mulai);
                                    $selesai = \Carbon\Carbon::parse($item->selesai);
                                    $durasi = $mulai->diff($selesai);
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <i class="fas fa-hourglass-half mr-1"></i>
                                    {{ $durasi->format('%h jam %i menit') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Summary Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    <strong>Total Jadwal:</strong> {{ $jadwal->count() }} mata pelajaran di kelas {{ $walas->namakelas ?? 'N/A' }}
                </div>
            </div>
        @else
            <div class="p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i class="fas fa-calendar-times text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Jadwal</h3>
                <p class="text-gray-500">Belum ada jadwal KBM untuk kelas {{ $walas->namakelas ?? 'N/A' }}.</p>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection