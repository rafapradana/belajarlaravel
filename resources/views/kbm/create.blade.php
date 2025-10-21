@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Jadwal KBM</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('kbm.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="idguru" class="col-md-4 col-form-label text-md-right">{{ __('Guru') }}</label>

                            <div class="col-md-6">
                                <select id="idguru" class="form-control @error('idguru') is-invalid @enderror" name="idguru" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->idguru }}" {{ old('idguru') == $g->idguru ? 'selected' : '' }}>
                                            {{ $g->nama }} - {{ $g->mapel }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('idguru')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idwalas" class="col-md-4 col-form-label text-md-right">{{ __('Walas/Kelas') }}</label>

                            <div class="col-md-6">
                                <select id="idwalas" class="form-control @error('idwalas') is-invalid @enderror" name="idwalas" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($walas as $w)
                                        <option value="{{ $w->idwalas }}" {{ old('idwalas') == $w->idwalas ? 'selected' : '' }}>
                                            {{ $w->namakelas }} - {{ $w->jenjang }} ({{ $w->tahunajaran }})
                                        </option>
                                    @endforeach
                                </select>

                                @error('idwalas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hari" class="col-md-4 col-form-label text-md-right">{{ __('Hari') }}</label>

                            <div class="col-md-6">
                                <select id="hari" class="form-control @error('hari') is-invalid @enderror" name="hari" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                </select>

                                @error('hari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mulai" class="col-md-4 col-form-label text-md-right">{{ __('Jam Mulai') }}</label>

                            <div class="col-md-6">
                                <input id="mulai" type="time" class="form-control @error('mulai') is-invalid @enderror" name="mulai" value="{{ old('mulai') }}" required>

                                @error('mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="selesai" class="col-md-4 col-form-label text-md-right">{{ __('Jam Selesai') }}</label>

                            <div class="col-md-6">
                                <input id="selesai" type="time" class="form-control @error('selesai') is-invalid @enderror" name="selesai" value="{{ old('selesai') }}" required>

                                @error('selesai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                                <a href="{{ route('kbm.index') }}" class="btn btn-secondary">
                                    {{ __('Batal') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection