<li {{ (Request::is('management-users') ? 'class=active' : '') }}>
    <a href="{{ route('management.users') }}">
        <i class="fa fa-users"></i>
        <span>Gestión de Usuarios</span>
    </a>
</li>
<li {{ (Request::is('config/publishers') ? 'class=active' : '') }} >
    <a href="{{ route('publishers') }}">
        <i class="fa fa-angle-right"></i>
        Editoriales
    </a>
</li>
<li {{ (Request::is('config/authors') ? 'class=active' : '') }} >
    <a href="{{ route('authors') }}">
        <i class="fa fa-angle-right"></i>
        Autores
    </a>
</li>
<li {{ (Request::is('config/books') ? 'class=active' : '') }} >
    <a href="{{ route('books') }}">
        <i class="fa fa-book"></i>
        Libros
    </a>
</li>
