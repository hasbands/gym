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
                            <li class="breadcrumb-item active" aria-current="page">Tambah Membership</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->

            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-plus-circle me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Tambah Membership</h5>
                            </div>
                            <hr>
                            <form action="{{ route('add-membership.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="user_id" class="form-label">Pilih Member</label>
                                    <select class="form-select" name="user_id" id="user_id" required>
                                        <option selected disabled>Pilih Member...</option>
                                        @foreach ($user as $u)
                                            <option value="{{ $u->id }}">{{ strtoupper($u->nama) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="master_paket_id" class="form-label">Pilih Paket</label>
                                    <select class="form-select" name="master_paket_id" id="master_paket_id" required>
                                        <option selected disabled>Pilih Paket...</option>
                                        <option value="">Harian</option>
                                        @foreach ($masterPaket as $mp)
                                            <option value="{{ $mp->id }}" data-harga="{{ $mp->harga }}">
                                                {{ $mp->nama_paket }} - {{ $mp->durasi }} Hari - Rp
                                                {{ number_format($mp->harga) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="master_suplemen_id" class="form-label">Pilih Suplemen</label>
                                    <select class="form-select" name="master_suplemen_id" id="master_suplemen_id">
                                        <option selected disabled>Pilih Suplemen...</option>
                                        @foreach ($masterSuplemen as $ms)
                                            @if($ms->stok > 0)
                                                <option value="{{ $ms->id }}" data-harga="{{ $ms->harga }}"
                                                    data-stok="{{ $ms->stok }}">{{ $ms->nama_suplemen }} - Rp
                                                    {{ number_format($ms->harga) }} (Stok: {{ $ms->stok }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="jumlah_suplemen" class="form-label">Jumlah Suplemen</label>
                                    <input type="number" class="form-control" id="jumlah_suplemen" name="jumlah_suplemen"
                                        min="0">
                                </div>

                                <div class="col-md-12">
                                    <label for="total_bayar" class="form-label">Total Bayar</label>
                                    <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly required>

                                </div>

                                <input type="hidden" name="metode_pembayaran" value="cash">
                                <input type="hidden" name="member_status" value="aktif">
                                <input type="hidden" name="status_pembayaran" value="success">

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paketSelect = document.getElementById('master_paket_id');
        const suplemenSelect = document.getElementById('master_suplemen_id');
        const jumlahSuplemenInput = document.getElementById('jumlah_suplemen');
        const totalBayarInput = document.getElementById('total_bayar');

        function hitungTotalBayar() {
            let total = 0;
            
            if (paketSelect.value === '') {
                // Jika paket harian dipilih
                total += 5000;
            } else if (paketSelect.value) {
                const hargaPaket = parseFloat(paketSelect.selectedOptions[0].dataset.harga) || 0;
                total += hargaPaket;
            }

            if (suplemenSelect.value && jumlahSuplemenInput.value) {
                const hargaSuplemen = parseFloat(suplemenSelect.selectedOptions[0].dataset.harga) || 0;
                const jumlah = parseInt(jumlahSuplemenInput.value) || 0;
                total += hargaSuplemen * jumlah;
            }

            totalBayarInput.value = total;
        }

        paketSelect.addEventListener('change', hitungTotalBayar);
        suplemenSelect.addEventListener('change', hitungTotalBayar);
        jumlahSuplemenInput.addEventListener('input', hitungTotalBayar);
    });
</script>
@endsection
