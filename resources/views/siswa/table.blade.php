@if($siswa->count() > 0)
<div class="overflow-x-auto">
    <table class="table-modern">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    #
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Height
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Weight
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    BMI
                </th>
                @if (session('admin_role') === 'admin')
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($siswa as $i => $s)
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $i + 1 }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-8 w-8">
                            <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-primary-600">
                                    {{ strtoupper(substr($s->nama, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">{{ $s->nama }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $s->tb }} cm
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $s->bb }} kg
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $heightInMeters = $s->tb / 100;
                        $bmi = $heightInMeters > 0 ? $s->bb / ($heightInMeters * $heightInMeters) : 0;
                        $bmiCategory = '';
                        $bmiColor = '';

                        if ($bmi < 18.5) {
                            $bmiCategory = 'Underweight';
                            $bmiColor = 'bg-blue-100 text-blue-800';
                        } elseif ($bmi < 25) {
                            $bmiCategory = 'Normal';
                            $bmiColor = 'bg-green-100 text-green-800';
                        } elseif ($bmi < 30) {
                            $bmiCategory = 'Overweight';
                            $bmiColor = 'bg-yellow-100 text-yellow-800';
                        } else {
                            $bmiCategory = 'Obese';
                            $bmiColor = 'bg-red-100 text-red-800';
                        }
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $bmiColor }}">
                        {{ number_format($bmi, 1) }} - {{ $bmiCategory }}
                    </span>
                </td>
                @if (session('admin_role') === 'admin')
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('siswa.edit', $s->idsiswa) }}" class="text-primary-600 hover:text-primary-900 transition-colors duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <button onclick="confirmDelete('{{ $s->idsiswa }}', '{{ $s->nama }}')" class="text-red-600 hover:text-red-900 transition-colors duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">No students found</h3>
    <p class="mt-1 text-sm text-gray-500">
        @if(request()->has('query'))
            No students match your search criteria.
        @else
            Get started by adding a new student.
        @endif
    </p>
    @if (session('admin_role') === 'admin' && !request()->has('query'))
    <div class="mt-6 flex space-x-3 justify-center">
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
    @endif
</div>
@endif