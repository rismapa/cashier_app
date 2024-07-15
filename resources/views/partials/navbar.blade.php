<div class="d-flex">
    <div class="dropdown d-none d-sm-inline-block">
        <button type="button" class="btn header-item" id="mode-setting-btn">
            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
        </button>
    </div>

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ auth()->user()->name }}</span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <form>
                @csrf
                <a href="/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
            </form>
            {{-- <a class="dropdown-item"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> 
                <form action="/logout" method="post">
                @csrf
                <button type="submit" class="">Logout</p>
              </form>
            </a> --}}
        </div>
    </div>
</div>