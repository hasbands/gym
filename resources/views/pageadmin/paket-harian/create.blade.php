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
                            <li class="breadcrumb-item active" aria-current="page">Paket Harian</li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Paket Harian</li>
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
                                <h5 class="mb-0 text-primary">Tambah Paket Harian</h5>
                            </div>
                            <hr>
                            <form action="{{ route('paket-harian.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('nama') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>
                                <div class="col-md-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('alamat') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>
                                <div class="col-md-12">
                                    <label for="nomor_wa" class="form-label">Nomor WA</label>
                                    <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('nomor_wa') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>
                             
                                
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