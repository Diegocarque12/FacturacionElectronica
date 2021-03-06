<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=base_url()?>/plantilla/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/plantilla/dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="https://i.imgur.com/g3bijUl.png">

    <link rel="stylesheet" href="<?=base_url()?>/plantilla/plugins/pace/themes/red/pace-theme-corner-indicator.css">

    <?= $this->renderSection('style'); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?=base_url()?>/plantilla/dist/img/cuenta.jpg" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Facturación</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?=base_url()?>/plantilla/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <?php  $this->session = \Config\Services::session(); ?>
                        <a href="#" class="d-block"><?= $this->session->get('nombre')?></a>
                    </div>
                </div>
                <div align="center">
                    <a href="<?=base_url()?>/login/salir">
                        <button class="btn btn-danger btn-sm">Cerrar sesion</button>
                    </a>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link  bg-info">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Facturas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=base_url('factura/listado')?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=base_url('factura/crear')?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->renderSection('header'); ?>
            <?= $this->renderSection('body'); ?>
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                V 1.0 {20210310}
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 <a href="https://github.com/Diegocarque12/FacturacionElectronica">Grupo 2 -
                    Miramar</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?=base_url()?>/plantilla/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/plantilla/dist/js/adminlte.min.js"></script>

    <script src="<?=base_url()?>/plantilla/plugins/pace/pace.min.js"></script>

    <<<<<<< HEAD <?= $this->renderSection('script'); ?>=======<!-- SweetAlert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
        function mensaje(titulo, mensaje, icono) {
            swal({
                title: titulo,
                text: mensaje,
                icon: icono,
            });
        } //Fin del mensaje
        </script>

        <?= $this->renderSection('script'); ?>
        >>>>>>> 30fcc0f8a1f9049f875449d7d13de5df5577158f
</body>

</html>