        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-calendar-remove"></i>
                        </span> Tambah Absen Sakit
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
                                <h4 class="card-title">Formulir Tambah Absen Caddy Sakit</h4>
                                <p class="card-description"> Lengkapi Data Sesuai Kolom Yang Disediakan </p>
                                <form class="forms-sample" method="post" action="" id="absen-sakit-form">
                                    <div class="form-group">
                                        <label for="caddy">Pilih Caddy</label>
                                        <select class="form-control select-option" name="caddy" id="caddy">
                                            <option value=""></option>
                                            <?php foreach ($data_caddys->result() as $dc) : ?>
                                                <option value="<?= $dc->id_fingerprint; ?>"><?= $dc->nama . ' - ' . $dc->nip; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl">Tanggal Sakit</label>
                                        <div class="input-group">
                                            <input type="text" id="tgl" name="tanggal" class="form-control date-picker-input" placeholder="YYYY-MM-DD" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-gradient-primary ui-datepicker-current" type="button"><i class="mdi mdi-calendar-month"></i> Hari ini</button>
                                            </div>
                                        </div>
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