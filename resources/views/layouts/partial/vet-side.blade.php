<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('veterinary.vet_dashboards.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- Medical Records --}}
        <li class="nav-item nav-category">Procedures</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('veterinary.medicals.index') }}">Records</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Payment</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="payment">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="payment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('veterinary.subcription') }}">Records</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Comsumptions</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#pharmacy" aria-expanded="false"
                aria-controls="pharmacy">
                <i class="menu-icon mdi mdi-pharmacy"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pharmacy">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('veterinary.vet_consumptions.index') }}">Consumption
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('veterinary.medecine_inventories.index')
                            }}">Inventory
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>