<x-app-layout>
    @include('inc.form')
    <head>
        <style>
            /* Styling for images */
            .img-icons {
                width: 75px;
                background: transparent;
            }
            /* Styling for cards */
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border-radius: 10px;
                padding: 15px;
                color: #fff;
            }
            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            }
            /* Styling for card body */
            .card-body {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .content-body-1 img {
                transition: transform 0.5s ease-in-out;
            }
            .content-body-1:hover img {
                transform: scale(1.5);
            }
            .btn-group a {
                margin-right: 10px;
            }
            /* Card Colors */
            .card-guru { background-color: #4CAF50; }
            .card-siswa { background-color: #2196F3; }
            .card-mutasi { background-color: #FF9800; }
            .card-award { background-color: #9C27B0; }
            .card-tendik { background-color: #F44336; }
            .card-kelas { background-color: #00BCD4; }
            .card-kelulusan { background-color: #FFC107; }
            .card-pkl { background-color: #8BC34A; }
        </style>
    </head>
    <script>
        async function toHref(url) {
            window.location.href = url;
        }
    </script>
    <div class="py-12 container">
        <div class="row g-3">
            <div class="col-lg-3">
                <div class="card card-bordered card-guru" style="cursor: pointer" onclick="toHref('/guru')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/teacher.png')}}" alt="" class="img-icons">
                            <h2>Guru</h2>
                        </div>
                        <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h3 class="text-center">Active</h3>
                                <h1 class="text-center">{{$totalGuruAktif}}</h1>
                            </div>
                            <div class="content-body-2-2" style="width: 50%">
                                <h3 class="text-center">Off</h3>
                                <h1 class="text-center">{{$totalGuruTidakAktif}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-siswa" style="cursor: pointer" onclick="toHref('/siswa')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/student.png')}}" alt="" class="img-icons">
                            <h2>Siswa</h2>
                        </div>
                        <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h3 class="text-center">Active</h3>
                                <h1 class="text-center">{{$totalSiswaAktif}}</h1>
                            </div>
                            <div class="content-body-2-2" style="width: 50%">
                                <h3 class="text-center">Off</h3>
                                <h1 class="text-center">{{$totalSiswaTidakAktif}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-mutasi" style="cursor: pointer" onclick="toHref('/data-mutasi')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/sign-out.png')}}" alt="" class="img-icons">
                            <h2>Mutasi</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <div class="content-body-2-3">
                                    <h2 class="text-center">Data Mutasi Siswa dan Guru</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-award" style="cursor: pointer">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%" onclick="toHref('/data-prestasi')">
                            <img  src="{{asset('icons/medal.png')}}" alt="" class="img-icons">
                            <h2>Award</h2>
                        </div>
                        <div style="gap: 20px; width: 100%;" onclick="toHref('/punishment')">
                            <div class="content-body-2-1" style="display: grid; justify-items: center">
                                <img src="{{asset('icons/hammer.png')}}" alt="" class="img-icons" style="width: 60px">
                                <h3 style="font-size: 19px">Punishment</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-tendik" style="cursor: pointer" onclick="toHref('/tendik')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1">
                            <img src="{{asset('icons/classroom.png')}}" alt="" class="img-icons">
                            <h2>Tendik</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1" style="width: 50%">
                                <h1 class="text-center">{{$totalTendik}} Orang</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-kelas" style="cursor: pointer" onclick="toHref('/kelas')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/notebook.png')}}" alt="" class="img-icons">
                            <h2>Kelas</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Peserta Didik Perkelas</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-kelulusan" style="cursor: pointer" onclick="toHref('/kelulusan')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/education.png')}}" alt="" class="img-icons">
                            <h2  style="margin: 0">Lulusan</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data Kelulusan {{$totalKelulusanSiswa}} Orang</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-pkl" style="cursor: pointer" onclick="toHref('/pkl')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/school.png')}}" alt="" class="img-icons">
                            <h2>PKL</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center" style="gap: 20px; width: 100%">
                            <div class="content-body-2-1">
                                <h2 class="text-center">Data PKL</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
