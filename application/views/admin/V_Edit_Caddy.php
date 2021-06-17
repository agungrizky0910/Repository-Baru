        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-account-edit"></i>
                        </span> Edit Data Caddy
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
                                <h4 class="card-title">Formulir Edit Data Caddy</h4>
                                <p class="card-description"> Lengkapi Data Sesuai Kolom Yang Disediakan </p>
                                <form class="forms-sample" id="addcaddy-form" method="post" action="" enctype="multipart/form-data">
                                    <?php
                                    foreach ($data_caddy->result() as $c) :
                                    ?>
                                        <div class="text-center" id="foto-profil">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control input-data" value="<?= $c->nama; ?>" id="nama" name="nama" placeholder="Name" required>
                                            <div id="statusNama"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fingerprint">ID Fingerprint</label>
                                            <input type="number" class="form-control" id="fingerprint" value="<?= $c->id_fingerprint; ?>" name="fingerprint" placeholder="ID Fingerprint" min="0" required disabled>
                                            <div id="statusFP"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nipcaddy">NIP</label>
                                            <input type="number" class="form-control" id="nipcaddy" value="<?= $c->nip; ?>" name="nip" placeholder="NIP" min="0" required disabled>
                                            <div id="statusNIP"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" value="<?= $c->email; ?>" name="email" id="email" placeholder="Email" required>
                                            <div id="statusEmail"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control" id="gender" name="gender" required>
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
                                            <label>Pas Foto</label>
                                            <input type="file" name="pasfoto" class="file-upload-default" accept=".jpg, .jpeg, .png" id="input-foto">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" id="text-foto" required>
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp">No. Telepon</label>
                                            <input type="number" value="<?= $c->tlp; ?>" class="form-control" name="tlp" id="tlp" placeholder="Nomer Telepon" min="0" required>
                                            <div id="statusTlp"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" rows="4" required><?= $c->alamat; ?></textarea>
                                            <div id="statusAlamat"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp">Tanggal Bergabung</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control date-picker-input" value="<?= $c->bergabung; ?>" name="tgl" id="tanggal" placeholder="DD/MM/YYYY" aria-describedby="basic-addon2" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-gradient-primary ui-datepicker-current" type="button"><i class="mdi mdi-calendar-month"></i> Hari ini</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-gradient-primary mr-2 mt-2">Simpan</button>
                                    <button type="button" onclick="history.back();" class="btn btn-gradient-danger btn-fw mt-2">Kembali</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->