<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('sistema.post.index')}}" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Posts
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sistema.categoria.index')}}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                
                <p>
                    Categorias
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('sistema.user.index')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                
                <p>
                    Usuários
                </p>
            </a>
        </li>
    </ul>
</nav>