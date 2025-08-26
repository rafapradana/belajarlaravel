<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyFlow - Content Management System</title>
    <meta name="description" content="Modern content management system untuk mengelola dan membaca konten dengan mudah.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <span class="text-xl font-semibold text-gray-900">StudyFlow</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/login') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-lg transition-colors duration-200">
                            Sign in
                        </a>
                        <a href="{{ url('/register') }}" class="btn-primary">
                            Get started
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-primary-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Jelajahi
                        <span class="text-primary-600">Konten Terbaru</span>
                    </h1>
                    <p class="max-w-2xl mx-auto text-xl text-gray-600 mb-8">
                        Temukan berbagai konten menarik dan informatif yang telah kami kurasi khusus untuk Anda.
                    </p>
                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span>{{ $konten->count() }} konten tersedia</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($konten as $data)
                <article class="card hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                    <!-- Content Header -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                Konten #{{ $data->id }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $data->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors duration-200">
                            <a href="{{ url('/detil/'. $data->id) }}" class="hover:underline">
                                {{ $data->judul }}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                            {{ \Illuminate\Support\Str::limit($data->isi, 120) }}
                        </p>
                    </div>

                    <!-- Content Footer -->
                    <div class="px-6 pb-6">
                        <a href="{{ url('/detil/'. $data->id) }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors duration-200">
                            Baca selengkapnya
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($konten->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada konten</h3>
                <p class="mt-2 text-gray-500">Konten akan muncul di sini setelah ditambahkan.</p>
            </div>
            @endif
        </main>

        <!-- CTA Section -->
        <section class="bg-white border-t border-gray-200">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 py-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Siap untuk bergabung?
                </h2>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    Daftar sekarang untuk mengakses fitur lengkap dan mengelola konten Anda sendiri.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ url('/register') }}" class="btn-primary px-8 py-3 text-lg">
                        Daftar Sekarang
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ url('/login') }}" class="btn-secondary px-8 py-3 text-lg">
                        Masuk
                    </a>
                </div>
            </div>
        </section>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>
