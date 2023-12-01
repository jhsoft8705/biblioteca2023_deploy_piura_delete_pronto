<?php 
    require_once("../../config/conexion.php"); 
 ?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Autores - library system</title>

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
        <div class="row">
            <div class="col-lg-9 col-sm">
                <div class="pagetitle">
                    <h1>Libros - Categorias</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../home">Home</a></li>
                            <li class="breadcrumb-item active">Categorias</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 col-sm">
                <div class="pagetitle">
                    <div class="col-md-12 text-center">
                        <button id="btn_nuevo_registro" class="botones" type="button">Nueva
                            Categoría</button>
                    </div>
                    
                </div>
            </div>
            <!-- ======= Content ======= -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body waves-effect waves-light mt-2">
                                <table id="tabla_categorias" class="table table-striped table-bordered display"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre de las Categoria de Libros</th>
                                            <th scope="col">Descripcion</th> 
                                             <th scope="col">Estado</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
        <?php 
            include_once("form.php");
        ?>
        <!-- ======= End Content ======= -->
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
    <script src="categorias.js"></script>

    <!-- EN JS-->
</body>

</html>