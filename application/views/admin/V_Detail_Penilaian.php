        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-playlist-edit"></i>
                        </span> Detail Penilaian
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
                                <div class="row">
                                    <div class="col-md-2 justify-content-center align-self-center text-center">
                                        <img class="m-2 img-fluid rounded-circle w-75" src="<?= base_url(); ?>assets/images/profil/<?= $foto; ?>">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <table class="w-100" cellpadding="5px">
                                                <tr>
                                                    <td>
                                                        Nama
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <?= $nama_caddy; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        NIP
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <?= $nip_caddy; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        ID Fingerprint
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <?= $fp; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Periode Penilaian
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td>
                                                        <?= periode($periode); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Penilaian Caddy</h4>
                                <div class="table-responsive">
                                    <table class="table w-100 table table-striped" id="nilai-caddy">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Penilaian</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show_data">
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" onclick="history.back();" class="btn btn-gradient-danger btn-fw mt-2">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->