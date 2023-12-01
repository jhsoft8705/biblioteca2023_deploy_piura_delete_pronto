<?php 
    require_once("../../config/conexion.php"); 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Perfil - library system</title>

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
            <div class="col-lg-12 col-sm">
                <div class="pagetitle">
                    <h1>Perfil</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../home">Home</a></li>
                            <li class="breadcrumb-item active">Perfil</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- ======= Content ======= -->
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="../../assets/img/user.png" alt="Profile" class="rounded-circle">
                                <h2 id="user_profile"> </h2>
                                <h3> <?php echo $_SESSION["nombre_rol"] ?></h3>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Descripción general</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Editar perfil</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Cambiar la contraseña</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nombres </div>
                                            <div class="col-lg-9 col-md-8 " name="nombre" id="nombre"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">N° Documneto</div>
                                            <div class="col-lg-9 col-md-8 " name="doc" id="doc"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Teléfono</div>
                                            <div class="col-lg-9 col-md-8 " name="tel" id="tel"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8" name="correo" id="correo"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Rol</div>
                                            <div class="col-lg-9 col-md-8" name="nombre_rol" id="nombre_rol"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Funciones</div>
                                            <div class="col-lg-9 col-md-8" name="descripcion_rol" id="descripcion_rol">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Dirección</div>
                                            <div class="col-lg-9 col-md-8" name="dir" id="dir"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Estado</div>
                                            <div class="col-lg-9 col-md-8" name="estado" id="estado"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Fecha de Registro</div>
                                            <div class="col-lg-9 col-md-8" name="fecha_registro" id="fecha_registro">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <!-- Profile Edit Form -->
                                        <!--<form>
                                            <div class="row mb-3">
                                                <label for="profileImage"
                                                    class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img src="assets/img/user.png" alt="Profile">
                                                    <div class="pt-2">
                                                        <a href="#" class="btn btn-primary btn-sm"
                                                            title="Upload new profile image"><i
                                                                class="bi bi-upload"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm"
                                                            title="Remove my profile image"><i
                                                                class="bi bi-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>--->
                                        <div class="row mb-3">
                                            <label for="nombres"
                                                class="col-md-4 col-lg-3 col-form-label">Nombres</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nombres" id="nombres" disabled reactonly type="text"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="documento" class="col-md-4 col-lg-3 col-form-label">N°
                                                Documento</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="documento" id="documento" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="telefono"
                                                class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="telefono" id="telefono" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="direccion"
                                                class="col-md-4 col-lg-3 col-form-label">Dirección</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="direccion" type="text" id="direccion" class="form-control">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="botones" id="btn_update">Guardar
                                                cambios</button>
                                        </div>
                                        <!--  </form> End Profile Edit Form -->

                                    </div>
                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- 
                                        <form>Change Password Form -->

                                        <div class="row mb-3">
                                            <label for="contrasena" class="col-md-4 col-lg-3 col-form-label">Contraseña
                                                actual</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="contrasena" type="password" class="form-control"
                                                    id="contrasena">
                                                <div class="invalid-feedback" id="password-error"></div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="new_password" class="col-md-4 col-lg-3 col-form-label">Nueva
                                                contraseña</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password" type="password" class="form-control"
                                                    id="new_password" required>
                                                <div class="invalid-feedback" id="new-password-error"></div>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="pass_confirm"
                                                class="col-md-4 col-lg-3 col-form-label">Re-ingrese nueva
                                                contraseña
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="pass_confirm" type="password" class="form-control"
                                                    id="pass_confirm">
                                                <div class="invalid-feedback" id="pass-confirm-error"></div>
                                                
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="btn_changes_password" class="botones">Cambiar la
                                                contraseña</button>
                                        </div>
                                        <!--</form> End Change Password Form -->

                                    </div>

                                </div>

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
    <script src="perfil.js"></script>

    <!-- EN JS-->
</body>

</html>