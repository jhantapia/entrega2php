@extends('template.base')

@section('content-title', 'Perfil')

@section('content-subtitle', 'Username')

@section('breadcrumb')
    <li><a href="{{ route('profile') }}">Perfil</a></li>
    <li class="active">username</a></li>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">DATOS PERSONALES</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="avatar" class="col-md-3 control-label">Avatar</label>
                            <div class="col-md-9">
                                <div class="image-avatar">
                                    <img id="image-avatar" src="{{ Storage::url(Auth::user()->avatar) }}">
                                </div>
                                <input type="file" name="avatar" onchange="loadAvatar();" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg" style="width: 147px;" />
                                <label style="width: 147px;"  for="file">Seleccione un avatar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="firstname" value="{{Auth::user()->firstname}}" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Apellido Paterno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{Auth::user()->lastname}}" name="lastname" placeholder="Apellido Paterno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="second_lastname" class="col-md-3 control-label">Apellido Materno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{Auth::user()->second_lastname}}" name="second_lastname" placeholder="Apellido Materno">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" value="{{Auth::user()->email}}" name="email" placeholder="Email">

                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary btn-flat">Actualizar Datos</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{Storage::url(Auth::user()->avatar)}}"
                                 alt="User profile picture">

                            <h3 class="profile-username text-center">{{ Auth::user()->firstname . ' ' .Auth::user()->lastname}}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->role->name }}</p>
                            <p class="text-muted text-center">Último Acceso : {{ Auth::user()->last_login_date ? (new DateTime(Auth::user()->last_login_date))->format('d-m-Y H:i:s') : 'nunca' }}</p>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="box box-primary">--}}
                        {{--<div class="box-header with-border">--}}
                            {{--<h3 class="box-title">CAMBIAR CONTRASEÑA</h3>--}}
                        {{--</div>--}}
                        {{--<div class="box-body">--}}
                            {{--<form method="POST" action="{{ route('change-password') }}">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input type="hidden" name="id" value="{{ Auth::user()->id }}">--}}
                                {{--<div class="form-group {{ $errors->has('actual') ? 'has-error':'' }}">--}}
                                    {{--<label for="actual" class="control-label">Contraseña Actual</label>--}}
                                    {{--<input type="password" required class="form-control" name="actual" placeholder="Contraseña Actual" value="{{ old('actual') }}">--}}
                                    {{--{!! $errors->first('actual', '<span class="help-block">:message</span>') !!}--}}
                                {{--</div>--}}

                                {{--<div class="form-group {{ $errors->has('password') ? 'has-error':'' }}">--}}
                                    {{--<label for="password" class="control-label">Nueva Contraseña</label>--}}
                                    {{--<input type="password" required class="form-control" name="password" placeholder="Nueva Contraseña" {{ old('password')  }}>--}}
                                    {{--{!! $errors->first('password', '<span class="help-block">:message</span>') !!}--}}
                                {{--</div>--}}
                                {{--<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error':'' }}">--}}
                                    {{--<label for="password_confirmation" class="control-label">Repita Nueva Contraseña</label>--}}
                                    {{--<input type="password" required class="form-control" name="password_confirmation" placeholder="Repita Nueva Contraseña" {{ old('password_confirmation')  }}>--}}
                                    {{--{!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<button type="submit" class="btn btn-primary btn-flat">Cambiar Contraseña</button>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>



    </div>


@endsection

@section('styles')
    <style>
        .image-avatar{
            width: 147px;
            border: 1px solid #c5c5c5;
            padding: 5px;
            margin-bottom: 10px;
        }
        .image-avatar img{
            display: block;
            width: 135px;
            height: 135px;
            object-fit: cover;
        }
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .inputfile + label {
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: #3c8dbc;
            border-color: #367fa9;
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
        }

        .inputfile:focus + label,
        .inputfile + label:hover {
            background-color: #204d74;
            border-color: #122b40;
        }
    </style>
@endsection

@section('scripts')
    <script src="/assets/required/app.js"></script>
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file").change(function(){
            readURL(this);
        });


        function hideModal(modal){
            $(modal).modal('hide');
            removeErrors();
        }

        function removeErrors() {
            $('#label-error-role-create').html('');
            $('#label-error-name-edit').html('');
            $('#group-error-role-create').removeClass('has-error');
            $('#group-error-role-edit').removeClass('has-error');
        }

    </script>



@endsection
