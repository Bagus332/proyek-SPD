<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset('logokesbang.jpg') }}" alt="{{ config('app.name') }}" width="50">
            <span class="app-brand-text demo text-black fw-bolder ms-2" style="font-size: 20px;">
                {{ config('app.name') }}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Beranda">Beranda</div>
            </a>
        </li>
        
        <!-- Header untuk user biasa -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Utama</span>
        </li>

        <!-- Perjalanan Dinas -->
        <li class="menu-item {{ Route::is('travel.letter.index') ? 'active' : '' }}">
            <a href="{{ route('travel.letter.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-car"></i>
                <div>Perjalanan Dinas</div>
            </a>
        </li>


        <!-- Buku Agenda -->
        <li class="menu-item {{ request()->routeIs('pengajuan.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-edit"></i>
                <div>Buku Agenda</div>
            </a>
            <ul class="menu-sub">
                <!-- Sub-menu bisa ditambahkan di sini -->
            </ul>
        </li>

        <!-- Other Menu -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Lainnya</span>
        </li>
        
    </ul>
</aside>
