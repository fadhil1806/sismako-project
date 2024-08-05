<x-app-layout>
    @include('inc.form')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container mt-3">
        <a href="{{ route('guru.create') }}" class="btn btn-primary">Tambah data Guru</a>

        <!-- Tampilkan informasi guru -->
        <p>{{ $guru->foto_surat_keterangan_mengajar }}</p>
        <p>{{ $guru->ijazah }}</p>
        <p>{{ $guru->sertifikat }}</p>

        <!-- Tombol Download -->
        <a href="{{ route('guru.download', ['id' => $guru->id, 'type' => 'ktp']) }}" class="btn btn-success">Download Foto KTP</a>
        <a href="{{ route('guru.download', ['id' => $guru->id, 'type' => 'foto_surat_keterangan_mengajar']) }}" class="btn btn-success">Download Foto Surat Keterangan Mengajar</a>

        <!-- Download Ijazah -->
        <div class="d-flex mb-4" style="gap: 20px">
            @foreach ($guru->ijazah as $ijazah)
                <a href="{{ route('guru.download', ['id' => $guru->id, 'type' => 'ijazah', 'path' => $ijazah['nama_file']]) }}" class="btn btn-info">
                    Download Ijazah {{ $ijazah['jenis_ijazah'] }}
                </a>
            @endforeach
        </div>

        <a href="{{ route('guru.download', ['id' => $guru->id, 'type' => 'foto']) }}" class="btn btn-success">Download Foto</a>
        <a href="{{ route('guru.download', ['id' => $guru->id, 'type' => 'ijazah']) }}" class="btn btn-info">Download Ijazah</a>
        <a href="{{ route('guru.download', ['id' => $guru->id, 'type' => 'sertifikat']) }}" class="btn btn-warning">Download Sertifikat</a>
    </div>

    <script>
        const data = @json($guru);
        console.log(data);
    </script>
</x-app-layout>
