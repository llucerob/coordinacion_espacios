<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logom.png') }}" alt="">
                <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="#"><img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>

                    

                    <li class="sidebar-list pt-4 mt-2">
                        <a class="sidebar-link sidebar-title mt-3 {{ request()->routeIs('actividades.index') ? 'active' : '' }}" href="{{ route('actividades.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <span>Todas las Reservas</span>
                        </a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Actividades</h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs('actividad.*') ? 'active' : '' }}" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-to-do') }}"></use>
                            </svg>
                            <span>Agendar Actividad</span>
                        </a>
                        <ul class="sidebar-submenu" @if(request()->routeIs('actividad.*')) style="display: block;" @else style="display: none;" @endif>
                            <li><a class="{{ request()->routeIs('actividad.agendar') ? 'active' : '' }}" href="{{ route('actividad.agendar') }}">Agendamiento</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>RECINTOS</h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs('recinto*') || request()->routeIs('recintos*') ? 'active' : '' }}" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-table') }}"></use>
                            </svg>
                            <span>Recintos</span>
                        </a>
                        <ul class="sidebar-submenu" @if(request()->routeIs('recinto*') || request()->routeIs('recintos*')) style="display: block;" @else style="display: none;" @endif>
                            <li><a class="{{ request()->routeIs('recinto.create') ? 'active' : '' }}" href="{{ route('recinto.create') }}">Crear Recinto</a></li>
                            <li><a class="{{ request()->routeIs('recintos.index') ? 'active' : '' }}" href="{{ route('recintos.index') }}">Listar Recintos</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs('material*') || request()->routeIs('materiales*') ? 'active' : '' }}" href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-project') }}"></use>
                            </svg>
                            <span>Materiales</span>
                        </a>
                        <ul class="sidebar-submenu" @if(request()->routeIs('material*') || request()->routeIs('materiales*')) style="display: block;" @else style="display: none;" @endif>
                            <li><a class="{{ request()->routeIs('material.create') ? 'active' : '' }}" href="{{ route('material.create') }}">Crear Materiales</a></li>
                            <li><a class="{{ request()->routeIs('materiales.index') ? 'active' : '' }}" href="{{ route('materiales.index') }}">Listar Materiales</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>

    
