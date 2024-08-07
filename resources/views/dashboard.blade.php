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
            .content-body-2-1 img {
                transition: transform 0.5s ease-in-out;
            }
            .content-body-2-1:hover img {
                transform: scale(1.5);
            }
            .content-body-1:hover img {
                transform: scale(1.5);
            }
            .btn-group a {
                margin-right: 10px;
            }
            /* Card Colors */
            .card-guru { background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%); }
            .card-siswa { background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%); }
            .card-mutasi { background-image: linear-gradient(-60deg, #ff5858 0%, #f09819 100%); }
            .card-award { background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .card-tendik { background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%); }
            .card-kelas {background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%); }
            .card-kelulusan { background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%); }
            .card-pkl { background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%); }
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
                            <img src="{{asset('icons/training-unscreen.gif')}}" alt="" class="img-icons">
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
                            <img src="{{asset('icons/student-unscreen.gif')}}" alt="" class="img-icons">
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
                            <img src="{{asset('icons/exit-unscreen.gif')}}" alt="" class="img-icons">
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
                            <img  src="{{asset('icons/trophy-unscreen.gif')}}" alt="" class="img-icons">
                            <h2>Award</h2>
                        </div>
                        <div style="gap: 20px; width: 100%;" onclick="toHref('/punishment')">
                            <div class="content-body-2-1" style="display: grid; justify-items: center">
                                <img src="{{asset('icons/axe-unscreen.gif')}}" alt="" class="img-icons" style="width: 60px;">
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
                            <img src="{{asset('icons/professor-unscreen.gif')}}" alt="" class="img-icons">
                            <h2 class="text-black">Tendik</h2>
                        </div>
                        <div class="content-body-2 d-flex justify-content-center align-items-center" style="gap: 20px; width: 100%">
                            <div class="content-body-2 d-flex" style="gap: 20px; width: 100%">
                                <div class="content-body-2-1" style="width: 50%">
                                    <h3 class="text-center text-black">Active</h3>
                                    <h1 class="text-center text-black">{{$totalTendikAktif}}</h1>
                                </div>
                                <div class="content-body-2-2" style="width: 50%">
                                    <h3 class="text-center text-black">Off</h3>
                                    <h1 class="text-center text-black">{{$totalTendikTidakAktif}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-bordered card-kelas" style="cursor: pointer" onclick="toHref('/kelas')">
                    <div class="card-body d-flex" style="gap: 25px">
                        <div class="content-body-1" style="width: 35%">
                            <img src="{{asset('icons/search-book-unscreen.gif')}}" alt="" class="img-icons">
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
                            <img src="{{asset('icons/education-unscreen.gif')}}" alt="" class="img-icons">
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
                            <img src="{{asset('icons/digital-nomad-unscreen.gif')}}" alt="" class="img-icons">
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
