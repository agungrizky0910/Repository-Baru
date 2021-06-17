        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-account"></i>
                        </span> Detail Data Caddy
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
                                <h4 class="card-title">Data Caddy</h4>
                                <p class="card-description"> Data yang ditampilkan tidak dapat diubah </p>
                                <form class="forms-sample">
                                    <?php
                                    foreach ($data_caddy->result() as $c) :
                                    ?>
                                        <div class="text-center">
                                            <img src="<?= base_url(); ?>assets/images/profil/<?= $c->foto; ?>" class="img-fluid rounded-circle" style="width: 100px;height: 100px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control input-data" value="<?= $c->nama; ?>" laceholder="Name" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="fingerprint">ID Fingerprint</label>
                                            <input type="number" class="form-control" value="<?= $c->id_fingerprint; ?>" min="0" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nipcaddy">NIP</label>
                                            <input type="number" class="form-control" value="<?= $c->nip; ?>" placeholder="NIP" min="0" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" value="<?= $c->email; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" disabled>
                                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                                <option value="L" <?php if ($c->jk == 'L') {
                                                                        echo 'selected';
                                                                    } ?>>Laki-laki</option>
                                                <option value="P" <?php if ($c->jk == 'P') {
                                                                        echo 'selected';
                                                                    } ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp">No. Telepon</label>
                                            <input type="number" class="form-control" name="tlp" id="tlp" value="<?= $c->tlp; ?>" placeholder="Nomer Telepon" min="0" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" rows="4" disabled><?= $c->alamat; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp">Tanggal Bergabung</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tgl" value="<?= short_date($c->bergabung); ?>" id="tanggal" placeholder="DD/MM/YYYY" aria-describedby="basic-addon2" disabled>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-gradient-primary ui-datepicker-current" type="button"><i class="mdi mdi-calendar-month" disabled></i> Hari ini</button>
                                                </div>
                                            </div>
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