<!--app-header-->
<div class="app-header header d-flex navbar-collapse">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ url('/') }}">
                {{-- <img src="{{ mix('images/logo.png') }}" class="header-brand-img main-logo" alt="logo"> --}}Amigo oculto
            </a><!-- logo-->
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle"  href="#"><i class="fe fe-align-left"></i></a>
                <a class="close-toggle"  href="#"><i class="fe fe-x"></i></a>
            </div>
            <div class="d-flex order-lg-2 ml-auto header-right">
                @guest
                    
                @else
                    <div class="dropdown d-md-flex header-message">
                        <a class="nav-link icon" id="total-notifications" data-toggle="dropdown">
                            <i class="far fa-bell"></i>
                            <span class="nav-unread badge badge-danger badge-pill">0</span>
                        </a>
                        <input type="text"  id="ids-notifications" value="" hidden>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item text-center" href="">Notificações</a>
                            <div class="dropdown-divider"></div>
                            <div id="notifications-user">
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center dropdown-btn pb-3">
                                <div class="btn-list">
                                    <a href="" class=" btn btn-success btn-sm"><i class="fe fe-eye mr-1"></i>Visualizar todas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Navbar -->
                    <div class="dropdown header-profile">
                        <a class="nav-link pr-0 leading-none d-flex pt-1" data-toggle="dropdown" href="#">
                            <span class="avatar avatar-md brround cover-image" data-image-src="{{ auth()->user()->image != null ? Route('index').'/'.'images/'.auth()->user()->image : mix('images/user.png') }}"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <div class="drop-heading">
                                <div class="text-center">
                                    <h5 class="text-dark mb-1">{{ Auth::user()->name }}</h5>
                                    <small class="text-muted"></small>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item" href="{{route('user-edit')}}"><i class="dropdown-icon fe fe-user"></i>Perfil</a>
                            <a class="dropdown-item" href=""><i class="dropdown-icon fe fe-mail"></i> Notificações</a>
                            <form action="{{ route('logout') }}" method="post" class="form-not-global">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="dropdown-icon fe fe-power"></i> Sair</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>