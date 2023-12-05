<?php 
    require_once("../../config/conexion.php");


    
    require_once("../../models/Libro.php");
    $libro=new Libro();
    $lista_libros=$libro->listbooks();

    require_once("../../models/Usuario.php");
    $usuario=new Usuario();
    $lista_user=$usuario->listuser();

    require_once("../../models/estudiante.php");
    $alumno=new Estudiante();
    $lista_alumnos=$alumno->liststuden();

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Usuarios - library system</title>
    <?php 
    include_once("../componentes/head.php");
    ?>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="../home" class="logo d-flex align-items-center">
                <img src="../../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">library system</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <?php 
    include_once("../componentes/navbar.php");
    ?>
    </header>
    <!-- =======End Header =======-->

    <!-- ======= Sidebar =======-->
    <?php 
    include_once("../componentes/sidebar.php");
    ?>
    <!-- ======= End Sidebar =======-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">


            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Opciones</h6>
                                </li>

                                <li><a class="dropdown-item" href="../libros/">Ver Libros</a></li> 
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Libros <span>| Disponibles</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class=" ri-book-2-line"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo count($lista_libros);?></h6>
                                    <a href="../libros/" class="text-decoration-underline">Ver Libros</a>
                          

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>OPCIONES</h6>
                                </li>

                                <li><a class="dropdown-item" href="../estudiante/">Ver Alumnos</a></li> 
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Estudiantes <span>| Registrados</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class=" ri-shield-user-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo(count($lista_alumnos)); ?></h6>
                                    <a href="../estudiante/" class="text-decoration-underline">Ver Estudiantes</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>OPCIONES</h6>
                                </li>
                                <li><a class="dropdown-item" href="../libros/">Ver Usuarios</a></li> 

                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Usuarios <span>| Activos</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                    <i class=" ri-user-settings-fill"></i>
                                </div>
                                <div class="ps-3">
                                   <h6><?php echo(count($lista_user)); ?></h6>
                                    <a href="../usuarios/" class="text-decoration-underline">Ver Usuarios</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

            </div>

            <div class="row">

                <div class="col-xxl-8 col-md-8">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>OPCIONES</h6>
                                </li>

                                <li><a class="dropdown-item"  >Today</a></li>
                                <li><a class="dropdown-item" href="#"> </a></li>
                             </ul>
                        </div>

                        <div class="card-body">
                        <h5 class="card-title">Préstamos y Devoluciones Recientes <span>| Registro Continuo</span></h5>

                            <table class="table table-borderless  ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Solicitante</th>
                                        <th scope="col">Prestamista</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla_op_recientes"> 
                                 
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>OPCIONES</h6>
                                </li>

                                <li><a class="dropdown-item" href="../usuarios/"  >Ver categorías</a></li>
                              </ul>
                        </div>

                        <div class="card-body pb-0">
                            <h5 class="card-title">Libros x Categoria <span>| Total</span></h5>

                            <div id="grafico_dona" style="min-height: 400px;" class="echart"></div>
 

                        </div>
                    </div>
                </div>

            </div>



        </section>


    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php 
     include_once("../componentes/footer.php");
     ?>
    <!-- =======End Footer=======- -->

    <!-- JS-->
    <?php 
    include_once("../componentes/js.php");
    ?>
    <!-- EN JS-->
    <script src="home.js"></script>

</body>

</html>