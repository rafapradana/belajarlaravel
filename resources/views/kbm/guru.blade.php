@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-chalkboard-teacher text-blue-600 mr-3"></i>
                        Jadwal KBM - {{ $guru->nama ?? 'Guru' }}
                    </h1>
                    <p class="text-lg text-gray-600">
                        <i class="fas fa-book text-green-600 mr-2"></i>
                        Mata Pelajaran: {{ $guru->mapel ?? 'N/A' }}
                    </p>
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
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                    Jadwal Mengajar
                </h2>
            </div>

            @if($jadwal->count() > 0)
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fas fa-hashtag mr-2"></i>
                                    No
                                </th>
                                <th>
                                    <i class="fas fa-user-tie mr-2"></i>
                                    Walas
                                </th>
                                <th>
                                    <i class="fas fa-door-open mr-2"></i>
                                    Kelas
                                </th>
                                <th>
                                    <i class="fas fa-layer-group mr-2"></i>
                                    Jenjang
                                </th>
                                <th>
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Tahun Ajaran
                                </th>
                                <th>
                                    <i class="fas fa-calendar-day mr-2"></i>
                                    Hari
                                </th>
                                <th>
                                    <i class="fas fa-clock mr-2"></i>
                                    Mulai
                                </th>
                                <th>
                                    <i class="fas fa-clock mr-2"></i>
                                    Selesai
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal as $index => $item)
                                <tr>
                                    <td class="font-medium">{{ $index + 1 }}</td>
                                    <td class="font-medium">{{ $item->walas->guru->nama ?? 'N/A' }}</td>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $item->walas->namakelas ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $item->walas->jenjang ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->walas->tahunajaran ?? 'N/A' }}</td>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $item->hari }}
                                        </span>
                                    </td>
                                    <td class="font-mono text-sm">{{ $item->mulai }}</td>
                                    <td class="font-mono text-sm">{{ $item->selesai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        <strong>Total Jadwal:</strong> {{ $jadwal->count() }} kelas
                    </div>
                </div>
            @else
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                        <i class="fas fa-calendar-times text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Jadwal</h3>
                    <p class="text-gray-500">Belum ada jadwal KBM untuk Anda.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection