<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('LogoLsp.png') }}" alt="{{ config('app.name') }}" width="155">
            {{-- <span class="app-brand-text demo text-black fw-bolder ms-2">{{ config('app.name') }}</span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Home -->
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="{{ __('menu.home') }}">{{ __('menu.home') }}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('Menu SOP') }}</span>
        </li>
        <li
            class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Sertifikasi_TI*','Output.Sertifikasi_TI*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='bx bx-book-bookmark'></i>
                <div data-i18n="{{ __('menu.SOP.menu') }}">{{ __('Sertifikasi Dan TI') }}</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Sertifikasi_TI.index*') ? 'active open' : '' }}">
                    <a href="{{ route('SOP.Sertifikasi_TI.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.SOP.menu') }}">{{ __('SOP') }}</div>
                    </a>
                    
                </li>
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('Output.Sertifikasi_TI.index*') ? 'active' : '' }}">
                    <a href="{{ route('Output.Sertifikasi_TI.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.transaction.Sertifikasi_TI') }}">{{ __('Output') }}</div>
                    </a>
                </li>

            </ul>
        </li>
        <li
            class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Administrasi_Keuangan*', 'Output.Administrasi_Keuangan*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='bx bx-book-bookmark'></i>
                <div data-i18n="{{ __('menu.SOP.menu') }}">{{ __('Adm Dan Keuangan') }}</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Administrasi_Keuangan.*') ? 'active' : '' }}">
                    <a href="{{ route('SOP.Administrasi_Keuangan.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.SOP.Administrasi_Keuangan') }}">{{ __('SOP') }}</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('Output.Administrasi_Keuangan*')  ? 'active' : '' }}">
                    <a href="{{ route('Output.Administrasi_Keuangan.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.transaction.Sertifikasi_TI') }}">{{ __('Output') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Manajemen_Mutu*', 'Output.Manajemen_Mutu*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='bx bx-book-bookmark'></i>
                <div data-i18n="{{ __('menu.SOP.menu') }}">{{ __('Manajemen Mutu') }}</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Manajemen_Mutu.*') ? 'active' : '' }}">
                    <a href="{{ route('SOP.Manajemen_Mutu.index') }}" class="menu-link">
                        <div data-i18n="{{ __('SOP.Manajemen_Mutu') }}">{{ __('SOP') }}</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('Output.Manajemen_Mutu.*') || \Illuminate\Support\Facades\Route::is('transaction.disposition.*') ? 'active' : '' }}">
                    <a href="{{ route('Output.Manajemen_Mutu.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.transaction.Sertifikasi_TI') }}">{{ __('Output') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Marketing*', 'Output.Marketing*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='bx bx-book-bookmark'></i>
                <div data-i18n="{{ __('menu.SOP.menu') }}">{{ __('Marketing') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('SOP.Marketing.*') ? 'active' : '' }}">
                    <a href="{{ route('SOP.Marketing.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.SOP.Marketing') }}">{{ __('SOP') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('Output.Marketing.*') ? 'active' : '' }}">
                    <a href="{{ route('Output.Marketing.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.Outpu.Marketing') }}">{{ __('Output') }}</div>
                    </a>
                </li>
            </ul>
        </li>

       @if(auth()->user()->role == 'admin')
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('reference.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-analyse"></i>
                <div data-i18n="{{ __('menu.reference.menu') }}">{{ __('menu.reference.menu') }}</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ \Illuminate\Support\Facades\Route::is('reference.classification.*') ? 'active' : '' }}">
                    <a href="{{ route('reference.classification.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.reference.classification') }}">{{ __('Klasifikasi SOP') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('reference.status.*') ? 'active' : '' }}">
                    <a href="{{ route('reference.status.index') }}" class="menu-link">
                        <div data-i18n="{{ __('menu.reference.status') }}">{{ __('status SOP') }}</div>
                    </a>
                </li>
            </ul>

           

            <!-- User Management -->
        <li class="menu-item {{ \Illuminate\Support\Facades\Route::is('user.*') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="{{ __('menu.users') }}">{{ __('menu.users') }}</div>
            </a>
        </li>

        @endif
    </ul>
</aside>