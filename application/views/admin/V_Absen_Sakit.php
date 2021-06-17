        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-calendar-remove"></i>
                        </span> Data Absen Caddy Sakit
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
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Absen Caddy Sakit </h4>
                                <div class="table-responsive">
                                    <a href="<?= base_url('CaddyMaster/AddAbsenSakit'); ?>">
                                        <button type="button" class="btn btn-gradient-success btn-icon-text mb-3 mt-3">
                                            <i class="mdi mdi-calendar-plus btn-icon-prepend"></i> Tambah Absen Sakit</button>
                                    </a>
                                    <table class="table w-100 table table-striped" id="table-caddy-sakit">
                                        <thead>
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="10%">Foto</th>
                                                <th width="40%">Nama</th>
                                                <th width="10%" class="text-center">NIP</th>
                                                <th width="10%" class="text-center">Tanggal</th>
                                                <th width="5%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show_data">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->