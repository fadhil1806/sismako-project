<x-app-layout>
    @include('inc.form')

    <div class="container mt-4">
        <a href="{{route('dashboard')}}" class="btn btn-secondary">Back</a>
    </div>
    <div class="py-12 container">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card card-bordered card-kelulusan" style="cursor: pointer" onclick="toHref('/pkl/adm-sekolah')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{ asset('icons/school-unscreen.gif') }}" alt="" class="img-icons">
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Administrasi Sekolah</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-bordered card-kelulusan" style="cursor: pointer" onclick="toHref('/pkl/adm-siswa')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{ asset('icons/student-unscreen.gif') }}" alt="" class="img-icons">
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center"
                            style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Administrasi Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function toHref(link) {
            window.location.href = link;
        }
    </script>
</x-app-layout>
