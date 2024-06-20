
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-header">Menu</li>

      @can('view_admin')
      <li class="nav-item">
        <a href="{{ route('admin.user') }}" class="nav-link {{ \Route::is('admin.user') ? 'active' : '' }}">
          <i class="nav-icon far fa-user"></i>
          <p>
            Pengguna
          </p>
        </a>
      </li>
      @endcan

      @can('view_akuntan')
      <li class="nav-item">
        <a href="{{ route('akuntan.index') }}" class="nav-link {{ \Route::is('akuntan.index') ? 'active' : '' }}">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item {{ \Route::is('akuntan.akun') ? 'menu-open' : '' }} {{ \Route::is('akuntan.kelompok') ? 'menu-open' : '' }} {{ \Route::is('akuntan.tipe') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ \Route::is('akuntan.akun') ? 'active' : '' }} {{ \Route::is('akuntan.kelompok') ? 'active' : '' }} {{ \Route::is('akuntan.tipe') ? 'active' : '' }}">
          <i class="nav-icon fas fa-database"></i>
          <p>
            Data Akun
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('akuntan.akun') }}" class="nav-link {{ \Route::is('akuntan.akun') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Akun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('akuntan.kelompok') }}" class="nav-link {{ \Route::is('akuntan.kelompok') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Kelompok Akun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('akuntan.tipe') }}" class="nav-link {{ \Route::is('akuntan.tipe') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tipe Akun</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{ route('akuntan.transaksi') }}" class="nav-link {{ \Route::is('akuntan.transaksi') ? 'active' : '' }}">
          <i class="nav-icon fas fa-handshake"></i>
          <p>
            Riwayat Transaksi
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('akuntan.jurnal') }}" class="nav-link {{ \Route::is('akuntan.jurnal') ? 'active' : '' }}{{ \Route::is('akuntan.jurnal.tambah') ? 'active' : '' }}">
          <i class="nav-icon fas fa-window-restore"></i>
          <p>
            Jurnal
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('akuntan.buku-besar') }}" class="nav-link {{ \Route::is('akuntan.buku-besar') ? 'active' : '' }}">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Buku Besar
          </p>
        </a>
      </li>
      <li class="nav-header">Laporan</li>
      <li class="nav-item">
        <a href="{{ route('akuntan.laba-rugi') }}" class="nav-link {{ \Route::is('akuntan.laba-rugi') ? 'active' : '' }}">
          <i class="nav-icon fas fa-percentage"></i>
          <p>
            Laba Rugi
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('akuntan.perubahan-modal') }}" class="nav-link {{ \Route::is('akuntan.perubahan-modal') ? 'active' : '' }}">
          <i class="nav-icon fas fa-sync-alt"></i>
          <p>
            Perubahan Modal
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('akuntan.arus-kas') }}" class="nav-link {{ \Route::is('akuntan.arus-kas') ? 'active' : '' }}">
          <i class="nav-icon fas fa-money-bill"></i>
          <p>
            Arus Kas
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('akuntan.neraca-keuangan') }}" class="nav-link {{ \Route::is('akuntan.neraca-keuangan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-balance-scale"></i>
          <p>
            Neraca
          </p>
        </a>
      </li>
      @endcan

      @can('view_owner')
      <li class="nav-item">
        <a href="{{ route('owner.index') }}" class="nav-link {{ \Route::is('owner.index') ? 'active' : '' }}">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('owner.transaksi') }}" class="nav-link {{ \Route::is('owner.transaksi') ? 'active' : '' }}">
          <i class="nav-icon fas fa-handshake"></i>
          <p>
            Riwayat Transaksi
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('owner.jurnal') }}" class="nav-link {{ \Route::is('owner.jurnal') ? 'active' : '' }}">
          <i class="nav-icon fas fa-window-restore"></i>
          <p>
            Jurnal
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('owner.buku-besar') }}" class="nav-link {{ \Route::is('owner.buku-besar') ? 'active' : '' }}">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Buku Besar
          </p>
        </a>
      </li>
      <li class="nav-header">Laporan</li>
      <li class="nav-item">
        <a href="{{ route('owner.laba-rugi') }}" class="nav-link {{ \Route::is('owner.laba-rugi') ? 'active' : '' }}">
          <i class="nav-icon fas fa-percentage"></i>
          <p>
            Laba Rugi
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('owner.perubahan-modal') }}" class="nav-link {{ \Route::is('owner.perubahan-modal') ? 'active' : '' }}">
          <i class="nav-icon fas fa-sync-alt"></i>
          <p>
            Perubahan Modal
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('owner.arus-kas') }}" class="nav-link {{ \Route::is('owner.arus-kas') ? 'active' : '' }}">
          <i class="nav-icon fas fa-money-bill"></i>
          <p>
            Arus Kas
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('owner.neraca-keuangan') }}" class="nav-link {{ \Route::is('owner.neraca-keuangan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-balance-scale"></i>
          <p>
            Neraca Keuangan
          </p>
        </a>
      </li>
      @endcan

    </ul>
  </nav>