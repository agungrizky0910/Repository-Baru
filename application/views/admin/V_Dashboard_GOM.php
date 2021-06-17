        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-home"></i>
                        </span> Dashboard
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
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?= base_url('assets/admin-template/'); ?>images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Kinerja Caddy Bulan Ini<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5"><?= $kinerja->totals; ?></h2>
                                <h6 class="card-text">
                                    <?php
                                    if ($p_kinerja->totals != 0) {
                                        $hasil = (($kinerja->totals - $p_kinerja->totals) / $p_kinerja->totals) * 100;
                                        if ($p_kinerja->totals > $kinerja->totals) {
                                            echo "Penurunan " . ceil(abs($hasil)) . "%";
                                        } else if ($p_kinerja->totals < $kinerja->totals) {
                                            echo "Peningkatan " . ceil($hasil) . "%";
                                        }
                                    } else {
                                        echo "Peningkatan " . $kinerja->totals . "%";
                                    }
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?= base_url('assets/admin-template/'); ?>images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Caddy Terbaik Bulan Ini<i class="mdi mdi-medal mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5"><?= $caddy_terbaik->top; ?></h2>
                                <h6 class="card-text"><?= $caddy_terbaik->nama; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="<?= base_url('assets/admin-template/'); ?>images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Jumlah Caddy <i class="mdi mdi-account-group-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5"><?= $total_caddy->total; ?></h2>
                                <h6 class="card-text"></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix">
                                    <h4 class="card-title float-left">Statistik Kinerja Caddy Tahun <?= date("Y"); ?></h4>
                                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                                </div>
                                <canvas id="visit-sale-chart" class="mt-4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Penilaian Caddy</h4>
                                <canvas id="traffic-chart"></canvas>
                                <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Laporan Siap Cetak</h4>
                                <div class="table-responsive">
                                    <table class="table w-100" id="penilaian">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Periode Laporan Penlilaian </th>
                                                <th class="text-center"> Total Penilaian </th>
                                                <th class="text-center"> Status </th>
                                                <th class="text-center"> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = "1";
                                            foreach ($periode_laporan->result() as $p) {
                                                $cek_p = $this->Apps->get_where('t_laporan', ['stat_laporan' => 'LM', 'periode_laporan' => $p->periode_laporan])->num_rows();
                                                if ($cek_p == 0) {
                                                    $data_lap = $this->Apps->get_select_where('periode_laporan, COUNT(id_laporan) as total', 't_laporan', ['stat_laporan' => 'LS', 'periode_laporan' => $p->periode_laporan])->row();
                                            ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?= $i; ?>
                                                        </td>
                                                        <td>
                                                            <?= periode($data_lap->periode_laporan); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $data_lap->total; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            Sudah Disetujui
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            $periode = strtotime($data_lap->periode_laporan);
                                                            $tahun = date('Y', $periode);
                                                            $bulan = date('m', $periode);
                                                            ?>
                                                            <a href="<?= base_url('Manager/CetakSemua/') . $bulan . '/' . $tahun; ?>" target="_blank">
                                                                <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Cetak Semua"><i class="mdi mdi-printer md-24"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->