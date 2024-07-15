<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>
                    <li>
                        <a href="/dashboard">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Beranda</span>
                        </a>
                    </li>

                    @if (Auth::user()->role_id == 1)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-authentication">Laporan</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/laporan-penjualan" data-key="t-login">Penjualan</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-authentication">Master</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/category" data-key="t-login">Kategori</a></li>
                                <li><a href="/supplier" data-key="t-login">Supplier</a></li>
                                <li><a href="/product" data-key="t-register">Barang</a></li>
                                <li><a href="/user" data-key="t-recover-password">User</a></li>
                            </ul>
                        </li>
                    @endif

                    <li>
                        <a href="/stok">
                            <i data-feather="layout"></i>
                            <span data-key="t-horizontal">Stok Barang</span>
                        </a>
                    </li>

                    <li>
                        <a href="/transaction">
                            <i data-feather="layout"></i>
                            <span data-key="t-horizontal">Kasir</span>
                        </a>
                    </li>

                    <li>
                        <a href="/profil">
                            <i data-feather="layout"></i>
                            <span data-key="t-horizontal">User</span>
                        </a>
                    </li>
                    
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>