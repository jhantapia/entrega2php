@extends('template.base')

@section('content-title', 'Gestión de Usuarios')

@section('content-subtitle', 'Panel de Usuarios')

@section('breadcrumb')
    <li class="active">Gestión de Usuarios</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12" id="messages"></div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="toolbar" class="btn-group">
                        <button data-toggle="modal" data-target="#modal-create" class="btn btn-success"><i
                                    class="fa fa-plus"></i> Nuevo Usuario
                        </button>
                    </div>
                    <table
                            id="table"
                            data-toggle="table"
                            data-search="true"
                            data-ajax="ajaxRequest"
                            data-pagination="true"
                            data-striped="true"
                            data-show-refresh="true"
                            data-show-toggle="true"
                            data-show-columns="true"
                            data-show-export="true"
                            data-detail-view="true"
                            data-detail-formatter="detailFormatter"
                            data-minimum-count-columns="2"
                            data-show-pagination-switch="true"
                            data-id-field="id"
                            data-page-list="[5, 10, 20, 50, 100, 200]"
                            data-toolbar="#toolbar"
                           >
                        <thead>
                        <tr>
                            <th data-field="status" data-checkbox="true"></th>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="firstname" data-cell-style="cellStyle" data-sortable="true">Nombre</th>
                            <th data-field="lastname" data-sortable="true">A. Paterno</th>
                            <th data-field="second_lastname" data-sortable="true">A. Materno</th>
                            <th data-field="role.name" data-sortable="true">Rol</th>
                            <th data-field="created_at" data-cell-style="cellStyle" data-align="center" data-sortable="true" data-formatter="dateFormat" >Creado</th>
                            <th data-field="updated_at" data-cell-style="cellStyle" data-align="center" data-sortable="true" data-formatter="dateFormat" data-sorteable="true" >Modificado</th>
                            <th data-field="active" data-switchable="false" data-formatter="operateFormatterActive"  data-show-columns="false"></th>
                            <th data-field="controls" data-cell-style="cellStyle" data-switchable="false" data-formatter="operateFormatterControls" data-show-columns="false"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--modal create-->
    <div class="modal fade in" id="modal-create">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="dissmisModal('#form-create','#modal-create')"  aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Nuevo Usuario </h4> <span>(*) Campos obligatorios</span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="class-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group col-md-12" id="group-error-avatar-create">
                                            <label for="avatar">Avatar</label>
                                            <div class="image-avatar">
                                                <img id="image-avatar" src="{{ Storage::url('avatars/user-default.png') }}">
                                            </div>
                                            <input type="file" name="avatar" id="file"
                                                   class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
                                            <label for="file">Seleccione un avatar</label>
                                            <span class="help-block" id="label-error-avatar-create"></span>
                                            <div class="link-del" onclick="deleteAvatarCreate();"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group col-md-6" id="group-error-role-create">
                                            <label for="role_id">Rol del Usuario</label>
                                            <select class="form-control" onchange="removeErrors();" id="role_id" name="role_id">
                                                <option selected disabled value="">Seleccione</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" >{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block" id="label-error-role-create"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="name" class="control-label">Nombre</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                   placeholder="Nombre" value="" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastname" class="control-label">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname"
                                                   placeholder="Apellido Paterno">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="second_lastname" class="control-label">Apellido Materno</label>
                                            <input type="text" class="form-control" id="second_lastname" name="second_lastname"
                                                   placeholder="Apellido Materno">
                                        </div>
                                        <div class="form-group col-md-6" id="group-error-email-create">
                                            <label for="email" class="control-label">Email (*)</label>
                                            <input type="email" class="form-control" onchange="removeErrors();" id="email" name="email" placeholder="Email">
                                            <span class="help-block" id="label-error-email-create"></span>
                                        </div>
                                        <div class="form-group col-md-6" id="group-error-password-create">
                                            <label for="password" class="control-label">Password (*)</label>
                                            <div class="input-group">
                                                <input id="password" type="text" onchange="removeErrors();" class="form-control" id="password" name="password"
                                                       placeholder="Password" >
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary btn-flat" type="button"
                                                            onclick="generatePassword()">
                                                        <i class="fa fa-key"></i> Generar
                                                    </button>
                                                </div>
                                            </div>
                                            <span class="help-block" id="label-error-password-create"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="dissmisModal('#form-create','#modal-create')" class="btn btn-danger pull-left">Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--modal edit-->
    <div class="modal fade in" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-edit" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="dissmisModal('#form-edit','#modal-edit')" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Usuario </h4> <span>(*) Campos obligatorios</span>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="class-md-12">
                               <div class="row">
                                   <div class="col-md-3">
                                       <div class="form-group col-md-12" id="group-error-avatar-edit">
                                           <label for="avatar">Avatar</label>
                                           <div class="image-avatar">
                                               <img id="image-avatar-edit" src="{{ Storage::url('avatars/user-default.png') }}">
                                           </div>
                                           <input id="file-edit" type="file" name="avatar"
                                                  class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
                                           <label for="file-edit">Seleccione un avatar</label>
                                           <span class="help-block" id="label-error-avatar-edit"></span>
                                           <div class="link-del" onclick="deleteAvatarEdit();"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-9">
                                       <div class="form-group col-md-6" id="group-error-role-edit">
                                           <label for="role_id">Rol del Usuario</label>
                                           <select class="form-control" onchange="removeErrors();" id="role_id" name="role_id">
                                               <option selected disabled value="">Seleccione</option>
                                               @foreach($roles as $role)
                                                   <option value="{{$role->id}}" >{{$role->name}}</option>
                                               @endforeach
                                           </select>
                                           <span class="help-block" id="label-error-role-edit"></span>
                                       </div>
                                       <div class="form-group col-md-12">
                                           <label for="name" class="control-label">Nombre</label>
                                           <input type="text" class="form-control" id="firstname" name="firstname"
                                                  placeholder="Nombre" value="" >
                                       </div>
                                       <div class="form-group col-md-6">
                                           <label for="lastname" class="control-label">Apellido Paterno</label>
                                           <input type="text" class="form-control" id="lastname" name="lastname"
                                                  placeholder="Apellido Paterno">
                                       </div>
                                       <div class="form-group col-md-6">
                                           <label for="second_lastname" class="control-label">Apellido Materno</label>
                                           <input type="text" class="form-control" id="second_lastname" name="second_lastname"
                                                  placeholder="Apellido Materno">
                                       </div>
                                       <div class="form-group col-md-6" id="group-error-email-edit">
                                           <label for="email" class="control-label">Email (*)</label>
                                           <input type="email" onchange="removeErrors();" class="form-control" id="email" name="email" placeholder="Email">
                                           <span class="help-block" id="label-error-email-edit"></span>
                                       </div>
                                       {{--<div class="form-group col-md-6" id="group-error-password-edit">--}}
                                       {{--<label for="password" class="control-label">Password (*)</label>--}}
                                       {{--<div class="input-group">--}}
                                       {{--<input id="password" type="text" class="form-control" id="password" name="password"--}}
                                       {{--placeholder="Password" >--}}
                                       {{--<div class="input-group-btn">--}}
                                       {{--<button class="btn btn-primary btn-flat" type="button"--}}
                                       {{--onclick="generatePassword()">--}}
                                       {{--<i class="fa fa-key"></i> Generar--}}
                                       {{--</button>--}}
                                       {{--</div>--}}
                                       {{--</div>--}}
                                       {{--<span class="help-block" id="label-error-password-edit"></span>--}}
                                       {{--</div>--}}
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="dissmisModal('#form-edit','#modal-edit')" class="btn btn-danger pull-left">Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('styles')

    <link rel="stylesheet" href="/assets/bootstraptable/dragtable.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table-reorder-rows.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table-fixed-columns.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table.min.css">

@endsection

@section('scripts')
    <script src="/assets/bootstraptable/bootstrap-table.min.js"></script>
    <script src="/assets/bootstraptable/bootstrap-table-es-ES.min.js"></script>
    <script src="/assets/bootstraptable/bootstrap-table-export.min.js"></script>
    <script src="/assets/bootstraptable/tableExport.min.js"></script>
    <script src="/assets/required/app.js"></script>

    <script>

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-avatar').attr('src', e.target.result);
                    $('#image-avatar').height($('#image-avatar').width());
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLEdit(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-avatar-edit').attr('src', e.target.result);
                    $('#image-avatar-edit').height($('#image-avatar-edit').width());
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file").change(function () {
            readURL(this);
        });

        $('#form-edit').find('#file-edit').change(function () {
            readURLEdit(this);
        });

        function deleteAvatarCreate() {
            $('#modal-create #image-avatar').attr('src', '{{ Storage::url('avatars/user-default.png') }}');
            $('.link-del').html('');
            $("#modal-create #file").val('');
        }

        function deleteAvatarEdit() {
            $('#modal-edit #image-avatar-edit').attr('src', '{{ Storage::url('avatars/user-default.png') }}');
            $('.link-del').html('');
            $("#modal-edit #file").val('');
        }
    </script>


    <script>

        config.csrf_token = "{{ csrf_token() }}";

        config.urlGetAll = "{{ route('management.users.all') }}";
        config.urlStore = " {{ route('management.users.store') }}";
        config.urlUpdate = " {{ route('management.users.update') }}";
        config.urlDestroy = " {{ route('management.users.destroy') }}";
        config.urlChangeStatus = " {{ route('management.users.change-status') }}";

        config.rowTitles = [

            {id: 'id', name: 'Id'},
            {id: 'firstname', name: 'Nombre'},
            {id: 'lastname', name: 'Apellido Paterno'},
            {id: 'second_lastname', name: 'Apellido Materno'},
            {id: 'role.name', name: 'Rol'},
            {id: 'created_at', name: 'Creado'},
            {id: 'updated_at', name: 'Modificado'},
            {id: 'active', name: 'Estado'}
        ];

        config.errorsCreateValidate = [
            {name: 'avatar',   group: '#group-error-avatar-create',   label : '#label-error-avatar-create'},
            {name: 'email' ,   group: '#group-error-email-create',    label : '#label-error-email-create'},
            {name: 'password', group: '#group-error-password-create', label : '#label-error-password-create'},
            {name: 'role_id',  group: '#group-error-role-create',     label : '#label-error-role-create'}
        ];

        config.errorsEditValidate = [
            {name: 'avatar',   group: '#group-error-avatar-edit',   label : '#label-error-avatar-edit'},
            {name: 'email' ,   group: '#group-error-email-edit',    label : '#label-error-email-edit'},
            {name: 'role_id',  group: '#group-error-role-edit',     label : '#label-error-role-edit'}
        ];

        function showDataToEdit(rowId){

            var item = items.filter(item => item.id === rowId)[0];

            showModal('#modal-edit');

            $('#form-edit').find('#id').val(item.id);
            $('#form-edit').find('#firstname').val(item.firstname);
            $('#form-edit').find('#lastname').val(item.lastname);
            $('#form-edit').find('#second_lastname').val(item.second_lastname);
            $('#form-edit').find('#role_id').val(item.role_id);
            $('#form-edit').find('#email').val(item.email);
            $('#form-edit').find('#image-avatar-edit').attr('src',item.avatar.replace("public/", "storage/"));

        }

        function hideModal(modal){
            $(modal).modal('hide');
            removeErrors();
        }

        function removeErrors() {
            $('#label-error-role-create').html('');
            $('#label-error-email-create').html('');
            $('#label-error-password-create').html('');
            $('#group-error-role-create').removeClass('has-error');
            $('#group-error-email-create').removeClass('has-error');
            $('#group-error-password-create').removeClass('has-error');
            $('#label-error-role-edit').html('');
            $('#label-error-email-edit').html('');
            $('#label-error-password-edit').html('');
            $('#group-error-role-edit').removeClass('has-error');
            $('#group-error-email-edit').removeClass('has-error');
            $('#group-error-password-edit').removeClass('has-error');
        }

    </script>

@endsection
