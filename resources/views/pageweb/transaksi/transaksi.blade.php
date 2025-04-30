@extends('template-web.layout')

@section('content')
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section mt-5">
        <div class="container section-title" data-aos="fade-up">
            <h2>Transaksi</h2>
            <p>Pilihlah Paket dan Suplemen yang sesuai dengan kebutuhan Anda</p>
        </div>

        <div class="container py-4">
            <form action="{{ route('web.add-membership') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <label for="master_paket_id" class="form-label">Nama Paket</label>
                    <input type="text" class="form-control" id="master_paket_id" required readonly
                        value="{{ $paket->nama_paket }} - {{ $paket->durasi }} Hari - Rp {{ number_format($paket->harga) }}">
                    <input type="hidden" name="master_paket_id" value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">
                </div>

                <div class="col-md-12">
                    <label for="master_suplemen_id" class="form-label">Pilih Suplemen (Opsional)</label>
                    <select class="form-select" name="master_suplemen_id" id="master_suplemen_id">
                        <option value="">Tidak Memilih Suplemen</option>
                        @foreach ($suplemen as $ms)
                            @if ($ms->stok > 0)
                                <option value="{{ $ms->id }}" data-harga="{{ $ms->harga }}"
                                    data-stok="{{ $ms->stok }}">
                                    {{ $ms->nama_suplemen }} - Rp
                                    {{ number_format($ms->harga) }} (Stok: {{ $ms->stok }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="jumlah_suplemen" class="form-label">Jumlah Suplemen (Opsional)</label>
                    <input type="number" class="form-control" id="jumlah_suplemen" name="jumlah_suplemen" min="0">
                </div>

                <div class="col-md-12">
                    <label for="total_bayar" class="form-label">Total Bayar</label>
                    <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly required>
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-5">Bayar</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paketInput = document.querySelector('input[name="master_paket_id"]');
        const suplemenSelect = document.getElementById('master_suplemen_id');
        const jumlahSuplemenInput = document.getElementById('jumlah_suplemen');
        const totalBayarInput = document.getElementById('total_bayar');

        function hitungTotalBayar() {
            let total = 0;
            
            // Ambil harga paket dari data attribute
            const hargaPaket = parseFloat(paketInput.dataset.harga) || 0;
            total += hargaPaket;

            if (suplemenSelect.value && jumlahSuplemenInput.value) {
                const hargaSuplemen = parseFloat(suplemenSelect.selectedOptions[0].dataset.harga) || 0;
                const jumlah = parseInt(jumlahSuplemenInput.value) || 0;
                total += hargaSuplemen * jumlah;
            }

            totalBayarInput.value = total;
        }

        // Hitung total awal
        hitungTotalBayar();

        suplemenSelect.addEventListener('change', hitungTotalBayar);
        jumlahSuplemenInput.addEventListener('input', hitungTotalBayar);
    });
</script>
@endsection