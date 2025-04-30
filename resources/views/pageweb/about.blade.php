@extends('template-web.layout')

@section('content')


    <!-- About Section -->
    <section id="about" class="about section" style="margin-top: 100px;">
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


@endsection
