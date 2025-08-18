<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyFlow - Student Management System</title>
    <meta name="description" content="Simple and modern student management system for schools and educational institutions.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-white font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-semibold text-gray-900">StudyFlow</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-lg transition-colors duration-200">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-200">
                        Get started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main>
        <div class="bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Simple Student
                        <span class="text-primary-600">Management System</span>
                    </h1>
                    <p class="max-w-2xl mx-auto text-xl text-gray-600 mb-8">
                        Manage student information, track health metrics, and organize your educational data with our clean and intuitive platform.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 text-lg font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition-colors duration-200">
                            Get started
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            Sign in
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Preview -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
            <div class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                        <div class="ml-4 text-sm text-gray-500">StudyFlow Dashboard</div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-primary-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-primary-600">{{ $siswa->count() ?? '12' }}</div>
                            <div class="text-primary-600 text-sm">Total Students</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">165.2</div>
                            <div class="text-green-600 text-sm">Avg Height (cm)</div>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">58.5</div>
                            <div class="text-blue-600 text-sm">Avg Weight (kg)</div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-primary-600 font-medium text-sm">AD</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">Ahmad Dani</div>
                                <div class="text-sm text-gray-500">Height: 170cm • Weight: 65kg</div>
                            </div>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Normal</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-primary-600 font-medium text-sm">SR</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">Sari Rahayu</div>
                                <div class="text-sm text-gray-500">Height: 160cm • Weight: 55kg</div>
                            </div>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Normal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Key Features
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Everything you need to manage student information effectively
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Student Management</h3>
                    <p class="text-gray-600">
                        Add, edit, and manage student profiles with basic information and health metrics.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Health Tracking</h3>
                    <p class="text-gray-600">
                        Track student height, weight, and automatically calculate BMI with health categories.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Role-based Access</h3>
                    <p class="text-gray-600">
                        Secure access control with different permissions for administrators, teachers, and students.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Ready to get started?
            </h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Start managing your student data more efficiently with StudyFlow.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 text-lg font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition-colors duration-200">
                    Create Account
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Sign in
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-semibold">StudyFlow</span>
                    </div>
                    <p class="text-gray-400 max-w-md">
                        Simple and modern student management system for educational institutions.
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase mb-4">Product</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Support</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Privacy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    © 2024 StudyFlow. Built with Laravel & TailwindCSS.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
