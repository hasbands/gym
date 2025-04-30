@extends('template-web.layout')

@section('content')
    <header class="site-header d-flex flex-column justify-content-center align-items-center py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0 fw-bold">Detail Membership Gym</h2>
                </div>
            </div>
        </div>
    </header>

    <section class="latest-podcast-section justify-content-center section-padding py-5" id="section_2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">
                    <div class="card h-100 shadow-lg border-0 rounded-3">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4 pb-2 border-bottom">Detail Transaksi</h5>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th width="35%">Order ID</th>
                                        <td>
                                            <span class="badge bg-primary rounded-pill">{{ $transaksi->order_id }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <td>
                                            <span class="fw-medium">{{ $transaksi->masterPaket->nama_paket }}</span>
                                            @if($transaksi->masterSuplemen)
                                                <br>
                                                <small class="text-muted">
                                                    + {{ $transaksi->masterSuplemen->nama_suplemen }}
                                                    {{ $transaksi->jumlah_suplemen ? '('. $transaksi->jumlah_suplemen .' pcs)' : '' }}
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>{{ floor($transaksi->masterPaket->durasi/30) }} Bulan {{ $transaksi->masterPaket->durasi % 30 }} Hari</td>
                                    </tr>
                                    <tr>
                                        <th>Total Bayar</th>
                                        <td class="fw-bold text-success">Rp. {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pembayaran</th>
                                        <td>
                                            <span class="badge {{ $transaksi->status_pembayaran == 'pending' ? 'bg-warning' : ($transaksi->status_pembayaran == 'settlement' ? 'bg-success' : ($transaksi->status_pembayaran == 'cancel' ? 'bg-danger' : ($transaksi->status_pembayaran == 'expire' ? 'bg-danger' : 'bg-secondary')))}}">
                                                {{ strtoupper($transaksi->status_pembayaran) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td>{{ date('d F Y', strtotime($transaksi->mulai)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>{{ date('d F Y', strtotime($transaksi->selesai)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <div class="text-center mt-4">
                                <button id="pay-button" class="btn btn-success btn-lg px-5 rounded-pill">
                                    <i class="bi bi-credit-card me-2"></i>Bayar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $transaksi->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = "{{ route('web.success_membership', $transaksi->order_id) }}";
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection