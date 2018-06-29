@extends('template.base')

@section('content-title', 'Configuración')

@section('content-subtitle', 'Libros')

@section('breadcrumb')
    <li>Configuración</li>
    <li class="active">Libros</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12" id="messages"></div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="toolbar" class="btn-group">
                        <button data-toggle="modal" data-target="#modal-create" class="btn btn-success"><i
                                    class="fa fa-plus"></i> Nuevo Libro
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
                        data-minimum-count-columns="2"
                        data-show-pagination-switch="true"
                        data-id-field="id"
                        data-page-list="[5, 10, 20, 50, 100, 200]"
                        data-toolbar="#toolbar"
                    >
                        <thead>
                        <tr>
                            <!--th data-field="status" data-checkbox="true"></th-->
                            <th data-field="id" data-sortable="true">ISBN</th>
                            <th data-field="title" data-cell-style="cellStyle" data-sortable="true">Titulo</th>
                            <th data-field="pages" data-cell-style="cellStyle" data-sortable="true">Páginas</th>
                            <th data-field="description" data-sortable="true">Descripción</th>
                            <th data-field="author" data-sortable="true">Autor</th>
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
            <form method="post" id="form-create"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="dissmisModal('#form-create','#modal-create')"  aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><i class="fa fa-book"></i> Nuevo Libro</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="group-error-publisher_id-create" class="form-group">
                                    <label class="control-label " for="publisher_id">
                                        Editorial
                                    </label>
                                    <select class="form-control" onchange="removeErrors();" id="publisher_id" name="publisher_id">
                                        <option selected disabled value="">Seleccione</option>
                                        @foreach($publishers as $publisher)
                                            <option value="{{$publisher->id}}" >{{$publisher->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="group-error-author_id-create" class="form-group">
                                    <label class="control-label " for="author_id">
                                        Autor
                                    </label>
                                    <select class="form-control" onchange="removeErrors();" id="author_id" name="author_id">
                                        <option selected disabled value="">Seleccione</option>
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}" >{{$author->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="group-error-isbn-create" class="form-group">
                                    <label class="control-label " for="isbn">
                                        ISBN
                                    </label>
                                    <input class="form-control" type="text" id="isbn" name="isbn"
                                           placeholder="Ingrese un ISBN.">
                                    <span id="error-isbn-create" class="help-block"></span>
                                </div>
                                <div id="group-error-title-create" class="form-group">
                                    <label class="control-label " for="title">
                                        Título
                                    </label>
                                    <input class="form-control" type="text" id="title" name="title"
                                           placeholder="Ingrese un título.">
                                    <span id="error-title-create" class="help-block"></span>
                                </div>
                                <div id="group-error-pages-create" class="form-group">
                                    <label class="control-label " for="pages">
                                        Páginas
                                    </label>
                                    <input class="form-control" type="number" id="pages" name="pages"
                                           placeholder="Ingrese Páginas.">
                                    <span id="error-pages-create" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12" id="group-error-cover-create">
                                    <label for="cover">Caratula del Libro</label>
                                    <div class="image-cover">
                                        <img id="image-cover" class="img-thumbnail" height="370px" width="100%" src="{{ Storage::url('covers/cover-default.png') }}">
                                    </div>
                                    <input type="file" name="cover" id="file"
                                           class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
                                    <label for="file">Seleccione Caratula del Libro</label>
                                    <span class="help-block" id="label-error-cover-create"></span>
                                    <div class="link-del" onclick="deleteAvatarCreate();"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="description-field" class="form-group">
                                    <label class="control-label" for="description">
                                        Descripción (Opcional)
                                    </label>
                                    <textarea class="form-control" name="description" id="description" rows="5"
                                              placeholder="Ingrese una descripción"></textarea>
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
            <form method="post" id="form-edit"  enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id-edit" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="dissmisModal('#form-edit','#modal-edit')" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Libro</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="group-error-publisher-edit" class="form-group">
                                    <label class="control-label " for="publisher">
                                        Editorial
                                    </label>
                                    <select class="form-control" onchange="removeErrors();" id="publisher_id" name="publisher_id">
                                        <option selected disabled value="">Seleccione</option>
                                        @foreach($publishers as $publisher)
                                            <option value="{{$publisher->id}}" >{{$publisher->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="group-error-author-edit" class="form-group">
                                    <label class="control-label " for="author">
                                        Autor
                                    </label>
                                    <select class="form-control" onchange="removeErrors();" id="author_id" name="author_id">
                                        <option selected disabled value="">Seleccione</option>
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}" >{{$author->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="group-error-isbn-edit" class="form-group">
                                    <label class="control-label " for="isbn">
                                        ISBN
                                    </label>
                                    <input class="form-control" type="text" id="isbn" name="isbn"
                                           placeholder="Ingrese un ISBN.">
                                    <span id="error-isbn-edit" class="help-block"></span>
                                </div>
                                <div id="group-error-title-edit" class="form-group">
                                    <label class="control-label " for="title">
                                        Título
                                    </label>
                                    <input class="form-control" type="text" id="title" name="title"
                                           placeholder="Ingrese un título.">
                                    <span id="error-title-edit" class="help-block"></span>
                                </div>
                                <div id="group-error-pages-edit" class="form-group">
                                    <label class="control-label " for="pages">
                                        Páginas
                                    </label>
                                    <input class="form-control" type="number" id="pages" name="pages"
                                           placeholder="Ingrese Páginas.">
                                    <span id="error-pages-edit" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12" id="group-error-cover-edit">
                                    <label for="cover">Caratula del Libro</label>
                                    <div class="image-cover">
                                        <img id="image-cover-edit" class="img-thumbnail" height="370px" width="100%" src="{{ Storage::url('covers/cover-default.png') }}">
                                    </div>
                                    <input type="file" name="cover" id="file-edit"
                                           class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
                                    <label for="file-edit">Seleccione Caratula del Libro</label>
                                    <span class="help-block" id="label-error-cover-edit"></span>
                                    <div class="link-del" onclick="deleteAvatarEdit();"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="description-field" class="form-group">
                                    <label class="control-label" for="description">
                                        Descripción (Opcional)
                                    </label>
                                    <textarea class="form-control" name="description" id="description" rows="5"
                                              placeholder="Ingrese una descripción"></textarea>
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

    <script>

        var items = [];

        // cargar datos
        function ajaxRequest(params){

            $.ajax({
                type: "GET",
                contentType : "application/json",
                url: "{{ route('books.all') }}",
                success: function(data) {
                    params.success(data);
                    items = data;
                }
            });
        }

        // formato de la tabla -> carga de datos
        function detailFormatter(index, row) {

            var titles = [
                {id: 'id', name: 'Id'},
                {id: 'name', name: 'Nombre'},
                {id: 'description', name: 'Descripción'},
                {id: 'created_at', name: 'Creado'},
                {id: 'updated_at', name: 'Modificado'},
                {id: 'active', name: 'Estado'}
            ];

            var html = [];

            $.each(row, function (key, value) {
                var title = titles.find(title => title.id === key);
                if (title) {

                    if(title.id === 'active'){
                        value = value == 1 ? "Activado" : "Desactivado";
                    }

                    value = value ? value : "-";

                    html.push('' +
                        '<div style=" width: 10%; float: left;">' +
                        '<b>' + title.name + ' </b></div>' +
                        '<div style=" width: 90%; float: left; clear: right;">' + value  + '</div>');
                }
            });
            return html.join('');
        }

        // atributos de filas
        function cellStyle(value, row, index, field) {
            return {
                css: {"white-space": "nowrap"}
            };
        }

        function dateFormat(value, row, index) {

            var date = new Date(value);

            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;

            var month = (1 + date.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;

            var hours = date.getHours().toString();
            hours = hours.length > 1 ? hours : '0' + hours;

            var minutes = date.getMinutes().toString();
            minutes = minutes.length > 1 ? minutes : '0' + minutes;

            var seconds = date.getSeconds().toString();
            seconds = seconds.length > 1 ? seconds : '0' + seconds;

            return '<span>' + day + '-' + month + '-' + date.getFullYear() + '</span><br>' +
                '<span>' + hours + ':' + minutes + ':' + seconds + '</span>';
        }

        function updateRow(index, entity){

            $('#table').bootstrapTable('updateRow', {
                index: index,
                row: {
                    id: entity.id,
                    name: entity.name,
                    description : entity.description,
                    active : entity.active,
                    created_at : entity.created_at,
                    updated_at : entity.updated_at
                }
            });

            items[items.findIndex(item => item.id == entity.id)] = entity;
        }

        // function de registro
        $(function () {
            $('#form-create').submit(function (e) {

                lockSubmit();

                var dataForm = $('#form-create').serialize();
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '{{route('books.store')}}',
                    data: dataForm,
                    success: function (data) {

                        if (data.errors) {
                            showInputError(data.errors.id ? data.errors.name : null, '#error-isbn-create','#group-error-isbn-create');
                            showInputError(data.errors.title ? data.errors.title : null, '#error-title-create','#group-error-title-create');
                            showInputError(data.errors.author_id ? data.errors.author_id : null, '#error-author_id-create','#group-error-author_id-create');
                            showInputError(data.errors.publisher_id ? data.errors.publisher_id : null, '#error-publisher_id-create','#group-error-publisher_id-create');
                        }
                        if(data.status === 'success'){
                            showToastSuccess(data.message);
                            dissmisModal('#form-create','#modal-create');
                            $('#table').bootstrapTable('refresh');

                            unlockSubmit();
                        }
                    },
                    error: function (error) {
                        showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                        dissmisModal('#form-create','#modal-create');
                    }
                });

                unlockSubmit();

            });
        });

        // mostrar errores de input formulario
        function showInputError(error, input, group){
            var label =  $(input);
            var divContent = $(group);

            label.html(error);
            divContent.addClass('has-error');

        }

        // esconder errores de input formularion
        function hideInputError(input, group){
            var label =  $(input);
            var divContent = $(group);

            label.html('');
            divContent.removeClass('has-error');
        }

        // limpia el campo de error cuando se escribe denuevo create
        $('#form-create').find('#name').keyup(function () {
            if($('#form-create').find('#name').val().length > 1){
                hideInputError('#error-name-create','#group-error-name-create');
            }
        });

        // limpia el campo de error cuando se escribe denuevo edit
        $('#form-edit').find('#name').keyup(function () {
            if($('#form-edit').find('#name').val().length > 1){
                hideInputError('#error-name-edit','#group-error-name-edit');
            }
        });

        // limpiar input formularion crear
        function clearInputs(form){
            $(form).trigger('reset');
        }

        // esconder modal crear
        function hideModal(modal){
            $(modal).modal('hide');
        }

        // show modal crear
        function showModal(modal){
            $(modal).modal('show');
        }

        // cerrar y limpiar modal crear
        function dissmisModal(form, modal){
            clearInputs(form);
            hideModal(modal);
            removeHasErrors();
        }

        function removeHasErrors() {
            hideInputError('#error-name-create','#group-error-name-create');
            hideInputError('#error-name-edit','#group-error-name-edit');
        }

        // funcion de editar
        $(function () {
            $('#form-edit').submit(function (e) {

                lockSubmit();

                var dataForm = $('#form-edit').serialize();
                e.preventDefault();
                var url = '{{route('books.update')}}';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataForm,
                    success: function (data) {

                        if (data.errors) {
                            showInputError(data.errors.name ? data.errors.name : null, '#error-name-edit','#group-error-name-edit');
                        }
                        if(data.status === 'success'){
                            $('#table').bootstrapTable('refresh');
                            showToastSuccess(data.message);
                            showToastWarning('Tenga en cuenta que el autor que ha modificado puede estar siendo utilizado por libros y este cambio será reflejado en estos.');
                            dissmisModal('#modal-create','#modal-edit');
                            updateRow(items.findIndex(item => item.id == data.entity.id), data.entity);
                        }
                    },
                    error: function (error) {
                        showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                        dissmisModal('#modal-create','#modal-edit');
                    }
                });

                unlockSubmit();

            });
        });

        // boton de editar
        function operateFormatterControls(value, row, index){
            return ['<button onclick="showDataToEdit(' + row.id +')" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>',
                '<button onclick="remove(' + row.id +')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'
            ].join('  ');
        }

        // muestra los valores de la fila en el form de editar
        function showDataToEdit(rowId){

            var item = items.filter(item => item.id === rowId)[0];

            showModal('#modal-edit');
            $('#form-edit').find('#isbn').val(item.isbn);
            $('#form-edit').find('#title').val(item.title);
            $('#form-edit').find('#description').val(item.description);
            $('#form-edit').find('#pages').val(item.pages);
            $('#form-edit').find('#publisher_id').val(item.publisher_id);
            $('#form-edit').find('#author_id').val(item.author_id);
            $('#form-edit').find('#image-cover-edit').attr('src',item.label.replace("public/", "storage/"));

        }

        // boton de activar y desactivar item
        function operateFormatterActive(value, row, index){

            var activeButton = '';

            if(row.active == 1){
                activeButton = 'checked';
            }

            return ['<label class="switch"><input id="switch" type="checkbox" onclick="changeStatusToggle(' + row.id + ')" ' + activeButton + ' id="togBtn"><div class="slider round"><span class="on">Activado</span><span class="off">Desactivado</span></div></label>'].join('');
        }

        // cambia el estado del item ( activar y desactivar )
        function changeStatusToggle(rowId){

            var item = items.filter(item => item.id === rowId)[0];
            var itemStatus = item.active == 1 ? 0 : 1;

            $.ajax({
                type: 'POST',
                url: '{{route('books.change-status')}}',
                data: {
                    _token : '{{ csrf_token() }}',
                    id : item.id,
                    active : itemStatus
                },
                success: function (data) {
                    if (data.errors) {
                        showToastError(data.errors.name ? data.errors.name : '');
                    }
                    if(data.status === 'success'){

                        var status = data.entity.active == 1 ? "activado" : "desactivado";
                        showToastSuccess('Se ha ' + status + ' el autor ' + data.entity.name);
                        if(status == 'desactivado'){
                            showToastWarning('Tenga en cuenta que el autor que ha deshabilitado puede estar siendo utilizado por libros y este dejará de aparecer como una opción seleccionable.');
                        }
                        updateRow(items.findIndex(item => item.id == data.entity.id), data.entity);
                    }
                },
                error: function (error) {
                    showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                }
            });

        }

        // eliminar registro
        function remove(id){

            swal({
                title: '¿Estas seguro?',
                text: "Si eliminas este autor de libro se perderán todas las relaciones actuales.",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'No, Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then(function(result){

                if (result.value) {

                    var url = '{{route('books.destroy')}}';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            _token : '{{ csrf_token() }}',
                            id : id
                        },
                        success: function (data) {

                            if (data.errors) {
                                showInputError(data.errors.name ? data.errors.name : null, '#error-name-edit','#group-error-name-edit');
                            }
                            if(data.status === 'success'){
                                showToastSuccess(data.message);
                                showToastWarning('Tenga en cuenta que el autor que ha eliminado ya no puede ser referenciado.');
                                $('#table').bootstrapTable('refresh');
                            }
                        },
                        error: function (error) {
                            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                            dissmisModal('#modal-create','#modal-edit');
                        }
                    });

                    unlockSubmit();

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal({
                        title: 'Cancelado',
                        text: 'Acción Cancelada.',
                        type: 'error',
                        confirmButtonText: 'De acuerdo',
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false
                    });
                }

            });

        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-cover').attr('src', e.target.result);
                    $('#image-cover').attr('class', 'img-thumbnail');
                    $('.link-del').html('borrar');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLEdit(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-cover-edit').attr('src', e.target.result);
                    $('#image-cover-edit').height($('#image-cover-edit').width());
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
            $('#modal-create #image-cover').attr('src', '{{ Storage::url('covers/cover-default.png') }}');
            $('.link-del').html('');
            $("#modal-create #file").val('');
        }

        function deleteAvatarEdit() {
            $('#modal-edit #image-cover-edit').attr('src', '{{ Storage::url('covers/cover-default.png') }}');
            $('.link-del').html('');
            $("#modal-edit #file").val('');
        }


    </script>

@endsection
