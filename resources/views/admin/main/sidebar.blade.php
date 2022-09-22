<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"
                class="nav-link {{ Route::is('categories.all') || Route::is('stores.all') || Route::is('locations.all') ? "active" : "collapsed" }}"
                {{ Route::is('categories.all') || Route::is('stores.all') || Route::is('locations.all') ? "class='nav-link active' aria-expanded=true" : "class='nav-link collapsed' aria-expanded=false" }}>

                <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" data-bs-parent="#sidebar-nav"
            class="nav-content {{ Route::is('categories.all') || Route::is('stores.all') || Route::is('locations.all') ? "show active" : "collapse" }}">
                <li>
                    <a href="{{ route('categories.all') }}" class="{{ Route::is('categories.all') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('stores.all') }}" class="{{ Route::is('stores.all') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Stores</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('locations.all') }}" class="{{ Route::is('locations.all') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Locations</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('products.all') }}">
                <i class="bi bi-file-earmark"></i>
                <span>Products</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li>

    </ul>

</aside>
