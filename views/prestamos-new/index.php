<?php 
    require_once("../../config/conexion.php"); 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Prestamos - library system</title>

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
                    <h1>Registrar Prestamo</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../prestamos">Prestamos</a></li>
                            <li class="breadcrumb-item active">Nuevo Prestamo</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 col-sm">
                <div class="pagetitle">
                    <div class="col-md-12 text-center">
                    <a href="../prestamos" class="botones">Volver</a>

                    </div>
                    
                </div>
            </div>
            <!-- ======= Content ======= -->
            <section class="section">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h5>Datos del Alumno</h5>
                            </div>
                            <div class="card-body waves-effect waves-light mt-2">
                                <!--<form id="form_mantenimiento" method="post">-->
                                <div class="row mb-3">
                                    <div class="row align-items-center -3g">

                                        <input hidden type="text" id="id_prestamo" name="id_prestamo"
                                            class="form-control">

                                        <div class="col-lg-5">
                                            <label for="alumno_id" class="form-label">Alumno</label>
                                            <select id="alumno_id" name="alumno_id" class="form-control form-select"
                                                aria-label="Seleccione">
                                                <option value='' selected>Seleccione</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="codigo" class="form-label">Código</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" readonly
                                                disabled />
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="grado" class="form-label">Grado</label>
                                            <input type="text" class="form-control" id="grado" name="grado" readonly
                                                disabled />
                                        </div>
                                        <div class="col-lg-1">
                                            <label for="seccion" class="form-label">Sección</label>
                                            <input type="text" class="form-control" id="seccion" name="seccion" readonly
                                                disabled />
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion"
                                                readonly disabled />
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="text" class="form-control" id="correo" name="correo" readonly
                                                disabled />
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono"
                                                readonly disabled />
                                        </div>
                                    </div>
                                </div>
                                <!--</form>--->
                            </div>
                        </div>
                    </div>
                </div>

                <!--TODO:DATOS BOOKS-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h5>Datos del Libro</h5>
                            </div>
                            <div class="card-body waves-effect waves-light mt-2">
                                <!---<form id="form_detail_prestamo_books" method="post">--->
                                <div class="row mb-3">
                                    <div class="row align-items-center -3g">
                                        <div class="col-lg-5">
                                            <label for="libro_id" class="form-label">Cod. Libro - Título</label>
                                            <select id="libro_id" name="libro_id" class="form-control form-select"
                                                aria-label="Seleccione">
                                                <option value='' selected>Seleccione</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="autor" class="form-label">Autor</label>
                                            <input type="text" class="form-control" id="autor" name="nombre" disabled
                                                readonly />
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="categoria" class="form-label">Categoria</label>
                                            <input type="text" class="form-control" id="categoria" name="direccion"
                                                readonly disabled />
                                        </div>


                                        <div class="col-lg-3">
                                            <label for="publicacion" class="form-label">Fech.Publicación</label>
                                            <input type="text" class="form-control" id="publicacion" name="publicacion"
                                                readonly disabled />
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="ubicacion" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                                                readonly disabled />
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="cantidad" class="form-label">Cand. Disponible</label>
                                            <input type="text" class="form-control" id="cantidad" name="cantidad"
                                                readonly disabled />
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="Cantidad_requerida" class="form-label">Cand.Requerida</label>
                                            <input type="number" class="form-control" id="Cantidad_requerida"
                                                name="Cantidad_requerida" />
                                        </div>
                                    </div>
                                </div>
                                <!---</form>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pagetitle">
                    <div class="col-lg-8">
                        <h1>Detalle - Prestamos</h1>
                    </div>
                    <div class="col-md-4 text-center mt-3 mt-md-0">
                        <button id="btn_register_detalle" class="botones" type="button">Agregar al Detalle</button>
                        <button id="btn_limpiar_detalle" class="botones_secundario" type="button">Limpiar</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="align-items-center d-flex">
                                <h5> </h5>
                            </div>

                            <div class="card-body">
                                <table id="tabla_prestamos"
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

                                <!-- TODO:Calculo Detalle -->
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
                        </div>
                    </div>
                </div>

                <!--TODO:DATOS BOOKS-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h5>Datos del Prestamo</h5>
                            </div>
                            <div class="card-body waves-effect waves-light mt-2">
                                <!---<form id="form_detail_prestamo_books" method="post">--->
                                <div class="row mb-3">
                                    <div class="row align-items-center -3g">

                                        <div class="col-lg-4">
                                            <label for="fecha_inicio" class="form-label">Fech.Prestamo</label>
                                            <div class="col-sm-10">
                                                <input type="date" id="fecha_inicio" name="fecha_inicio"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="fecha_fin" class="form-label">Fech.Devolución</label>
                                            <div class="col-sm-10">
                                                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                                            </div>
                                        </div> 

                                        <div class="col-lg-4">
                                            <label for="comentario" class="form-label">Comentario</label>
                                            <textarea class="form-control alert alert-info" id="comentario"
                                                name="comentario" placeholder="Comentario" rows="4"
                                                required=""></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="hstack gap-2 left-content-end d-print-none mt-4">
                                    <button type="button" id="btn_Registrar_prestamo" class="botones"><i
                                            class=" ri-book-mark-line me-1"></i> Generar
                                        Prestamo</button>
                                    <a id="btn_cancelar_reload" class="botones_secundario"><i
                                            class=" ri-refresh-line me-1"></i>Cancelar Prestamo</a>
                                </div>
                                <!---</form>-->
                            </div>

                        </div>


                    </div>

                </div>

                <br><br>
            </section>
        </div>
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
    <script src="prestamos.js"></script>

    <!-- EN JS-->
</body>

</html>