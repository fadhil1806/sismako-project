<x-app-layout>
    @include('inc.form')
    <div class="container mt-5">
        <a href="{{route('mutasi.index')}}" class="btn btn-secondary mb-4">Back</a>
        <form method="post" action="{{route('patroli.asrama.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Jenis Patroli</label>
                        <select class="form-select" name="status_patroli" id="mutasi" value="{{ old('status_patroli') }}">
                            <option value="Kebersihan" selected>Kebersihan</option>
                            <option value=" keamanan">keamanan</option>
                            <option value="Kamar Asrama">Kamar Asrama</option>
                        </select>
                        @error('status_patroli')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4" id="asalSekolahDiv">
                    <div class="mb-3">
                        <label class="form-label">Area Tempat</label>
                        <input type="text" class="form-control" name="area" value="{{ old('area') }}">
                        @error('area')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4" id="asalSekolahDiv">
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Dokumentasi</label>
                        <input type="file" class="form-control" name="dokumentasi" value="{{ old('dokumentasi') }}">
                        @error('dokumentasi')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
            </div>
        </form>
    </div>

    </script>
</x-app-layout>
