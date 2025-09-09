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
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
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
                                    onchange="showRoleFields(this.value)"
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
                                    onchange="showRoleFields(this.value)"
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
                                    onchange="showRoleFields(this.value)"
                                    {{ old('role') == 'siswa' ? 'checked' : '' }}
                                >
                                <label for="role-siswa" class="ml-3 block text-sm">
                                    <span class="font-medium text-gray-900">Student</span>
                                    <span class="block text-xs text-gray-500">Limited access to view information</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Fields for Siswa -->
                    <div id="siswa-fields" class="space-y-4" style="display: none;">
                        <h4 class="text-sm font-medium text-gray-700">Student Information</h4>
                        
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <input
                                id="nama"
                                name="nama"
                                type="text"
                                class="input-field"
                                placeholder="Enter your full name"
                                value="{{ old('nama') }}"
                            >
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="tb" class="block text-sm font-medium text-gray-700 mb-2">
                                    Height (cm)
                                </label>
                                <input
                                    id="tb"
                                    name="tb"
                                    type="number"
                                    min="50"
                                    max="250"
                                    class="input-field"
                                    placeholder="Height"
                                    value="{{ old('tb') }}"
                                >
                            </div>

                            <div>
                                <label for="bb" class="block text-sm font-medium text-gray-700 mb-2">
                                    Weight (kg)
                                </label>
                                <input
                                    id="bb"
                                    name="bb"
                                    type="number"
                                    step="0.1"
                                    min="10"
                                    max="200"
                                    class="input-field"
                                    placeholder="Weight"
                                    value="{{ old('bb') }}"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Additional Fields for Guru -->
                    <div id="guru-fields" class="space-y-4" style="display: none;">
                        <h4 class="text-sm font-medium text-gray-700">Teacher Information</h4>
                        
                        <div>
                            <label for="nama-guru" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <input
                                id="nama-guru"
                                name="nama_guru"
                                type="text"
                                class="input-field"
                                placeholder="Enter your full name"
                                value="{{ old('nama_guru') }}"
                            >
                        </div>

                        <div>
                            <label for="mapel" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject
                            </label>
                            <select
                                id="mapel"
                                name="mapel"
                                class="input-field"
                            >
                                <option value="">Select your subject</option>
                                <option value="Matematika" {{ old('mapel') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                                <option value="IPAS" {{ old('mapel') == 'IPAS' ? 'selected' : '' }}>IPAS</option>
                                <option value="Bahasa Indonesia" {{ old('mapel') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="Informatika" {{ old('mapel') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                            </select>
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
<script>
function showRoleFields(role) {
    // Hide all additional fields first
    document.getElementById('siswa-fields').style.display = 'none';
    document.getElementById('guru-fields').style.display = 'none';
    
    // Get all fields
    const siswaFields = document.querySelectorAll('#siswa-fields input, #siswa-fields select');
    const guruFields = document.querySelectorAll('#guru-fields input, #guru-fields select');
    
    // Disable and clear all fields first
    siswaFields.forEach(field => {
        field.removeAttribute('required');
        field.disabled = true;
        field.value = '';
    });
    guruFields.forEach(field => {
        field.removeAttribute('required');
        field.disabled = true;
        field.value = '';
    });
    
    // Show and enable relevant fields
    if (role === 'siswa') {
        document.getElementById('siswa-fields').style.display = 'block';
        siswaFields.forEach(field => {
            field.disabled = false;
            field.setAttribute('required', 'required');
        });
        // Restore old values for siswa
        if ('{{ old("nama") }}') document.getElementById('nama').value = '{{ old("nama") }}';
        if ('{{ old("tb") }}') document.getElementById('tb').value = '{{ old("tb") }}';
        if ('{{ old("bb") }}') document.getElementById('bb').value = '{{ old("bb") }}';
    } else if (role === 'guru') {
        document.getElementById('guru-fields').style.display = 'block';
        guruFields.forEach(field => {
            field.disabled = false;
            field.setAttribute('required', 'required');
        });
        // Restore old values for guru
        if ('{{ old("nama_guru") }}') document.getElementById('nama-guru').value = '{{ old("nama_guru") }}';
        if ('{{ old("mapel") }}') document.getElementById('mapel').value = '{{ old("mapel") }}';
    }
}

// Show fields if there's an old role value (after validation error)
document.addEventListener('DOMContentLoaded', function() {
    const checkedRole = document.querySelector('input[name="role"]:checked');
    if (checkedRole) {
        showRoleFields(checkedRole.value);
    }
});
</script>
<style>
.input-field {
    appearance: none;
    border-radius: 0.5rem;
    border-width: 1px;
    border-color: #d1d5db;
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    padding-left: 0.75rem;
    padding-right: 0.75rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    width: 100%;
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

.input-field:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.input-field:hover {
    border-color: #9ca3af;
}
</style>
</html>
