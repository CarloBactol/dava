<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#appointent" aria-expanded="false"
                aria-controls="appointent">
                <i class="menu-icon mdi mdi-calendar-text"></i>
                <span class="menu-title">Appointments</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="appointent">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user_appoitments.index') }}">User
                            Appoitments
                        </a>
                    </li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.payments.index') }}">Users
                            Subscibed
                        </a>
                    </li> --}}
                </ul>
            </div>
        </li>



        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.new_registere_controllers.index') }}">New
                            Registered</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_owners.index') }}">Owners</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_animals.index') }}">Animals</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#veterinary" aria-expanded="false"
                aria-controls="veterinary">
                <i class="menu-icon mdi mdi-account-check"></i>
                <span class="menu-title">Veterinarian</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="veterinary">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.admin_veterinaries.index') }}">Veterinaries</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.vet_specializes.index') }}">Specialized</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#services" aria-expanded="false"
                aria-controls="services">
                <i class="menu-icon mdi mdi-paw"></i>
                <span class="menu-title">Services</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="services">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.admin_services.index') }}">Services</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#loc" aria-expanded="false" aria-controls="loc">
                <i class="menu-icon mdi mdi-map-marker-radius"></i>
                <span class="menu-title">Districts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="loc">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.admin_branchs.index') }}">Mappings
                        </a>
                    </li>
                    @if (Auth::user()->role == "super_admin")

                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user_branches.index') }}">Employees
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="payment">
                <i class="menu-icon mdi mdi-heart-pulse"></i>
                <span class="menu-title">Medical Records</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="payment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.medicals.index') }}">Medicals
                            Records</a>
                    </li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('admin.payments.index') }}">Users
                            Subscibed
                        </a>
                    </li> --}}
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.admin_dashboards.index') }}">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

    </ul>
</nav>