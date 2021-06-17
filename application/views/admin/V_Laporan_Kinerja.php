        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-book-education-outline"></i>
                        </span> Data Kinerja Caddy
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
                                <h4 class="card-title">Kinerja Caddy</h4>
                                <div class="mb-2 d-flex justify-content-center">
                                    <div>
                                        <?php
                                        $now = new DateTime();
                                        $year_now = $now->format("Y");
                                        $month_now = $now->format("m");
                                        ?>
                                        <select name="bulan" class="form-control mr-2 w-auto" id="BulanNilai">
                                            <option value="01" <?= ($month_now == "01") ? 'selected' : ''; ?>>Januari</option>
                                            <option value="02" <?= ($month_now == "02") ? 'selected' : ''; ?>>Februari</option>
                                            <option value="03" <?= ($month_now == "03") ? 'selected' : ''; ?>>Maret</option>
                                            <option value="04" <?= ($month_now == "04") ? 'selected' : ''; ?>>April</option>
                                            <option value="05" <?= ($month_now == "05") ? 'selected' : ''; ?>>Mei</option>
                                            <option value="06" <?= ($month_now == "06") ? 'selected' : ''; ?>>Juni</option>
                                            <option value="07" <?= ($month_now == "07") ? 'selected' : ''; ?>>Juli</option>
                                            <option value="08" <?= ($month_now == "08") ? 'selected' : ''; ?>>Agustus</option>
                                            <option value="09" <?= ($month_now == "09") ? 'selected' : ''; ?>>September</option>
                                            <option value="10" <?= ($month_now == "10") ? 'selected' : ''; ?>>Oktober</option>
                                            <option value="11" <?= ($month_now == "11") ? 'selected' : ''; ?>>November</option>
                                            <option value="12" <?= ($month_now == "12") ? 'selected' : ''; ?>>Desember</option>
                                        </select>
                                    </div>
                                    <div>
                                        <select name="tahun" class="form-control mr-2" id="TahunNilai">

                                            <?php foreach ($periode_nilai->result() as $p) {
                                                $tahun = strtotime($p->periode);
                                                $periode = date('Y', $tahun);
                                            ?>
                                                <option value="<?= $periode; ?>" <?= ($periode == $year_now) ? 'selected' : ''; ?>><?= $periode; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table w-100 table table-striped" id="kinerja">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th class="text-center">NIP</th>
                                                <th class="text-center">Total Skor</th>
                                                <th class="text-center">Periode</th>
                                                <th class="text-center">Catatan</th>
                                                <th class="text-center">Aksi</th>
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