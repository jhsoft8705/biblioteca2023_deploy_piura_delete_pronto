<?php 
    require_once("../../config/conexion.php"); 
     $id_prestamo_new = isset($_GET['p']) ? $_GET['p'] : null; 
     $id_alumno_new = isset($_GET['a']) ? $_GET['a'] : null; 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Documento de prestamo - library system</title>
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
                    <h1>Detalle de Prestamo #<?php echo $id_prestamo_new; ?></h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../prestamos">Prestamos</a></li>
                            <li class="breadcrumb-item active">Detalle de Prestamo</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 col-sm">
                <div class="pagetitle">
                    <!---<div class="col-md-12 text-center">
                        <button  class="botones" type="button">Volver</button>
                    </div>--->

                </div>
            </div>
            <!-- ======= Content ======= -->
            <section class="section">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="card" id="demo">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-header border-bottom-dashed p-4">
                                        <input type="hidden" id="id_prestamo" name="id_prestamo"
                                            value="<?php echo $id_prestamo_new; ?>">
                                        <input type="hidden" id="id_alumno" name="id_alumno"
                                            value="<?php echo $id_alumno_new; ?>">

                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <img src="../../assets/img/logo.png" class="card-logo card-logo-dark"
                                                    alt="logo dark" height="17">
                                                <img src="../../assets/images/logo-light.png"
                                                    class="card-logo card-logo-light" alt="logo light" height="17">
                                                <div class="mt-sm-5 mt-4">
                                                    <h6 class="text-muted text-uppercase fw-semibold">
                                                        Alumno: <span id="txtnombres"></span></h6>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 mt-sm-0 mt-3">

                                                <h6><span class="text-muted fw-normal">Tel:
                                                    </span><span id="">987386462</span></h6>
                                                <h6><span class="text-muted fw-normal">Atención:
                                                    </span><span id="">L-V 8AM - 6PM</span></h6>
                                                <h6 class="mb-0"><span class="text-muted fw-normal">Usuario:
                                                    </span><span id="txtuser"></span></h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-lg-2 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Código </p>
                                                <h5 class="fs-14 mb-0"><span id="txtcodigo"></span></h5>
                                            </div>
                                            <div class="col-lg-2 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Grado </p>
                                                <h5 class="fs-14 mb-0"><span id="txtgrado"></span></h5>
                                            </div>

                                            <div class="col-lg-2 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Sección</p>
                                                <h5 class="fs-14 mb-0"><span id="txtsession"> </h5>
                                            </div>
                                            <div class="col-lg-2 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Teléfono
                                                </p>
                                                <h5 class="fs-14 mb-0"><span id="txtetelefono"></h5>
                                            </div>

                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Email</p>
                                                <h5 class="fs-14 mb-0"><span id="txtemail"></span></h5>
                                            </div>

                                            <div class="col-lg-3 col-12">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Dirección</p>
                                                <h5 class="fs-14 mb-0"><span id="txtdireccion"></span></h5>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="row g-3">


                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Fecha Prestamo</p>
                                                <h5 class="fs-14 mb-0"> <span id="txt_fecha_prestamo"></h5>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Fecha Devolución
                                                </p>
                                                <h5 class="fs-14 mb-0"><span id="txt_fecha_devol"></h5>
                                            </div>

                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Libros prestados
                                                </p>
                                                <h5 class="fs-14 mb-0"><span id="txttotal"></span></h5>
                                            </div>

                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Libros prestados
                                                </p>
                                                <h5 class="fs-14 mb-0"><span id="txtestado"></span></h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="table-responsive">

                                            <table id="tabla_imprimir"
                                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Cod. Libro</th>
                                                        <th scope="col">Titulo Libro</th>
                                                        <th scope="col">Categoría</th>
                                                        <th scope="col">Autor</th>
                                                        <th scope="col">Cantidad</th>
                                                        <th scope="col"></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="border-top border-top-dashed mt-2">

                                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                                style="width:250px">
                                                <tbody>
                                                    <tr class="border-top border-top-dashed fs-15">
                                                        <th scope="row">Total</th>
                                                        <th class="text-end" nombre="id_total" id="id_total"></th>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="mt-4">
                                            <div class="alert alert-info">
                                                <p class="mb-0"><span class="fw-semibold">Comentario:</span>
                                                    <span id="txtcomen">
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                            <a href="javascript:window.print()" class="btn btn-success"><i
                                                    class="ri-printer-line align-bottom me-1"></i> Inprimir</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>
        </div>

        <!-- ======= End Content ======= -->
    </main>

    <!-- ======= Footer ======= -->
    <?php 
    include_once("../componentes/footer.php");
    ?>
    <!-- =======End Footer=======- -->

    <!-- JS-->
    <?php 
    include_once("../componentes/js.php");
    ?>
    <script src="imprimir.js"></script>

    <!-- EN JS-->
</body>

</html>