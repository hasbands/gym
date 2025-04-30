@extends('template-web.layout')

@section('content')
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-4 text-center">Riwayat Transaksi</h2>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Paket</th>
                                        <th>Suplemen</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($membership as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>#{{ $item->order_id }}</td>
                                            <td>{{ $item->masterPaket->nama_paket }}</td>
                                            <td>
                                                @if ($item->masterSuplemen)
                                                    {{ $item->masterSuplemen->nama_suplemen }}
                                                    ({{ $item->jumlah_suplemen }} pcs)
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $item->status_pembayaran == 'success' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ strtoupper($item->status_pembayaran) }}
                                                </span>
                                            </td>
                                            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('web.success_membership', ['order_id' => $item->order_id]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($membership->isEmpty())
                            <div class="text-center py-4">
                                <p class="text-muted">Belum ada riwayat transaksi</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
