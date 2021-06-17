        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-calendar-clock"></i>
                        </span> Schedule Kalibrasi
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
                                <h4 class="card-title">Data Schedule Kalibrasi</h4>
                                <div class="table-responsive">
                                    <a href="<?= base_url('CaddyMaster/AddAbsen'); ?>">
                                        <button type="button" class="btn btn-gradient-success btn-icon-text mb-3 mt-3">
                                            <i class="mdi mdi-calendar-plus btn-icon-prepend"></i> Tambah Schedule </button>
                                    </a>
                                    <table class="table w-100 table table-striped" id="absen-caddy">
                                        <thead>
                                            <tr>
                                            <!-- <th width="5%">No.</th>
                                                <th width="10%">Nama Alat</th>
                                                <th width="50%">Merk/Type</th>
                                                <th width="50%">Range/Resolusi</th>
                                                <th width="50%">No Seri</th>
                                                <th width="50%">Pemegang</th>
                                                <th width="50%">Dept</th>
                                                <th width="50%">No Registrasi</th>
                                                <th width="50%">Tgl Kalibrasi</th>
                                                <th width="50%">Status</th> -->
                                                <th width="5%">No.</th>
                                                <th width="10%">Foto</th>
                                                <th width="50%">Nama</th>
                                                <th width="20%" class="text-center">NIP</th>
                                                <th width="10%" class="text-center">Absen Bulan Ini</th>
                                                <th width="5%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($absen->result() as $hasil) : ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?= $i; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <img src="<?= base_url('assets/'); ?>images/profil/<?= $hasil->foto; ?>" class="mr-2" alt="image">
                                                    </td>
                                                    <td><?= $hasil->nama; ?></td>
                                                    <td class="text-center">
                                                        <?= $hasil->nip; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $tanggal = date('Y-m');
                                                        $cek_absen = $this->Apps->select_get_like_where('COUNT(id_absen) as total', 't_absen', ['id_fingerprint' => $hasil->id_fingerprint, 'stat' => 'M'], 'tanggal', $tanggal)->row();
                                                        echo $cek_absen->total;
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('CaddyMaster/DetailAbsen/') . encode($hasil->nip); ?>">
                                                            <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Lihat Absen"><i class="mdi mdi-account-search md-24"></i></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->