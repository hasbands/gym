@extends('template-web.layout')

@section('content')
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <!-- Header Invoice -->
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-3">Pembayaran Berhasil!</h2>
                            <div class="d-flex justify-content-center">
                                <div class="bg-success text-white rounded-circle p-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-check-lg" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <p class="text-muted small">Terima kasih telah melakukan pembayaran membership gym</p>
                        </div>

                        <!-- Detail Transaksi -->
                        <div class="border-bottom pb-3 mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="text-muted small mb-2">INVOICE TO</h6>
                                    <h6 class="mb-1">{{ auth()->user()->nama }}</h6>
                                    <p class="mb-0 text-muted small">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <h6 class="text-muted small mb-2">ORDER ID</h6>
                                    <h6 class="mb-1">#{{ $transaksi->order_id }}</h6>
                                    <p class="mb-0 text-muted small">{{ date('d F Y H:i', strtotime($transaksi->created_at)) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Paket -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Detail Membership</h6>
                            <div class="bg-light p-3 rounded-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <h6 class="fw-bold mb-1 small">{{ $transaksi->masterPaket->nama_paket }}</h6>
                                        <p class="text-muted mb-0 small">Durasi: {{ floor($transaksi->masterPaket->durasi/30) }} Bulan {{ $transaksi->masterPaket->durasi % 30 }} Hari</p>
                                    </div>
                                    @if($transaksi->masterSuplemen)
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-1 small">Suplemen Tambahan</h6>
                                        <p class="text-muted mb-0 small">{{ $transaksi->masterSuplemen->nama_suplemen }} {{ $transaksi->jumlah_suplemen ? '('. $transaksi->jumlah_suplemen .' pcs)' : '' }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Periode Membership -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Periode Membership</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <div class="bg-light p-2 rounded-3 text-center">
                                        <small class="text-muted d-block mb-1">Tanggal Mulai</small>
                                        <strong class="small">{{ date('d F Y', strtotime($transaksi->mulai)) }}</strong>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <div class="bg-light p-2 rounded-3 text-center">
                                        <small class="text-muted d-block mb-1">Tanggal Selesai</small>
                                        <strong class="small">{{ date('d F Y', strtotime($transaksi->selesai)) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Pembayaran -->
                        <div class="border-top pt-3">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <span class="badge {{ $transaksi->status_pembayaran == 'success' ? 'bg-success' : 'bg-warning' }} p-2 small">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ strtoupper($transaksi->status_pembayaran) }}
                                    </span>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <small class="text-muted">Total Pembayaran</small>
                                    <h5 class="mb-0">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Kembali -->
                        <div class="text-center mt-4">
                            <a href="{{ route('web.home') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
