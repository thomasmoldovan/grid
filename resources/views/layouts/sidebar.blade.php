<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? "active" : "collapsed" }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('category/*') || request()->is('store/*') ? "active" : "collapsed" }}"
                href="backend/#" data-bs-target="#stores-nav" data-bs-toggle="collapse"
                {{ request()->is('category/*') || request()->is('locations/*') || request()->is('store/*') ? "aria-expanded=true" : "aria-expanded=false" }}>
                <i class="bi bi-menu-button-wide"></i><span>Stores</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="stores-nav" data-bs-parent="#sidebar-nav"
                class="nav-content collapse {{ request()->is('category/*') || request()->is('store/*') || request()->is('locations/*') ? "show active" : "" }}" >
                <li>
                    <a href="{{ route('all_categories') }}" class="{{ request()->is('category/*') ? "active" : "" }}">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('all_locations') }}" class="{{ request()->is('locations/*') ? "active" : "" }}">
                        <i class="bi bi-circle"></i><span>Locations</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('all_stores') }}" class="{{ request()->is('store/*') ? "active" : "" }}">
                        <i class="bi bi-circle"></i><span>Stores</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('all_products') }}" class="nav-link {{ request()->is('product/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Products</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('all_orders') }}" class="nav-link {{ request()->is('orders/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Orders</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Translations</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Blog</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>FAQs</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Settings</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings/*') ? "" : "collapsed" }}">
                <i class="bi bi-grid"></i>
                <span>Maintenance</span>
            </a>
        </li> --}}

    </ul>
</aside>
