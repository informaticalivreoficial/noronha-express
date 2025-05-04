<aside class="main-sidebar sidebar-light-teal elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="">
        <img src="{{$config->getlogo()}}" alt="{{$config->app_name}}"
            class="brand-image elevation-3">        
    </a>

    <div class="sidebar mt-3">
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
                    <a href="{{route('settings',['config' => '1'])}}" class="nav-link"><i class="nav-icon fas fa-cog"></i> 
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
                            <span class="badge badge-info right">{{$tripCount}}</span>
                        </p>
                    </a>
                </li>     
                <li class="nav-item">
                    <a href="{{route('manifests.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Manifestos <span class="badge badge-info right">{{$manifestCount}}</span>                            
                        </p>                        
                    </a>                    
                </li>     
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p> Relatórios <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Relatório de Viagens</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manifestReport.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Relatório de Manifestos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Relatório de Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('companyReport.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Relatório de Empresas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p> Financeiro <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Faturas</p>
                            </a>
                        </li>                        
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
