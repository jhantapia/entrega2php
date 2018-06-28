<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MANTENEDOR BIBLIOTECA | @yield('content-title')</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="/assets/load/load.css">
    <link rel="stylesheet" href="/assets/custom.css">
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    {{--<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">--}}

    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">

@yield('styles')

<!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/assets/toastr/toastr.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
    <!-- sweet alert css-->
    <link rel="stylesheet" href="/assets/sweet-alert/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/custom.css">

</head>

<body class="hold-transition skin-black-light sidebar-mini">
<div class="loading" id="loading">
    <div class="load-box">
        <div class="spinner"></div>
        <div class="pulsate" style="color: white;">Espere un momento por favor...</div>
    </div>
</div>

<div class="wrapper">

    @include('layout.header')

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Storage::url(Auth::user()->avatar)}}" class="img-circle">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->firstname }}</p>
                    <!--a href="javascript.void(0);"><i class="fa fa-circle text-success"></i> Conectado</a-->
                </div>
            </div>

            <ul class="sidebar-menu" data-widget="tree" data-api="tree" data-accordion=0>
                <li class="header">MENÚ PRINCIPAL</li>
                <li {{ (Request::is('dashboard') ? 'class=active' : '') }} >
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-th"></i> <span>Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->load('role')->role->name == 'Administrador')
                    @include('layout.sidebars.admin-sidebar')
                @elseif(Auth::user()->load('role')->role->name == 'Validador')
                    @include('layout.sidebars.cajero-sidebar')
                @elseif(Auth::user()->load('role')->role->name == 'Constructor')
                    @include('layout.sidebars.cliente-sidebar')
                @endif

                <li class="header">MENÚ USUARIO</li>
                <li {{ (Request::is('profile') ? 'class=active' : '') }} >
                    <a href="{{ route('profile') }}">
                        <i class="fa fa-user"></i> <span>Mi Perfil</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="document.getElementById('form-logout').submit();">
                        <i class="fa fa-sign-out text-danger"></i> <span>Cerrar Sesión</span>
                    </a>
                    <form id="form-logout"  method="post" action="{{ route('logout') }}">
                        {{ csrf_field() }}
                    </form>

                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                @yield('content-title', 'Nueva Página')
                <small> @yield('content-subtitle', 'Nueva Página')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                @yield('breadcrumb')
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('template._errors')
                    @include('template._success')
                </div>
            </div>
            @yield('content')


        </section>

    </div>


    @include('layout.footer')

    <aside class="control-sidebar control-sidebar-dark">

        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab" class="active"><i class="fa fa-question"></i></a>
            </li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>

            <div class="tab-pane active" id="control-sidebar-settings-tab">
                <div class="row">
                    <div class="col-md-12">
                        <span>Zoom&nbsp; &nbsp;</span>
                        <div class="btn-group">
                            <button type="button" onclick="zoomOut()" class="btn btn-default"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" onclick="resetZoom()" class="btn btn-default">100%</button>
                            <button type="button" onclick="zoomIn()" class="btn btn-default"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>


<!-- jQuery 3 -->

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="/assets/toastr/toastr.min.js"></script>
<!-- sweet alert -->
<script src="/assets/sweet-alert/sweetalert2.min.js"></script>

<script>

    //toast configuracióón global
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // mostrar mensaje de exito
    function showToastSuccess(message, title) {
        toastr.success(message, title ? title : 'Operación Éxitosa');
    }

    // mostrar mensaje de error
    function showToastError(message, title) {
        toastr.error(message, title ? title : 'Error!');
    }

    // mostrar info de error
    function showToastInfo(message, title) {
        toastr.info(message, title ? title : 'Información!');
    }

    // mostrar warning de error
    function showToastWarning(message, title) {
        toastr.warning(message, title ? title : 'Advertencia!');
    }
</script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>

@yield('scripts')

<script>
    //loading
    $(document).ready(function () {
        $('#loading').hide()
    });

    function showLoading() {
        $('#loading').show()
    }

    function hideLoading() {
        $('#loading').hide()
    }

    //lock and unlock submit
    function lockSubmit() {
        $(":submit").attr("disabled", true);
    }

    function unlockSubmit() {
        $(":submit").attr("disabled", false);
    }

    // zoom letra

    var zoom = 100;

    function zoomIn() {
        zoom += 10;
        document.body.style.zoom = zoom + "%";
    }

    // funcion para disminuir la fuente
    function zoomOut() {
        zoom -= 10;
        document.body.style.zoom = zoom + "%";
    }

    function resetZoom() {
        zoom = 100;
        document.body.style.zoom = zoom + "%";
    }

    function string_to_slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to = "aaaaeeeeiiiioooouuuunc------";
        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }

</script>
</body>
</html>
