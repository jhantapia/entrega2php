<?php $__env->startSection('content-title', 'Perfil'); ?>

<?php $__env->startSection('content-subtitle', 'Username'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(route('profile')); ?>">Perfil</a></li>
    <li class="active">username</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">DATOS PERSONALES</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('update-profile')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
                        <div class="form-group">
                            <label for="avatar" class="col-md-3 control-label">Avatar</label>
                            <div class="col-md-9">
                                <div class="image-avatar">
                                    <img id="image-avatar" src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>">
                                </div>
                                <input type="file" name="avatar" onchange="loadAvatar();" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg" style="width: 147px;" />
                                <label style="width: 147px;"  for="file">Seleccione un avatar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="firstname" value="<?php echo e(Auth::user()->firstname); ?>" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Apellido Paterno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo e(Auth::user()->lastname); ?>" name="lastname" placeholder="Apellido Paterno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="second_lastname" class="col-md-3 control-label">Apellido Materno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php echo e(Auth::user()->second_lastname); ?>" name="second_lastname" placeholder="Apellido Materno">
                            </div>
                        </div>
                        <div class="form-group <?php echo e($errors->has('email') ? 'has-error':''); ?>">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" value="<?php echo e(Auth::user()->email); ?>" name="email" placeholder="Email">

                                <?php echo $errors->first('email', '<span class="help-block">:message</span>'); ?>

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
                            <img class="profile-user-img img-responsive img-circle" src="<?php echo e(Storage::url(Auth::user()->avatar)); ?>"
                                 alt="User profile picture">

                            <h3 class="profile-username text-center"><?php echo e(Auth::user()->firstname . ' ' .Auth::user()->lastname); ?></h3>

                            <p class="text-muted text-center"><?php echo e(Auth::user()->role->name); ?></p>
                            <p class="text-muted text-center">Último Acceso : <?php echo e(Auth::user()->last_login_date ? (new DateTime(Auth::user()->last_login_date))->format('d-m-Y H:i:s') : 'nunca'); ?></p>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            
                
                    
                        
                            
                        
                        
                            
                                
                                
                                
                                    
                                    
                                    
                                

                                
                                    
                                    
                                    
                                
                                
                                    
                                    
                                    
                                

                                
                                    
                                
                            
                        

                    
                
            
        </div>



    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>