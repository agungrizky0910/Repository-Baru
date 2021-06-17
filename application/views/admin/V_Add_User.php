        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-account-plus"></i>
                        </span> Tambah Data User
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle ml-1"></i>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="row" id="adduser-page">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Formulir Tambah Data User</h4>
                                <p class="card-description"> Lengkapi Data Sesuai Kolom Yang Disediakan </p>
                                <form class="forms-sample" id="adduser-form" method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control input-data" value="" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                        <div id="statusNama"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nipcaddy">NIP</label>
                                        <input type="number" class="form-control" id="nipuser" value="" name="nip" placeholder="NIP" min="0" required>
                                        <div id="statusNIP"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" value="" name="email" id="email" placeholder="Email" required>
                                        <div id="statusEmail"></div>
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
                                        <label for="level">Level Akses</label>
                                        <select class="form-control" id="level" name="level" required>
                                            <option value="" selected disabled>Pilih Level</option>
                                            <option value="1">Caddy Master</option>
                                            <option value="2">Golf Operational Manager</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                        <div id="statusUsername"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                                        <div id="statusPassword"></div>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary mr-2 mt-2">Simpan</button>
                                    <button type="button" onclick="history.back();" class="btn btn-gradient-danger btn-fw mt-2">Kembali</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->