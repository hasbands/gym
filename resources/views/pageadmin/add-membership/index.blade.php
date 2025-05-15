@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Membership</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--breadcrumb-->
        <h6 class="mb-0 text-uppercase">Data Membership</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('adminMembership.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                <a href="{{ route('adminMembership.cekstatus') }}" class="btn btn-warning mb-3">Cek Status Membership</a>
                <a href="{{ route('adminMembership.sendmessage') }}" class="btn btn-success mb-3">Kirim Pesan</a>
                <!-- Tambahkan input pencarian -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama...">
                </div>

                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Status Membership</th>
                                <th>Nama Anggota</th>
                                <th>Nama Paket</th>
                                <th>Nama Suplemen</th>
                                <th>Jumlah Suplemen</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Metode Pembayaran</th>
                                <th>Total Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($membership as $index => $f)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $f->order_id ?? '-' }}</span></td>
                                <td><span class="badge bg-{{ $f->member_status == 'aktif' ? 'success' : 'danger' }}">{{ $f->member_status ?? '-' }}</span></td>
                                <td>{{ strtoupper($f->user->nama) }}</td>
                                <td>{{ $f->masterPaket->nama_paket ?? '-' }}</td>
                                <td>{{ $f->masterSuplemen->nama_suplemen ?? '-' }}</td>
                                <td>{{ $f->jumlah_suplemen ?? '-' }}</td>
                                <td><span class="badge bg-success">{{ \Carbon\Carbon::parse($f->mulai)->isoFormat('D MMMM Y') }}</span></td>
                                <td><span class="badge bg-warning">{{ \Carbon\Carbon::parse($f->selesai)->isoFormat('D MMMM Y') }}</span></td>
                                <td>{{ $f->metode_pembayaran ?? '-' }}</td>
                                <td>Rp. {{ number_format($f->total_bayar, 0, ',', '.') }}</td>
                                <td><span class="badge bg-{{ $f->status_pembayaran == 'success' ? 'success' : 'danger' }}">{{ $f->status_pembayaran ?? '-' }}</span></td>
                                <td>
                                    <a href="{{ route('adminMembership.edit', $f->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('adminMembership.destroy', $f->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Status Membership</th>
                                <th>Nama Anggota</th>
                                <th>Nama Paket</th>
                                <th>Nama Suplemen</th>
                                <th>Jumlah Suplemen</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Metode Pembayaran</th>
                                <th>Total Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi pencarian
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchText = this.value.toLowerCase();
            let table = document.getElementById('example2');
            let rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                let nameCell = rows[i].getElementsByTagName('td')[3]; // Indeks 3 adalah kolom nama
                if (nameCell) {
                    let name = nameCell.textContent || nameCell.innerText;
                    if (name.toLowerCase().indexOf(searchText) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        });

        // Konfirmasi hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection