@extends('template-web.layout')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2><span>Selamat Datang di </span><span class="accent">RajaGym</span></h2>
                    <p>Tempat terbaik untuk memulai perjalanan kebugaran Anda. Bergabunglah dengan kami dan capai tujuan kebugaran Anda.</p>
                    <div class="d-flex">
                        <a href="#portfolio" class="btn-get-started">Ayo Bergabung!!</a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <img src="{{ asset('web') }}/img/hero-img.svg" class="img-fluid" alt="">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">
                    <div class="col-xl-3 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-easel"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Harga Terjangkau</a></h4>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-gem"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Fasilitas Lengkap</a></h4>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-geo-alt"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Lokasi Strategis</a></h4>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-command"></i></div>
                            <h4 class="title"><a href="" class="stretched-link">Pelayanan Terbaik</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Tentang Kami</h2>
            <p>Komitmen kami untuk membantu Anda mencapai tujuan kebugaran</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <h3>Fasilitas Lengkap dan Modern untuk Mendukung Latihan Anda</h3>
                    <img src="{{ asset('web') }}/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                    <p>Kami menyediakan berbagai peralatan fitness modern dan area latihan yang nyaman untuk memastikan setiap member dapat berlatih dengan maksimal.</p>
                    <p>Didukung oleh tim pelatih berpengalaman yang siap membimbing Anda mencapai target kebugaran yang diinginkan.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            Keunggulan bergabung dengan Impact Fitness:
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Peralatan fitness modern dan berkualitas tinggi</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Program latihan yang disesuaikan dengan kebutuhan</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Pelatih profesional yang siap membimbing</span></li>
                        </ul>
                        <p>
                            Bergabunglah dengan komunitas fitness kami dan rasakan manfaat hidup sehat bersama Impact Fitness
                        </p>

                        <div class="position-relative mt-4">
                            <img src="{{ asset('web') }}/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section mb-5">
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
            <div class="text-center mt-4">
              <a href="{{ route('web.listpaket') }}" class="btn btn-info text-white fw-bold rounded-0 rounded-bottom w-100 py-2">
                Lihat Semua Paket
              </a>
            </div>
          </div>
    </section>

    <!-- Faq Section -->
    <section id="faq" class="faq section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="content px-xl-5">
                        <h3><span>Pertanyaan </span><strong>Umum</strong></h3>
                        <p>
                            Berikut adalah beberapa pertanyaan yang sering ditanyakan oleh calon member kami
                        </p>
                    </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="faq-container">
                        <div class="faq-item faq-active">
                            <h3><span class="num">1.</span> <span>Apa saja fasilitas yang tersedia?</span></h3>
                            <div class="faq-content">
                                <p>Kami menyediakan berbagai peralatan fitness modern, area kardio, ruang kelas, dan fasilitas pendukung lainnya.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">2.</span> <span>Apakah ada program khusus untuk pemula?</span></h3>
                            <div class="faq-content">
                                <p>Ya, kami memiliki program khusus untuk pemula dengan bimbingan pelatih profesional.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">3.</span> <span>Berapa lama waktu operasional gym?</span></h3>
                            <div class="faq-content">
                                <p>Gym kami buka setiap hari dari pukul 06.00 hingga 22.00 WIB.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">4.</span> <span>Apakah ada program nutrisi?</span></h3>
                            <div class="faq-content">
                                <p>Ya, kami menyediakan konsultasi nutrisi dengan ahli gizi berpengalaman.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3><span class="num">5.</span> <span>Bagaimana cara mendaftar membership?</span></h3>
                            <div class="faq-content">
                                <p>Anda dapat mendaftar langsung di gym atau melalui website kami dengan memilih paket yang tersedia.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
