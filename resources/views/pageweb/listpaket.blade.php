@extends('template-web.layout')

@section('content')


    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section mt-5">
        <div class="container section-title" data-aos="fade-up">
            <h2>Paket Membership</h2>
            <p>Pilihlah paket membership yang sesuai dengan kebutuhan Anda</p>
        </div>

        <div class="container py-4">
            <div class="row justify-content-center">
              @foreach($paket as $paket)
              <div class="col-12 col-sm-6 col-md-4 mb-2">
                <div class="card shadow-sm rounded">
                  <div class="d-flex align-items-center border-bottom px-3 py-2">
                    <div class="d-flex flex-column align-items-center justify-content-center bg-light rounded me-3" style="width:48px; height:48px;">
                      <span class="fw-semibold fs-5 m-0">{{ $paket->durasi/30 }}</span>
                      <small class="text-secondary m-0">bulan</small>
                    </div>
                    <div class="flex-grow-1">
                      <p class="fw-semibold mb-0">{{ $paket->nama_paket }}</p>
                      <small class="text-secondary">per bulan</small>
                    </div>
                    <div class="text-end me-3">
                      {{-- <small class="text-muted text-decoration-line-through d-block">Rp{{ number_format($paket->harga * 1.25, 0, ',', '.') }}</small> --}}
                      <p class="fw-bold mb-0">Rp{{ number_format($paket->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-success text-white rounded px-2 py-1 fw-semibold" style="font-size: 0.75rem; user-select:none;">
                      {{-- 20% --}}
                    </div>
                  </div>
                  <div class="d-flex justify-content-between border-bottom px-3 py-2">
                    @for($i = 0; $i < 15; $i++)
                    <i class="fas fa-bolt text-secondary"></i>
                    @endfor
                  </div>
                  <a href="{{ route('web.transaksi', $paket->id) }}" class="btn btn-info text-white fw-bold rounded-0 rounded-bottom w-100 py-2">
                    Daftar
                  </a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
    </section>

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
