<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar toggle-sidebar">
    <ul class="side-menu toggle-menu">
        <li>
            <h3>Principal</h3>
        </li>
        <li>
            <a class="side-menu__item" href="{{ url('/') }}"><i class="side-menu__icon fas fa-users"></i><span
                    class="side-menu__label">Participantes</span></a>
        </li>
        @guest
            <li>
                <a class="side-menu__item" href="{{ route('login') }}"><i
                        class="side-menu__icon fas fa-lock-open"></i>{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li>
                    <a class="side-menu__item" href="{{ route('register') }}"><i
                        class="side-menu__icon fas fa-id-card"></i>{{ __('Criar novo participante') }}</a>
                </li>
            @endif
        @else
            <li>
                <a class="side-menu__item" href="{{ route('secretfriend-index') }}"><i class="side-menu__icon fas fa-user-secret"></i><span
                        class="side-menu__label">Amigo secreto</span></a>
            </li>
            @if (Auth::user()->id == 1)
                <li>
                    <a class="side-menu__item" href="{{ route('secretfriend-viewsortfriends') }}"><i class="side-menu__icon fa fa-heartbeat"></i><span
                            class="side-menu__label">Sortear</span></a>
                </li>
            @endif
        @endguest
    </ul>
</aside>
<!--sidemenu end-->
