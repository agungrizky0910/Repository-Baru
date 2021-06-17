        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-calendar-plus"></i>
                        </span> Tambah Data Absen
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle ml-1"></i>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Absen Caddy</h4>
                                <p class="card-description"> Upload Data Absen Dengan Format Yang Sudah Ditentukan </p>
                                <form class="forms-sample" id="import_form" enctype="multipart/form-data" action="" method="post">
                                    <div class="form-group">
                                        <label>File Absensi</label>
                                        <input type="file" name="file" class="file-upload-default" id="file" accept=".xls, .xlsx">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Absen" id="file_named">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                        <span class="card-description">Extensi yang diperbolehkan *xls *xlsx</span>
                                    </div>
                                    <br />

                                    <div class="table-responsive" id="absen_data">

                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary mr-2 mt-2">Upload File Absen</button>
                                    <button type="button" class="btn btn-gradient-primary mt-2" onclick="location.href='<?= base_url(); ?>assets/download/skema-absen.xlsx'">Download Contoh File Skema XLSX</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kosongkan Data Absen</h4>
                                <p class="card-description"> Mengosongkan Data Absensi Sesuai Periode Yang Ditentukan </p>
                                <form class="forms-sample" id="hapus_form" action="" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bulan">Bulan</label>
                                                <select class="form-control" name="bulan" id="bulan">
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="11">Desmeber</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tahun">Tahun</label>
                                                <select class="form-control" name="tahun" id="tahun">
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-gradient-primary" name="hapus" style="margin-top:24px">Hapus Absen</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->