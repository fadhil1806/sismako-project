<x-app-layout>
    <link rel="stylesheet" href="{{ asset('dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/demo.min.css') }}">
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.min.js') }}"></script>
    <script src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}" defer></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="/sekolah-keasramaan/jurnal-asrama/tajwid" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('tajwid.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type='date' class="form-control datepicker"
                                            placeholder="Masukan Tanggal" id="datepicker-icon-1" name="tanggal"
                                            autocomplete='off'>
                                        @error('tanggal')
                                            <div class="text-danger mt-2"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Angkatan</label>
                                        <select class="form-control" name="angkatan" id="angkatan-select">
                                            <option value="">-- Pilih Angkatan --</option>
                                            @foreach ($angkatan as $data)
                                                <option value="{{ $data }}"
                                                    {{ old('angkatan') == $data ? 'selected' : '' }}>
                                                    {{ $data }}</option>
                                            @endforeach
                                        </select>
                                        @error('angkatan')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <!-- Nama Filter -->
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <select class="form-control" name="siswa_id" id="nama-select">
                                            <option value="">-- Pilih Nama --</option>
                                            <!-- Options will be populated dynamically -->
                                        </select>
                                        @error('siswa_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="materi" class="form-label">Nama materi</label>
                                        <input type="text"
                                            class="form-control @error('materi') is-invalid @enderror" id="materi"
                                            name="materi" value="{{ old('materi') }}">
                                        @error('materi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Add Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('js.getNameByAngkatan')
</x-app-layout>
