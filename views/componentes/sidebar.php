<!--TODO:configuración de Ruta Producción-->
<?php
      $public_html="Sistema_gestion_biblioteca_2023";
      $ruta = $_SERVER['SCRIPT_NAME']; 
          $opciones = array( 
          '/'.$public_html.'/views/home/index.php',
          '/'.$public_html.'/views/roles/index.php',
          ); 
?>


<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Principal</li>

        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/home/index.php') ? ' collapsed' : ''; ?>"
                href="../home/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/prestamos/index.php' ||$_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/prestamos-new/index.php') ? ' collapsed' : ''; ?>"
                href="../prestamos/">
                <i class="  ri-upload-line"></i>
                <span>Prestamos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/devoluciones/index.php' ||$_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/devoluciones/index.php') ? ' collapsed' : ''; ?>"
                href="../devoluciones/">
                <i class=" ri-arrow-down-line"></i>
                <span>Devoluciones</span>
            </a>
        </li>
        <li class="nav-heading">Libros</li>

        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/libros/index.php') ? ' collapsed' : ''; ?>"
                href="../libros/">
                <i class=" ri-book-2-line"></i>
                <span>Libros</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="../autores">
                <i class=" ri-shield-user-fill"></i>
                <span>Autores</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="../categorias">
                <i class=" ri-bookmark-2-line"></i>
                <span>Categorías</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="../ubicaciones">
                <i class=" ri-gps-fill"></i>
                <span>Ubicaciones</span>
            </a>
        </li>
        <li class="nav-heading">Estudiantes</li>

        <li class="nav-item">
            <a class="nav-link<?php echo ($_SERVER['SCRIPT_NAME'] == '/Sistema_gestion_biblioteca_2023/views/estudiante/index.php') ? ' collapsed' : ''; ?>"
                href="../estudiante/">
                <i class=" ri-user-2-fill"></i>
                <span>Estudiantes</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link " href="../grados">
                <i class=" ri-eraser-fill"></i>
                <span>Grados</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="../secciones">
                <i class=" ri-advertisement-line"></i>
                <span>Secciones</span>
            </a>
        </li>

        <li class="nav-heading">Configuración</li> 
        <li class="nav-item">
            <a class="nav-link " href="../usuarios">
                <i class=" ri-user-shared-2-fill"></i>
                <span>Usuarios</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="../roles">
                <i class=" ri-user-settings-line "></i>
                <span>Roles</span>
            </a>
        </li>

    </ul>
</aside>