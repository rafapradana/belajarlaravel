<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - StudyFlow</title>
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
                            <h1 class="text-xl font-semibold text-gray-900">StudyFlow</h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h1 class="text-xl font-semibold text-gray-900">Add New Student</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Enter the student's information below
                        </p>
                    </div>

                    <!-- Form -->
                    <div class="px-6 py-6">
                        <form method="POST" action="{{ route('siswa.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name
                                </label>
                                <input
                                    id="nama"
                                    name="nama"
                                    type="text"
                                    required
                                    class="input-field"
                                    placeholder="Enter student's full name"
                                    value="{{ old('nama') }}"
                                >
                                <p class="mt-1 text-xs text-gray-500">Enter the complete name of the student</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="tb" class="block text-sm font-medium text-gray-700 mb-2">
                                        Height (cm)
                                    </label>
                                    <div class="relative">
                                        <input
                                            id="tb"
                                            name="tb"
                                            type="number"
                                            required
                                            min="50"
                                            max="250"
                                            class="input-field pr-12"
                                            placeholder="170"
                                            value="{{ old('tb') }}"
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-sm">cm</span>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Height in centimeters (50-250 cm)</p>
                                </div>

                                <div>
                                    <label for="bb" class="block text-sm font-medium text-gray-700 mb-2">
                                        Weight (kg)
                                    </label>
                                    <div class="relative">
                                        <input
                                            id="bb"
                                            name="bb"
                                            type="number"
                                            required
                                            min="10"
                                            max="200"
                                            step="0.1"
                                            class="input-field pr-12"
                                            placeholder="65.5"
                                            value="{{ old('bb') }}"
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-sm">kg</span>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Weight in kilograms (10-200 kg)</p>
                                </div>
                            </div>

                            <!-- BMI Preview -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">BMI Preview</h4>
                                <div id="bmiPreview" class="text-sm text-gray-600">
                                    Enter height and weight to calculate BMI
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex flex-col sm:flex-row sm:justify-end sm:space-x-3 space-y-3 sm:space-y-0 pt-6 border-t border-gray-200">
                                <a href="{{ route('home') }}" class="btn-secondary w-full sm:w-auto justify-center">
                                    Cancel
                                </a>
                                <button type="submit" class="btn-primary w-full sm:w-auto justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Student
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // BMI Calculator
        function calculateBMI() {
            const height = parseFloat(document.getElementById('tb').value);
            const weight = parseFloat(document.getElementById('bb').value);
            const preview = document.getElementById('bmiPreview');

            if (height && weight && height > 0) {
                const heightInMeters = height / 100;
                const bmi = weight / (heightInMeters * heightInMeters);

                let category = '';
                let color = '';

                if (bmi < 18.5) {
                    category = 'Underweight';
                    color = 'text-blue-600';
                } else if (bmi < 25) {
                    category = 'Normal weight';
                    color = 'text-green-600';
                } else if (bmi < 30) {
                    category = 'Overweight';
                    color = 'text-yellow-600';
                } else {
                    category = 'Obese';
                    color = 'text-red-600';
                }

                preview.innerHTML = `BMI: <span class="font-medium ${color}">${bmi.toFixed(1)} (${category})</span>`;
            } else {
                preview.textContent = 'Enter height and weight to calculate BMI';
            }
        }

        document.getElementById('tb').addEventListener('input', calculateBMI);
        document.getElementById('bb').addEventListener('input', calculateBMI);
    </script>
</body>
</html>
