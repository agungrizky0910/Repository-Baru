        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-account-edit"></i>
                        </span> Edit Profil
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle ml-1"></i>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="row" id="edit-page">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Formulir Edit Profil</h4>
                                <p class="card-description"> Lengkapi Data Sesuai Kolom Yang Disediakan </p>
                                <form class="forms-sample" id="edit-form" method="post" action="" enctype="multipart/form-data">
                                    <?php
                                    foreach ($data_user->result() as $c) :
                                    ?>
                                        <div class="text-center" id="foto-profil">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control input-data" value="<?= $c->nama; ?>" id="nama" name="nama" placeholder="Name" required>
                                            <div id="statusNama"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nipuser">NIP</label>
                                            <input type="number" class="form-control" id="nipuser" value="<?= $c->nip; ?>" name="nip" placeholder="NIP" min="0" required disabled>
                                            <div id="statusNIP"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" value="<?= $c->email; ?>" name="email" id="email" placeholder="Email" required>
                                            <div id="statusEmail"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Profil</label>
                                            <input type="file" name="foto" class="file-upload-default" accept=".jpg, .jpeg, .png" id="input-foto">
                                            <div class="input-group col-xs-12 mb-4">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" id="text-foto" required>
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div>
                                        <hr />
                                        <p class="card-description"> Jika ingin mengubah password, silahkan lengkapi form berikut </p>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" value="<?= $c->username; ?>"" placeholder=" username" required disabled>
                                            <div id="statusUSER"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Level Akses</label>
                                            <select class="form-control" disabled>
                                                <option <?php if ($c->roll == '1') {
                                                            echo 'selected';
                                                        } ?>>Caddy Master</option>)></option>
                                                <option <?php if ($c->roll == '2') {
                                                            echo 'selected';
                                                        } ?>>Golf Operational Manager</option>)></option>
                                                <option <?php if ($c->roll == '3') {
                                                            echo 'selected';
                                                        } ?>>Administrator</option>)></option>
                                            </select>
                                            <div id="statusUSER"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password1">Ubah Password</label>
                                            <input type="password" class="form-control" name="password1" id="password1" placeholder="">
                                            <div id="statusPassword1"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Ulangi Password</label>
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="">
                                            <div id="statusPassword2"></div>
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