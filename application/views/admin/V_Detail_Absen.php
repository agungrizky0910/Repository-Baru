        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-calendar-clock"></i>
                        </span> Detail Absen
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
                                                        Jumlah Absen
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td id="total-absen">
                                                        <?= $total_absen; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Sakit</td>
                                                    <td>:</td>
                                                    <td id="total-sakit"><?= $total_sakit; ?></td>
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
                                <h4 class="card-title">Absen Caddy</h4>
                                <div class="mb-2 d-flex justify-content-center">
                                    <div>
                                        <select name="bulan" class="form-control mr-2 w-auto" id="BulanAbsen">
                                            <?php $bulan_absen = $this->session->userdata('AbsenBulan'); ?>
                                            <option value="01" <?= ($bulan_absen == "01") ? 'selected' : ''; ?>>Januari</option>
                                            <option value="02" <?= ($bulan_absen == "02") ? 'selected' : ''; ?>>Februari</option>
                                            <option value="03" <?= ($bulan_absen == "03") ? 'selected' : ''; ?>>Maret</option>
                                            <option value="04" <?= ($bulan_absen == "04") ? 'selected' : ''; ?>>April</option>
                                            <option value="05" <?= ($bulan_absen == "05") ? 'selected' : ''; ?>>Mei</option>
                                            <option value="06" <?= ($bulan_absen == "06") ? 'selected' : ''; ?>>Juni</option>
                                            <option value="07" <?= ($bulan_absen == "07") ? 'selected' : ''; ?>>Juli</option>
                                            <option value="08" <?= ($bulan_absen == "08") ? 'selected' : ''; ?>>Agustus</option>
                                            <option value="09" <?= ($bulan_absen == "09") ? 'selected' : ''; ?>>September</option>
                                            <option value="10" <?= ($bulan_absen == "10") ? 'selected' : ''; ?>>Oktober</option>
                                            <option value="11" <?= ($bulan_absen == "11") ? 'selected' : ''; ?>>November</option>
                                            <option value="12" <?= ($bulan_absen == "12") ? 'selected' : ''; ?>>Desember</option>
                                        </select>
                                    </div>
                                    <div>
                                        <select name="tahun" class="form-control mr-2" id="TahunAbsen">
                                            <?php
                                            $tahun_absen = $this->session->userdata('AbsenTahun');
                                            $now = new DateTime();
                                            $year_now = $now->format("Y");
                                            ?>
                                            <?php foreach ($tahun->result() as $t) { ?>
                                                <option value="<?= $t->periode; ?>" <?= ($t->periode == $year_now) ? 'selected' : ''; ?>><?= $t->periode; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table w-100" id="detail-absen-caddy">
                                        <thead>
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="50%">Tanggal</th>
                                                <th width="20%" class="text-center">Jam</th>
                                                <th width="20%" class="text-center">Status</th>
                                                <th width="5%" class="text-center">Aksi</th>
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