<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="/images/user-default.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Username</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        </div>
    </div>
{{--<!-- search form -->--}}
{{--<form action="#" method="get" class="sidebar-form">--}}
{{--<div class="input-group">--}}
{{--<input type="text" name="q" class="form-control" placeholder="Buscar...">--}}
{{--<span class="input-group-btn">--}}
{{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
{{--</button>--}}
{{--</span>--}}
{{--</div>--}}
{{--</form>--}}
<!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" data-api="tree" data-accordion=0>
        <li class="header">MENÚ PRINCIPAL</li>
        <li {{ (Request::is('dashboard') ? 'class=active' : '') }} >
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li {{ (Request::is('profile') ? 'class=active' : '') }} >
            <a href="{{ route('profile') }}">
                <i class="fa fa-user"></i> <span>Mi Perfil</span>
            </a>
        </li>
        <li {{ (Request::is('users') ? 'class=active' : '') }} >
            <a href="{{ route('users') }}">
                <i class="fa fa-users"></i> <span>Gestión de Usuarios</span>
            </a>
        </li>

        <li class="treeview {{ (Request::is('config/*') ? 'active' : '') }}">
            <a href="{{ route('config') }}">
                <i class="fa fa-gears"></i> <span>Configuración</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">

            </ul>
        </li>
    </ul>
</section>
