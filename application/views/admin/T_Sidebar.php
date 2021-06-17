 <div class="container-fluid page-body-wrapper">
     <!-- partial:sidebar -->
     <nav class="sidebar sidebar-offcanvas" id="sidebar">
         <ul class="nav">
             <li class="nav-item nav-profile">
                 <a href="<?php echo base_url();
                            if ($this->session->userdata('level') == 'CaddyMaster') {
                                echo 'CaddyMaster/';
                            } else if ($this->session->userdata('level') == 'GOManager') {
                                echo 'Manager/';
                            } else if ($this->session->userdata('level') == 'Admin') {
                                echo 'Admin/';
                            } ?>Profil" class="nav-link">
                     <div class="nav-profile-image" id="side-profil">
                         <img src="<?= base_url('assets/images/profil/') . $this->session->userdata('foto'); ?>" alt="profile">
                         <span class="login-status online"></span>
                         <!--change to offline or busy as needed-->
                     </div>
                     <div class="nav-profile-text d-flex flex-column">
                         <span class="font-weight-bold mb-2" id="side-nama"><?= custome_wordlimit($this->session->userdata('nama'), 15); ?></span>
                         <span class="text-secondary text-small"><?php if ($this->session->userdata('level') == 'CaddyMaster') {
                                                                        echo 'Caddy Master';
                                                                    } else if ($this->session->userdata('level') == 'GOManager') {
                                                                        echo 'GO Manager';
                                                                    } else if ($this->session->userdata('level') == 'Admin') {
                                                                        echo 'Administrator';
                                                                    } ?></span>
                     </div>
                     <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                 </a>
             </li>
             <?php
                if ($this->session->userdata('level') == 'CaddyMaster') {
                ?>
                 <li class="nav-item <?php if ($title == 'Home') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" href="<?= base_url('CaddyMaster'); ?>">
                         <span class="menu-title">Dashboard</span>
                         <i class="mdi mdi-home menu-icon"></i>
                     </a>
                 </li>
                 <li class="nav-item <?php if ($title == 'Data Caddy' || $title == 'Tambah Data Caddy' || $title == 'Edit Data Caddy') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" data-toggle="collapse" href="#data-caddy" aria-expanded="false" aria-controls="data-caddy">
                         <span class="menu-title">Data Caddy</span>
                         <i class="menu-arrow"></i>
                         <i class="mdi mdi-account menu-icon"></i>
                     </a>
                     <div class="collapse <?php if ($title == 'Data Caddy' || $title == 'Tambah Data Caddy' || $title == 'Edit Data Caddy') {
                                                echo 'show';
                                            } ?>" id="data-caddy">
                         <ul class="nav flex-column sub-menu">
                             <li class="nav-item"> <a class="nav-link all-user <?php if ($title == 'Data Caddy' || $title == 'Edit Data Caddy') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('CaddyMaster/DataCaddy'); ?>">Semua Caddy</a></li>
                             <li class="nav-item"> <a class="nav-link add-user <?php if ($title == 'Tambah Data Caddy') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('CaddyMaster/AddCaddy'); ?>">Tambah Caddy</a></li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item <?php if ($title == 'Data Absen Caddy' || $title == 'Detail Data Absen Caddy' || $title == 'Tambah Data Absen Caddy' || $title == 'Absen Sakit' || $title == 'Tambah Absen Sakit') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" data-toggle="collapse" href="#data-absen" aria-expanded="false" aria-controls="data-absen">
                         <span class="menu-title">SCHEDULE KALIBRASI</span>
                         <i class="menu-arrow"></i>
                         <i class="mdi mdi-calendar-edit menu-icon"></i>
                     </a>
                     <div class="collapse <?php if ($title == 'Data Absen Caddy' || $title == 'Detail Data Absen Caddy' || $title == 'Tambah Data Absen Caddy' || $title == 'Absen Sakit' || $title == 'Tambah Absen Sakit') {
                                                echo 'show';
                                            } ?>" id="data-absen">
                         <ul class="nav flex-column sub-menu">
                             <li class="nav-item"> <a class="nav-link add-absen <?php if ($title == 'Data Absen Caddy' || $title == 'Detail Data Absen Caddy' || $title == 'Tambah Data Absen Caddy') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('CaddyMaster/AbsenCaddy'); ?>">SCHEDULE KALIBRASI BULAN INI</a></li>
                             <li class="nav-item"> <a class="nav-link sick-absen <?php if ($title == 'Absen Sakit' || $title == 'Tambah Absen Sakit') {
                                                                                        echo 'active';
                                                                                    } ?>" href="<?= base_url('CaddyMaster/AbsenSakit'); ?>">Caddy Sakit</a></li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item <?php if ($title == 'Penilaian Belum Dinilai' || $title == 'Detail Penilaian' || $title == 'Penilaian Sudah Dinilai' || $title == 'Detail Penilaian Selesai') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" data-toggle="collapse" href="#penilaian" aria-expanded="false" aria-controls="penilaian">
                         <span class="menu-title">ON PROCES</span>
                         <i class="menu-arrow"></i>
                         <i class="mdi mdi-clipboard-list menu-icon"></i>
                     </a>
                     <div class="collapse <?php if ($title == 'Penilaian Belum Dinilai' || $title == 'Detail Penilaian' || $title == 'Penilaian Sudah Dinilai' || $title == 'Detail Penilaian Selesai') {
                                                echo 'show';
                                            } ?>" id="penilaian">
                         <ul class="nav flex-column sub-menu">
                             <li class="nav-item"> <a class="nav-link not-yet <?php if ($title == 'Penilaian Belum Dinilai' || $title == 'Detail Penilaian') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('CaddyMaster/BelumDinilai'); ?>">ON PROCESS KALIBRASI</a></li>
                             <li class="nav-item "> <a class="nav-link already-assessed <?php if ($title == 'Penilaian Sudah Dinilai' || $title == 'Detail Penilaian Selesai') {
                                                                                            echo 'active';
                                                                                        } ?>" href="<?= base_url('CaddyMaster/SudahDinilai'); ?>">DONE PROCESS KALIBRASI</a></li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item <?php if ($title == 'Laporan Penilaian' || $title == 'Detail Laporan Penilaian') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" href="<?= base_url('CaddyMaster/Laporan'); ?>">
                         <span class="menu-title">Laporan</span>
                         <i class="mdi mdi-file-chart menu-icon"></i>
                     </a>
                 </li>
             <?php } else if ($this->session->userdata('level') == 'GOManager') { ?>
                 <li class="nav-item <?php if ($title == 'Home') {
                                            echo 'active';
                                        } ?>"">
                     <a class=" nav-link " href=" <?= base_url('Manager'); ?>">
                     <span class="menu-title ">Dashboard</span>
                     <i class="mdi mdi-home menu-icon"></i>
                     </a>
                 </li>
                 <li class="nav-item <?php if ($title == 'Laporan Belum Disetujui' || $title == 'Laporan Disetujui' || $title == 'Detail Laporan Penilaian Menunggu' || $title == 'Detail Laporan Penilaian Selesai') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" data-toggle="collapse" href="#datalaporan" aria-expanded="false" aria-controls="datalaporan">
                         <span class="menu-title">Data Laporan</span>
                         <i class="menu-arrow"></i>
                         <i class="mdi mdi-book-edit-outline menu-icon"></i>
                     </a>
                     <div class="collapse <?php if ($title == 'Laporan Belum Disetujui' || $title == 'Laporan Sudah Disetujui' || $title == 'Detail Laporan Penilaian Menunggu' || $title == 'Detail Laporan Penilaian Selesai') {
                                                echo 'show';
                                            } ?>" id="datalaporan">
                         <ul class="nav flex-column sub-menu">
                             <li class="nav-item"> <a class="nav-link lap-wait <?php if ($title == 'Laporan Belum Disetujui' || $title == 'Detail Laporan Penilaian Menunggu') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('Manager/LaporanMenunggu'); ?>">MENUNGGU JUDGMENT</a></li>
                             <li class="nav-item"> <a class="nav-link lap-done <?php if ($title == 'Laporan Sudah Disetujui' || $title == 'Detail Laporan Penilaian Selesai') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('Manager/LaporanSelesai'); ?>">SELESAI KALIBRASI</a></li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item <?php if ($title == 'Laporan Kinerja Caddy' || $title == 'Detail Laporan Penilaian') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" href="<?= base_url('Manager/LaporanKinerja'); ?>">
                         <span class="menu-title">LAPORAN</span>
                         <i class="mdi mdi-book-education-outline menu-icon"></i>
                     </a>
                 </li>
             <?php } else if ($this->session->userdata('level') == 'Admin') { ?>
                 <li class="nav-item <?php if ($title == 'Data User' || $title == 'Tambah Data User' || $title == 'Edit Data User') {
                                            echo 'active';
                                        } ?>">
                     <a class="nav-link" data-toggle="collapse" href="#data-user" aria-expanded="false" aria-controls="data-user">
                         <span class="menu-title">Data User</span>
                         <i class="menu-arrow"></i>
                         <i class="mdi mdi-account menu-icon"></i>
                     </a>
                     <div class="collapse <?php if ($title == 'Data User' || $title == 'Tambah Data User' || $title == 'Edit Data User') {
                                                echo 'show';
                                            } ?>" id="data-user">
                         <ul class="nav flex-column sub-menu">
                             <li class="nav-item"> <a class="nav-link all-user <?php if ($title == 'Data User' || $title == 'Edit Data User') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('Admin/'); ?>">Semua User</a></li>
                             <li class="nav-item"> <a class="nav-link add-user <?php if ($title == 'Tambah Data User') {
                                                                                    echo 'active';
                                                                                } ?>" href="<?= base_url('Admin/AddUser'); ?>">Tambah User</a></li>
                         </ul>
                     </div>
                 </li>
             <?php } ?>
         </ul>
     </nav>
     <!-- partial -->