<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.admin_dashboards.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">Client Pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Client</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_owners.index') }}">Owners</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_animals.index') }}">Animals</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item nav-category">Staff Pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#veterinary" aria-expanded="false"
                aria-controls="veterinary">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Veterinary</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="veterinary">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.admin_veterinaries.index') }}">Records</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Services Pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#services" aria-expanded="false"
                aria-controls="services">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Services</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="services">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.admin_services.index') }}">Records</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Admin Branch</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#loc" aria-expanded="false" aria-controls="loc">
                <i class="menu-icon mdi mdi-office-building"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="loc">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.admin_branchs.index') }}">Locations
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user_branches.index') }}">Profile
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Payament</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="payment">
                <i class="menu-icon mdi mdi-account-card-details"></i>
                <span class="menu-title">Gcash</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="payment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.payments.index') }}">Records
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Settings</li>
        <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>