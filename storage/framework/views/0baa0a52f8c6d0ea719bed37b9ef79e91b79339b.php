<li <?php echo e((Request::is('management-users') ? 'class=active' : '')); ?>>
    <a href="<?php echo e(route('management.users')); ?>">
        <i class="fa fa-users"></i>
        <span>Gestión de Usuarios</span>
    </a>
</li>
<li <?php echo e((Request::is('config/publishers') ? 'class=active' : '')); ?> >
    <a href="<?php echo e(route('publishers')); ?>">
        <i class="fa fa-angle-right"></i>
        Editoriales
    </a>
</li>
<li <?php echo e((Request::is('config/authors') ? 'class=active' : '')); ?> >
    <a href="<?php echo e(route('authors')); ?>">
        <i class="fa fa-angle-right"></i>
        Autores
    </a>
</li>
<li <?php echo e((Request::is('config/books') ? 'class=active' : '')); ?> >
    <a href="<?php echo e(route('books')); ?>">
        <i class="fa fa-book"></i>
        Libros
    </a>
</li>
