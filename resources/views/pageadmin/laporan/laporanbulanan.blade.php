<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<<<<<<< HEAD
    <title>Laporan Bulanan</title>
=======
    <title>Laporan Bulanan {{ \Carbon\Carbon::parse($laporan->first()->created_at)->locale('id')->isoFormat('MMMM Y') }}
    </title>
>>>>>>> a36b8389af00220eaecff74dd0c23980718a5cc3
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif;
        }

        .very-bold {
            font-weight: 1000;
        }

        @page {
            margin: 2.54cm;
            box-sizing: border-box;
        }

        /* Gaya untuk memastikan gambar di kiri dan teks di tengah */
        .header {
            display: flex;
            /* Menggunakan flexbox untuk tata letak */
            align-items: center;
            /* Mengatur agar elemen sejajar secara vertikal */
            justify-content: flex-start;
            /* Mengatur konten ke kiri */
            margin-bottom: 20px;
            /* Jarak bawah untuk pemisah */
        }

        .header img {
            max-width: 100px;
            /* Atur ukuran maksimum gambar */
            margin-right: 20px;
            /* Jarak antara gambar dan teks */
        }

        .header div {
            flex-grow: 1;
            /* Mengizinkan div teks untuk mengambil ruang yang tersisa */
            text-align: center;
            /* Mengatur teks di tengah */
        }

        .header h3,
        .header p {
            margin: 0;
            /* Menghapus margin default */
        }

        .info {
            margin-bottom: 20px;
            /* Jarak bawah untuk informasi */
        }

        .info p {
            margin: 0;
            /* Menghapus margin default */
        }

        .info span {
            display: inline-block;
            /* Menjaga span pada baris yang sama */
            width: 150px;
            /* Lebar span untuk penataan */
        }

        .table-container {
            margin-bottom: 20px;
            /* Jarak bawah untuk tabel */
        }

        .table-container table {
            width: 100%;
            /* Memastikan tabel mengambil lebar penuh */
            border-collapse: collapse;
            /* Menghapus jarak antara border tabel */
        }

        .table-container th,
        .table-container td {
            border: 1px solid black;
            /* Border untuk sel tabel */
            padding: 8px;
            /* Jarak dalam sel */
            text-align: left;
            /* Teks rata kiri */
        }

        .table-container th {
            background-color: #f2f2f2;
            /* Warna latar belakang untuk header tabel */
        }

        .line {
            border-left: 2px solid black;
            display: inline-block;
            margin: 0 10px;
        }

        .line-short {
            height: 500px;
        }

        .line-long {
            height: 700px;
        }

        .page-break {
            page-break-after: always;
            /* Ensures the content after this class starts on a new page */
        }
    </style>
</head>

<body>
<<<<<<< HEAD
    @if($laporan->isEmpty())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Data bulan ini tidak ada',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('laporan.index') }}";
                }
            });
        </script>
    @else
        <div class="pages">
            <div class="header">
                <img src="{{ asset('env/logo_text.png') }}" alt="Logo">
                <div>
                    <h3>Laporan Bulanan {{ \Carbon\Carbon::parse($laporan->first()->created_at)->locale('id')->isoFormat('MMMM Y') }}</h3>
                </div>
            </div>
            <div class="info">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Member</th>
                            <th>Nama Paket</th>
                            <th>Nama Suplemen</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Jumlah Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->masterPaket->nama_paket }}</td>
                                <td>{{ $item->masterSuplemen->nama_suplemen ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->mulai)->locale('id')->isoFormat('D MMMM Y') ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->selesai)->locale('id')->isoFormat('D MMMM Y') ?? '-' }}</td>
                                <td>Rp. {{ number_format($item->total_bayar, 0, ',', '.') ?? '-' }}</td>
                            </tr>
                        @endforeach
                        <tr class="very-bold">
                            <td colspan="6" style="text-align: right;">Total Keuntungan {{ \Carbon\Carbon::parse($laporan->first()->created_at)->locale('id')->isoFormat('MMMM Y') }}:</td>
                            <td>Rp. {{ number_format($laporan->sum('total_bayar'), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            window.onload = function() {
                window.print();
            };
        </script>
    @endif
=======
    <div class="pages">
        <div class="header">
            <div>
                <h3 class="fw-bold">LAPORAN DATA BULAN
                    {{ strtoupper(\Carbon\Carbon::parse($laporan->first()->created_at)->locale('id')->isoFormat('MMMM')) }}
                    RAJA GYM</h3>
                <h4>Telp : +6282286849598</h4>
                <h4>Jl. Perintis Kemerdekaan, Kelurahan Simpang Tiga Teluk Kuantan</h4>
                <h4>Tahun : {{ \Carbon\Carbon::parse($laporan->first()->created_at)->locale('id')->isoFormat('Y') }}</h4>
                <hr>
            </div>
        </div>
        <div class="info">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Member</th>
                        <th>Nama Paket</th>
                        <th>Nama Suplemen</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td>{{ $item->masterPaket->nama_paket }}</td>
                            <td>{{ $item->masterSuplemen->nama_suplemen ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->mulai)->locale('id')->isoFormat('D MMMM Y') ?? '-' }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->selesai)->locale('id')->isoFormat('D MMMM Y') ?? '-' }}
                            </td>
                            <td>Rp. {{ number_format($item->total_bayar, 0, ',', '.') ?? '-' }}</td>


                        </tr>
                    @endforeach
                    <tr class="very-bold">
                        <td colspan="6" style="text-align: right;">Total Pemasukan
                            {{ \Carbon\Carbon::parse($laporan->first()->created_at)->locale('id')->isoFormat('MMMM Y') }}:
                        </td>
                        <td>Rp. {{ number_format($laporan->sum('total_bayar'), 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div style="text-align: right; margin-top: 50px;">
            <p>Teluk Kuantan, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
            <br><br>
            <img src="{{ asset('env/ttd.png') }}" alt="Tanda Tangan" style="width: 150px; height: auto; margin-bottom: -30px; margin-top: -50px;">
            <br><br>
            <p style="text-decoration: underline;">Juan Priandi</p>
            <p>Pemilik Raja Gym</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
>>>>>>> a36b8389af00220eaecff74dd0c23980718a5cc3
</body>

</html>
