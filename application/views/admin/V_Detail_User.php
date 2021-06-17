        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-account"></i>
                        </span> Detail Data User
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle ml-1"></i>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="row" id="addcaddy-page">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data User</h4>
                                <p class="card-description"> Data yang ditampilkan tidak dapat diubah </p>
                                <form class="forms-sample">
                                    <?php
                                    foreach ($data_caddy->result() as $c) :
                                    ?>
                                        <div class="text-center">
                                            <img src="<?= base_url(); ?>assets/images/profil/<?= $c->foto; ?>" class="img-fluid rounded-circle" style="width:100px;height:100px">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control input-data" value="<?= $c->nama; ?>" placeholder="Name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="usernamename">Username</label>
                                            <input type="text" class="form-control" value="<?= $c->username; ?>" placeholder="Username" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="lv">Tingkat Akses</label>
                                            <input type="text" class="form-control" value="<?php if ($c->roll == "1") {
                                                                                                echo "Caddy Master";
                                                                                            } else {
                                                                                                echo "Golf Operational Manager";
                                                                                            } ?>" min="0" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nipcaddy">NIP</label>
                                            <input type="number" class="form-control" value="<?= $c->nip; ?>" placeholder="NIP" min="0" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" value="<?= $c->email; ?>" disabled>
                                        </div>
                                    <?php endforeach; ?>
                                    <button type="button" onclick="history.back();" class="btn btn-gradient-danger btn-fw text-center mt-2">Kembali</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->