<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - StudyFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo/Brand -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">StudyFlow</h1>
                <h2 class="text-2xl font-semibold text-gray-900">Create your account</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500 transition-colors duration-200">
                        Sign in
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-sm sm:rounded-xl sm:px-10 border border-gray-200">
                <!-- Success Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            required
                            class="input-field"
                            placeholder="Choose a username"
                            value="{{ old('username') }}"
                        >
                        <p class="mt-1 text-xs text-gray-500">Must be unique and at least 3 characters long</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="input-field"
                            placeholder="Create a strong password"
                        >
                        <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters long</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Account Type
                        </label>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input
                                    id="role-admin"
                                    name="role"
                                    type="radio"
                                    value="admin"
                                    required
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300"
                                    {{ old('role') == 'admin' ? 'checked' : '' }}
                                >
                                <label for="role-admin" class="ml-3 block text-sm">
                                    <span class="font-medium text-gray-900">Administrator</span>
                                    <span class="block text-xs text-gray-500">Full access to manage students and system</span>
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    id="role-guru"
                                    name="role"
                                    type="radio"
                                    value="guru"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300"
                                    {{ old('role') == 'guru' ? 'checked' : '' }}
                                >
                                <label for="role-guru" class="ml-3 block text-sm">
                                    <span class="font-medium text-gray-900">Teacher</span>
                                    <span class="block text-xs text-gray-500">View student information and data</span>
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    id="role-siswa"
                                    name="role"
                                    type="radio"
                                    value="siswa"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300"
                                    {{ old('role') == 'siswa' ? 'checked' : '' }}
                                >
                                <label for="role-siswa" class="ml-3 block text-sm">
                                    <span class="font-medium text-gray-900">Student</span>
                                    <span class="block text-xs text-gray-500">Limited access to view information</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 ease-in-out"
                        >
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Create account
                            </span>
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Already have an account?</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a
                            href="{{ route('login') }}"
                            class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 ease-in-out"
                        >
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                                </svg>
                                Sign in instead
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Back to home -->
            <div class="mt-6 text-center">
                <a href="{{ route('landing') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    ← Back to home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
