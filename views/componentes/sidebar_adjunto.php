<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/home/index.php') ? ' collapsed' : ''; ?>"
                href="../home/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li> 

        <li class="nav-item">
            <a class="nav-link  
            <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/estudiante/index.php' || $_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/grados/index.php'|| $_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/secciones/index.php')  ? ' collapsed' : ''; ?>"
                data-bs-target="#estudiantes-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-user-2-fill"></i><span>Estudiantes</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="estudiantes-nav"
                class="nav-content <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/estudiante/index.php') ? 'show' : 'collapse'; ?>"
                data-bs-parent="#sidebar-na v">
                
                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/estudiante/index.php') ? ' collapsed' : ''; ?>"
                        href="../estudiante/">
                        <i class=" ri-logout-circle-r-line"></i><span>Estudiantes</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/grados/index.php') ? ' collapsed' : ''; ?>"
                        href="../grados">
                        <i class=" ri-logout-circle-r-line"></i><span>Grados</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/secciones/index.php') ? ' collapsed' : ''; ?>"
                        href="../secciones">
                        <i class=" ri-logout-circle-r-line"></i><span>Secciones</span>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link  
            <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/libros/index.php' || $_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/autores/index.php'|| $_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/categorias/index.php'|| $_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/ubicaciones/index.php')  ? ' collapsed' : ''; ?>"
                data-bs-target="#libros-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Libros</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="libros-nav"
                class="nav-content <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/libros/index.php') ? 'show' : 'collapse'; ?>"
                data-bs-parent="#sidebar-na v">
                
                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/libros/index.php') ? ' collapsed' : ''; ?>"
                        href="../libros/">
                        <i class=" ri-logout-circle-r-line"></i><span>Libros</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/autores/index.php') ? ' collapsed' : ''; ?>"
                        href="../autores">
                        <i class=" ri-logout-circle-r-line"></i><span>Autores</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/categorias/index.php') ? ' collapsed' : ''; ?>"
                        href="../categorias">
                        <i class=" ri-logout-circle-r-line"></i><span>Categorias</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/ubicaciones/index.php') ? ' collapsed' : ''; ?>"
                        href="../ubicaciones">
                        <i class=" ri-logout-circle-r-line"></i><span>Ubicaciones</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link  
            <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/prestamos/index.php' || $_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/list_prestamos/index.php')  ? ' collapsed' : ''; ?>"
                data-bs-target="#prestamos-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-share-forward-box-line"></i><span>Prestamos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="prestamos-nav"
                class="nav-content <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/prestamos/index.php') ? 'show' : 'collapse'; ?>"
                data-bs-parent="#sidebar-na v">
                
                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/prestamos/index.php') ? ' collapsed' : ''; ?>"
                        href="../prestamos/">
                        <i class=" ri-logout-circle-r-line"></i><span>Nuevo prestamo</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/list_prestamos/index.php') ? ' collapsed' : ''; ?>"
                        href="../list_prestamos">
                        <i class=" ri-logout-circle-r-line"></i><span>Prestamos</span>
                    </a>
                </li>
 

            </ul>
        </li>

        <li class="nav-heading">CONFIGURACIÓN</li>

        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/usuarios/index.php') ? ' collapsed' : ''; ?>"
                href="../usuarios/">
                <i class="ri-user-shared-2-fill"></i>
                <span>Usuarios</span>
            </a>
        </li>

        
        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/roles/index.php') ? ' collapsed' : ''; ?>"
                href="../roles/">
                <i class="ri-user-settings-line "></i>
                <span>Roles</span>
            </a>
        </li> 
    </ul>
</aside><!-- End Sidebar-->

<!--
<ul class="sidebar-nav" id="sidebar-nav">
    <?php foreach ($menus as $menu) : ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $menu['active'] ? ' collapsed' : ''; ?>"
                href="<?php echo $menu['url']; ?>">
                <i class="<?php echo $menu['icon']; ?>"></i>
                <span><?php echo $menu['name']; ?></span>
            </a>
            <?php if (!empty($menu['submenus'])) : ?>
                <ul class="nav-content<?php echo $menu['active'] ? ' show' : ' collapse'; ?>" data-bs-parent="#sidebar-nav">
                    <?php foreach ($menu['submenus'] as $submenu) : ?>
                        <li>
                            <a class="nav-link<?php echo $submenu['active'] ? ' collapsed' : ''; ?>"
                                href="<?php echo $submenu['url']; ?>">
                                <i class="<?php echo $submenu['icon']; ?>"></i>
                                <span><?php echo $submenu['name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
----->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');

    menuLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            link.classList.toggle('collapsed');
            const target = link.getAttribute('data-bs-target');
            const targetNav = document.querySelector(target);
            targetNav.classList.toggle('show');
        });
    });
});
</script>