<nav id="navmenu" class="navmenu">
    <ul>
      <li><a href="{{ route('web.home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Halaman Utama</a></li>
      <li><a href="{{ route('web.about') }}" class="{{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
      <li><a href="{{ route('web.listpaket') }}" class="{{ request()->is('listpaket') ? 'active' : '' }}">List Paket</a></li>
      @auth
        <li><a href="{{ route('web.riwayat_transaksi') }}" class="{{ request()->is('riwayat-transaksi') ? 'active' : '' }}">Riwayat Transaksi</a></li>
        <li><a href="{{ route('web.profil') }}" class="{{ request()->is('profil') ? 'active' : '' }}">Profil</a></li>
        <li>
          <a href="#">{{ auth()->user()->nama }}</a>
          <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Keluar</a>
        </li>
      @else
        <li><a href="{{ route('login') }}">Masuk</a></li>
        <li><a href="{{ route('register.form') }}">Daftar</a></li>
      @endauth
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
  </nav>