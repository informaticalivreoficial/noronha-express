<aside class="main-sidebar sidebar-light-teal elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.youtube.com/@RonaldCodes23" target="_blank" class="brand-link">
        <img src="" alt="RonaldCodes Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        {{-- <a href="https://www.youtube.com/@RonaldCodes23" target="_blank"><img
                src="{{ asset('assets/images/RonaldCodesLogo.png') }}" alt="Ronald Codes Logo"
                class="brand-image img-circle elevation-3 rounded-circle cursor-pointer" style="width: 50px" />
        </a> --}}

        <span class="brand-text font-weight-light">Laravel AdminLTE v3</span>
    </a>

    <div class="sidebar">
        {{-- Sidebar user panel (optional)  --}}
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/bms_logo.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{route('admin')}}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Painel de Controle</p>
                    </a>                    
                </li>

                <li class="nav-item">
                    <a href="{{route('settings')}}" class="nav-link"><i class="nav-icon fas fa-cog"></i> 
                        <p> Configurações</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('clientes.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Clientes <span class="badge badge-info right">{{$userCount}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('companies.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-industry"></i>

                        <p>
                            Empresas
                            <span class="badge badge-info right">{{$companyCount}}</span>
                        </p>
                    </a>
                </li>     
                <li class="nav-item">
                    <a href="{{route('trips.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-ship"></i>

                        <p>
                            Viagens
                            <span class="badge badge-info right">{{$companyCount}}</span>
                        </p>
                    </a>
                </li>     

            </ul>
        </nav>
    </div>
</aside>
