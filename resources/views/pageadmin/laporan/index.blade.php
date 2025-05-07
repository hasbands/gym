@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <a href="{{ route('laporan.laporanbulanan') }}" class="btn btn-primary me-2">Laporan Bulanan</a>
                <a href="{{ route('laporan.laporanharian') }}" class="btn btn-primary">Laporan Harian</a>
            </div>
        </div>
    </div>
@endsection
