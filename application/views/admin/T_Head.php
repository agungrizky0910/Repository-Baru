<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/admin-template/'); ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin-template/'); ?>vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin-template/'); ?>css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/notiflix/'); ?>src/notiflix.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin-template/'); ?>css/bootstrap-datepicker3.css">
    <link href="<?= base_url('assets/'); ?>select2-master/dist/css/select2.css" rel="stylesheet" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url('assets/admin-template/'); ?>css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/LogoDamaiIndahGolf.png" />
    <script>
        // Root Base
        var rootWebService = '<?= base_url(); ?>';
    </script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:header -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?= base_url();
                                                            if ($this->session->userdata('level') == 'CaddyMaster') {
                                                                echo 'CaddyMaster';
                                                            } else  if ($this->session->userdata('level') == 'GOManager') {
                                                                echo 'GOManager';
                                                            } else  if ($this->session->userdata('level') == 'Admin') {
                                                                echo 'Admin';
                                                            } ?>"><img src="<?= base_url(); ?>assets/images/LogoDamaiIndahGolf-small.png" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/LogoDamaiIndahGolf.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="<?= base_url('Logout'); ?>">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->