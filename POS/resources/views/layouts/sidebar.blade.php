<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ url($setting->path_logo) }}" alt="POS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b>{{ $setting->nama_perusahaan }}</b></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle elevation-2 img-profil" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('user.profil') }}" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>  

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : ''}}">
            <i class="nav-icon fas fa-house"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        @if (auth()->user()->level == 1)

        <li class="nav-header">MASTER</li>

        <li class="nav-item">
          <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('kategori') ? 'active' : ''}}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Kategori
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('produk.index') }}" class="nav-link {{ request()->is('produk') ? 'active' : ''}}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Produk
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('member.index') }}" class="nav-link {{ request()->is('member') ? 'active' : ''}}">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
              Member
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->is('supplier') ? 'active' : ''}}">
            <i class="nav-icon fas fa-boxes-stacked"></i>
            <p>
              Supplier
            </p>
          </a>
        </li>

        <li class="nav-header">TRANSAKSI</li>

        <li class="nav-item">
          <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ request()->is('pengeluaran') ? 'active' : ''}}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Pengeluaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembelian.index') }}" class="nav-link {{ request()->is('pembelian','pembelian_detail') ? 'active' : ''}}">
            <i class="nav-icon fas fa-cart-shopping"></i>
            <p>
              Pembelian
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('penjualan.index') }}" class="nav-link {{ request()->is('penjualan') ? 'active' : ''}}">
            <i class="nav-icon fas fa-handshake-angle"></i>
            <p>
              Penjualan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->is('transaksi') ? 'active' : ''}}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Transaksi Aktif
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('transaksi.baru') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-column"></i>
            <p>
              Transaksi Baru
            </p>
          </a>
        </li>

        <li class="nav-header">REPORT</li>

        <li class="nav-item">
          <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->is('laporan') ? 'active' : ''}}">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>

        <li class="nav-header">SYSTEM</li>

        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user') ? 'active' : ''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('setting.index') }}" class="nav-link {{ request()->is('setting') ? 'active' : ''}}">
            <i class="nav-icon fas fa-gear"></i>
            <p>
              Pengaturan
            </p>
          </a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->is('transaksi') ? 'active' : ''}}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Transaksi Aktif
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('transaksi.baru') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-column"></i>
            <p>
              Transaksi Baru
            </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>