<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/GMS.jpg" />

    <title>PT. Grakindo Maju Sukses</title>
    <!--

ART FACTORY

https://templatemo.com/tm-537-art-factory

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/users-template/'); ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/users-template/'); ?>css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/users-template/'); ?>css/jquery.dataTables.min.css">
    <link href="<?= base_url('assets/fontawesome/'); ?>/css/fontawesome.css" rel="stylesheet">
    <link href="<?= base_url('assets/fontawesome/'); ?>/css/brands.css" rel="stylesheet">
    <link href="<?= base_url('assets/fontawesome/'); ?>/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/users-template/'); ?>css/templatemo-art-factory.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/users-template/'); ?>css/owl-carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/flip-clock/'); ?>jquery.flipcountdown.css" />
    <script>
        // Root Base
        var rootWebService = '<?= base_url(); ?>';
    </script>
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="<?= base_url(); ?>" class="logo">PT. Grakindo Maju Sukses</a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="login">Login</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h3><strong>Laboratorium Kalibrasi</strong></h3>
                        <p>menampilkan informasi alat yang sudah di kalibrasi setiap bulannya secara realtime sebagai bahan evaluasi</p>
                        <a href="#jam-update" class="btn btn-danger">Lihat Sekarang</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <img src="<?= base_url('assets/users-template/'); ?>images/slider-icon.png" class="rounded img-fluid d-block mx-auto" alt="First Vector Graphic">
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="jam-update">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-3 align-items-stretch col-md-12 col-sm-12 justify-content-center align-self-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s" style="text-align:center!important">
                    <div id="retroclockbox1"></div>
                </div>
                <div class="right-image col-lg-9 col-md-12 col-sm-12 mobile-bottom-fix-big d-flex align-items-center" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <div class="d-flex alert alert-secondary" role="alert" style="width:100%">
                        Peringkat Alat Kalibrasi Terbaik Akan Diulang Setiap Bulannya
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Top 3 Caddy Start ***** -->
    <section class="section" id="leader-board">
        <div class="container mb-4">
            <div class="row mt-3">
                <!-- <div class="col-md-12"> -->
                <div class="card-deck">
                    <!-- card -->

                    <div class="col-sm-3 h-100 shadow align-items-stretch card justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s" style="background-color:#0db079;">
                        <div class=" card-body text-center text-light gambar">
                            <h6>KALIBRASI BULAN INI</h6>
                            <br>
                            <p class="text-light">Setiap hari kami menyoroti 3 caddy yang memiliki kinerja terbaik</p>
                            <img src="<?= base_url('assets/users-template/'); ?>images/trophy.png" alt="" class="img-fluid mt-3">

                        </div>
                    </div>
                    <?php if ($caddy_terbaik->num_rows() == 3) {
                        $peringkat = 1;
                        foreach ($caddy_terbaik->result() as $c) { ?>

                            <div class="col-sm-3 align-items-stretch card h-100 justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                                <div class="card-body text-center shadow gambar">
                                    <img src="<?= base_url('assets/'); ?>images/profil/<?= $c->foto; ?>" alt="foto-profil" alt="" class="img-thumbnail img-fluid rounded-circle mb-3"><br>
                                    <i class="fas fa-medal fa-2x <?php if ($peringkat == 1) {
                                                                        echo "text-warning";
                                                                    } else if ($peringkat == 2) {
                                                                        echo "text-muted";
                                                                    } ?>" <?php if ($peringkat == 3) {
                                                                                echo 'style="color:brown"';
                                                                            } ?>></i><br>
                                    <h6 style="margin:10px;"><?= custome_wordlimit($c->nama, 20); ?></h6>
                                    <hr>
                                    <span>Total Skor : </span><span class="font-weight-bold counter1"><?= $c->total_skor; ?></span>
                                </div>
                            </div>
                        <?php $peringkat++;
                        }
                    } else if ($caddy_terbaik->num_rows() == 2) {
                        $peringkat = 1;
                        foreach ($caddy_terbaik->result() as $c) { ?>

                            <div class="col-sm-3 align-items-stretch card h-100 shadow justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                                <div class="card-body text-center gambar">
                                    <img src="<?= base_url('assets/banner-bg.png'); ?>images/profil/<?= $c->foto; ?>" alt="foto-profil" alt="" class="img-fluid rounded-circle img-thumbnail mb-3"><br>
                                    <i class="fas fa-medal fa-2x <?php if ($peringkat == 1) {
                                                                        echo "text-warning";
                                                                    } else if ($peringkat == 2) {
                                                                        echo "text-muted";
                                                                    } ?>"></i><br>
                                    <h6 style="margin:10px;"><?= custome_wordlimit($c->nama, 20); ?></h6>
                                    <hr>
                                    <span>Total Skor : </span><span class="font-weight-bold counter1"><?= $c->total_skor; ?></span>
                                </div>
                            </div>
                        <?php $peringkat++;
                        } ?>

                        <div class="col-sm-3 align-items-stretch card h-100 shadow justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                            <div class="card-body text-center gambar">
                                <img src="<?= base_url('assets/'); ?>images/main_logo.png" alt="foto-profil" alt="" class=" img-fluid rounded-circle img-thumbnail mb-3"><br>
                                <i class="fas fa-medal fa-2x" style="color:brown"></i><br>
                                <h6 style="margin:10px;">Belum Ada Data</h6>
                                <hr>
                                <span>Total Skor : </span><span class="font-weight-bold counter3">0</span>
                            </div>
                        </div>

                        <?php
                    } else if ($caddy_terbaik->num_rows() == 1) {
                        $peringkat = 1;
                        foreach ($caddy_terbaik->result() as $c) { ?>

                            <div class="col-sm-3 align-items-stretch card h-100 shadow justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                                <div class="card-body text-center gambar">
                                    <img src="<?= base_url('assets/'); ?>images/profil/<?= $c->foto; ?>" alt="foto-profil" alt="" class=" img-fluid rounded-circle img-thumbnail mb-3"><br>
                                    <i class="fas fa-medal fa-2x <?php if ($peringkat == 1) {
                                                                        echo "text-warning";
                                                                    } ?>" <?php if ($peringkat == 3) {
                                                                                echo 'style="color:brown"';
                                                                            } ?>></i><br>
                                    <h6 style="margin:10px;"><?= custome_wordlimit($c->nama, 20); ?></h6>
                                    <hr>
                                    <span>Total Skor : </span><span class="font-weight-bold counter1"><?= $c->total_skor; ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- card -->
                        <div class="col-sm-3 align-items-stretch card h-100 shadow justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                            <div class="card-body text-center gambar">
                                <img src="<?= base_url('assets/'); ?>images/main_logo.png" alt="foto-profil" alt="" class="img-thumbnail img-fluid rounded-circle mb-3"><br>
                                <i class="fas fa-medal fa-2x text-muted"></i><br>
                                <h6 style="margin:10px;">Belum Ada Data</h6>
                                <hr>
                                <span>Total Skor :</span> <span class="font-weight-bold counter2">0</span>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="col-sm-3 align-items-stretch card h-100 shadow justify-content-center align-self-center d-flex align-items-center mobile-bottom-fix" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                            <div class="card-body text-center gambar">
                                <img src="<?= base_url('assets/'); ?>images/main_logo.png" alt="foto-profil" alt="" class="img-thumbnail img-fluid rounded-circle mb-3"><br>
                                <i class="fas fa-medal fa-2x" style="color:brown"></i><br>
                                <h6 style="margin:10px;">Belum Ada Data</h6>
                                <hr>
                                <span>Total Skor : </span><span class="font-weight-bold counter3">0</span>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- </div> -->
                </div>
            </div>
    </section>
    <!-- ***** Top 3 Caddy End ***** -->

    <!-- ***** Frequently Question Start ***** -->
    <section class="section mt-5 mb-3" id="caddy-tabel">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading mb-3 text-center mt-3">
                        <h4>Kinerja Semua Caddy</h4>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table id="data-caddy" class="row-border align-middle text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">Peringkat</th>
                                <th width="10%">Foto</th>
                                <th width="40%">Nama</th>
                                <th width="10">Skor Absen</th>
                                <th width="10">Skor Dilapangan</th>
                                <th width="15">Total Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = "1";
                            foreach ($kinerja_caddy->result() as $k) { ?>
                                <tr>
                                    <td>
                                        <?php if ($i == "1") { ?>
                                            <i class="fas fa-medal fa-2x text-warning"></i>
                                        <?php } else if ($i == "2") { ?>
                                            <i class="fas fa-medal fa-2x text-muted"></i>
                                        <?php } else if ($i == "3") { ?>
                                            <i class="fas fa-medal fa-2x" style="color:brown"></i>
                                        <?php } else {
                                            echo $i;
                                        } ?>
                                    </td>
                                    <td>
                                        <img src="<?= base_url('assets/'); ?>images/profil/<?= $k->foto; ?>" alt="foto-profil" alt="" class=" img-fluid rounded-circle w-50">
                                    </td>
                                    <td>
                                        <?= $k->nama; ?>
                                    </td>
                                    <td>
                                        <?= $k->skor_absen; ?>
                                    </td>
                                    <td>
                                        <?= $k->skor_turun; ?>
                                    </td>
                                    <td>
                                        <?= $k->total_skor; ?>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Frequently Question End ***** -->


    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row mb-0">
                <div class="col-lg-7 col-md-12 col-sm-12 d-flex align-items-center">
                    <p class="copyright">Copyright &copy; <?= date("Y"); ?> PT. Damai Indah Golf</p>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <ul class="social">
                        <li> <img src="<?= base_url('assets/'); ?>images/LogoDamaiIndahGolf.png" alt="foto-profil" alt="" class=" img-fluid w-25 mb-3"></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?= base_url('assets/users-template/'); ?>js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?= base_url('assets/users-template/'); ?>js/popper.js"></script>
    <script src="<?= base_url('assets/users-template/'); ?>js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="<?= base_url('assets/users-template/'); ?>js/owl-carousel.js"></script>
    <script src="<?= base_url('assets/users-template/'); ?>js/scrollreveal.min.js"></script>
    <script src="<?= base_url('assets/users-template/'); ?>js/waypoints.min.js"></script>
    <script src="<?= base_url('assets/users-template/'); ?>js/jquery.counterup.min.js"></script>
    <script src="<?= base_url('assets/users-template/'); ?>js/imgfix.min.js"></script>
    <script src="<?= base_url('assets/flip-clock/'); ?>jquery.flipcountdown.js"></script>

    <!-- Global Init -->
    <script src="<?= base_url('assets/users-template/'); ?>js/custom.js"></script>
    <script src="<?= base_url('assets/users-template/'); ?>js/jquery.dataTables.min.js"></script>
    <?php
    $batas = date("m/d/Y", mktime(0, 0, 0, date("m") + 1, date("1"), date("Y")));
    ?>
    <script>
        jQuery(function($) {
            $('#retroclockbox1').flipcountdown({
                size: "sm",
                beforeDateTime: "<?= $batas; ?> 00:00:01"
            });
        });

        $(document).ready(function() {
            $(".counter1").counterUp({
                delay: 50,
                time: 3000,
            });

            $(".counter2").counterUp({
                delay: 25,
                time: 3000,
            });

            $(".counter3").counterUp({
                delay: 10,
                time: 3000,
            });

            $('#data-caddy').DataTable({
                "scrollX": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }]
            });
        });
    </script>
</body>

</html>