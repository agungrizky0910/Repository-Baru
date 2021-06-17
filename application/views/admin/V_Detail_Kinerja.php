        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="mdi mdi-notebook-multiple"></i>
                        </span> Detail Kinerja
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
                                                        ID Fingerpint
                                                    </td>
                                                    <td>
                                                        :
                                                    </td>
                                                    <td id="total-absen">
                                                        <?= $fp; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Bergabung</td>
                                                    <td>:</td>
                                                    <td id="total-sakit"><?= short_date($bergabung); ?></td>
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
                                <h4 class="card-title">Kinerja Caddy</h4>
                                <div class="table-responsive">
                                    <?php foreach ($kinerja->result() as $k) : ?>
                                        <table class="tabel-penilaian" cellpadding="10px" width="100%" border="1">
                                            <tr>
                                                <td class="text-center" rowspan="2" width="20%">
                                                    Poin Penilaian
                                                </td>
                                                <td class="text-center" colspan="4" height="50px">Absensi</td>
                                                <td class="text-center" rowspan="2">Total Duty</td>
                                                <td class="text-center" colspan="4">
                                                    Penilaian Customer (GolfPlayer)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Masuk</td>
                                                <td class="text-center">Alpa</td>
                                                <td class="text-center">Sakit</td>
                                                <td class="text-center">Terlambat</td>
                                                <td class="text-center">Poor</td>
                                                <td class="text-center">Average</td>
                                                <td class="text-center">Good</td>
                                                <td class="text-center">Excelent</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Jumlah</td>
                                                <td class="text-center"><?= $k->total_absen; ?></td>
                                                <td class="text-center"><?= $k->total_alpa; ?></td>
                                                <td class="text-center"><?= $k->total_sakit; ?></td>
                                                <td class="text-center"><?= $k->total_telat; ?></td>
                                                <td class="text-center"><?= $k->total_turun; ?></td>
                                                <td class="text-center"><?= $k->total_poor; ?></td>
                                                <td class="text-center"><?= $k->total_average; ?></td>
                                                <td class="text-center"><?= $k->total_good; ?></td>
                                                <td class="text-center"><?= $k->total_excellent; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Bobot Nilai</td>
                                                <td class="text-center">26/100</td>
                                                <td class="text-center">-10</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">-5</td>
                                                <td class="text-center">15</td>
                                                <td class="text-center">-10</td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">10</td>
                                                <td class="text-center">15</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Hasil</td>
                                                <td class="text-center"><?= $k->total_absen * 26 / 100; ?></td>
                                                <td class="text-center"><?= $k->total_alpa * -10; ?></td>
                                                <td class="text-center"><?= $k->total_sakit * 0; ?></td>
                                                <td class="text-center"><?= $k->total_telat * -5; ?></td>
                                                <td class="text-center"><?= $k->total_turun * 15; ?></td>
                                                <td class="text-center"><?= $k->total_poor * -10; ?></td>
                                                <td class="text-center"><?= $k->total_average * 5; ?></td>
                                                <td class="text-center"><?= $k->total_good * 10; ?></td>
                                                <td class="text-center"><?= $k->total_excellent * 15; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Total</td>
                                                <td class="text-center" colspan="9"><?= $k->total_skor; ?></td>
                                            </tr>
                                        </table>

                                        <table class="tabel-penilaian mt-4" style="outline-style: solid;outline-width: 0px;" cellpadding="10px" width="100%" border="1">
                                            <tr>
                                                <td style="border: none;">Catatan :</td>
                                            </tr>
                                            <tr>
                                                <td style="border: none;">
                                                    <?php if ($k->total_skor < 550) {
                                                        $catatan = "Mendapat SP";
                                                    } else {
                                                        $catatan = "Mendapat Insentif";
                                                    }
                                                    echo $catatan;
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" onclick="history.back();" class="btn btn-gradient-danger btn-fw mt-4">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->