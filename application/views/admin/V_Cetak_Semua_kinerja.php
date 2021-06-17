<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report Monthly </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/cetak/'); ?>vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/cetak/'); ?>vendors/css/vendor.bundle.base.css" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url('assets/cetak/'); ?>css/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/LogoDamaiIndahGolf.png" />
    <style>
        .center-middle-text {
            width: 300px;
            margin: 0;
            padding: 0;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
        }

        .tabel-penilaian tr td {
            text-align: center;
            vertical-align: middle;
        }

        .tabel-proved tr td {
            text-align: center;
        }

        .kolom1 {
            background-color: #626d8b;
        }

        .kolom2 {
            background-color: #c4b588;
        }

        .kolom3 {
            background-color: #5f8ab5;
        }

        .kolom4 {
            background-color: #a5b7af;
        }

        .kolom5 {
            background-color: #8f4108;
        }

        .poor {
            background-color: #ca431a;
        }

        .good {
            background-color: #cfc800;
        }

        .excelent {
            background-color: #447d2a;
        }

        .total {
            background-color: #5a3da3;
        }

        canvas {
            width: 400px !important;
            height: 200px !important;
        }
    </style>
</head>

<body>
    <?php
    $lap = "1";
    foreach ($kinerja->result() as $k) {
    ?>
        <div class="print">
            <div class="container-scroller m-5 border border-dark">
                <div class="row m-1">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <img class="m-1" src="<?= base_url('assets/cetak/'); ?>images/LogoDamaiIndahGolf.png" style="width: 80px" />
                                    </div>
                                    <div class="col-md-9 p-0 border border-dark border-bottom-0">
                                        <h4 class="center-middle-text">PT. DAMAI INDAH GOLF</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 border border-dark">
                                        <div class="text-center m-1">BSD Course - PIK Course</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 border border-dark border-left-0">
                                <h2 class="center-middle-text">Monthly Report</h2>
                            </div>
                        </div>
                        <div class="row mt-4 mb-3">
                            <div class="col-md-12 p-0">
                                <table width="100%" border="1" cellpadding="10px">
                                    <tr>
                                        <td width="20%">Report</td>
                                        <td width=" 30% "><?= $k->no_laporan; ?></td>
                                        <td colspan="2" width="50%" class="text-center"><?php echo date('F', strtotime($tahun . '-' . $bulan)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td><?= date('d/m/Y', strtotime($k->tgl_dibuat)) ?></td>
                                        <td class="text-center">Jumlah Hari</td>
                                        <td class="text-center">Jumlah Hari Libur</td>
                                    </tr>
                                    <tr>
                                        <td>Lampiran</td>
                                        <td>-</td>
                                        <td class="text-center"><?= cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); ?></td>
                                        <td class="text-center"><?= countDays($tahun, $bulan, ['0', '1', '3', '4', '5', '6',]); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4 mb-3">
                            <div class="col-md-12 p-0">
                                <table width="100%" border="1" cellpadding="10px">
                                    <tr>
                                        <td class="text-center gambar" rowspan="5" width="20%">
                                            <img class="img-fluid img-thumbnail rounded-circle m-1" src="<?= base_url('assets/'); ?>images/profil/<?= $k->foto; ?> " style="width: 90px" />
                                        </td>
                                        <td width=" 30% ">Nama</td>
                                        <td>: <?= $k->nama_caddy; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nik</td>
                                        <td>: <?= $k->nip; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>: <?= $k->jk; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>: Caddy Reguller</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Bergabung</td>
                                        <td>: <?= date('d/m/Y', strtotime($k->bergabung)) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 p-0">
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
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 p-0">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <canvas id="absensiChart<?= $lap; ?>"></canvas>
                                        <h4 class="card-title mt-2">Absensi</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <canvas id="nilaiChart<?= $lap; ?>"></canvas>
                                        <h4 class="card-title mt-2">Penilaian Customer</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 p-0">
                                <table>
                                    <tr>
                                        <td style="vertical-align: top">Grade :</td>
                                        <td>
                                            <ol>
                                                <li>Jika Total Nilai
                                                    < 350 maka mendapat Grade E</li>
                                                <li>Jika Total Nilai 350 - 400 maka mendapat Grade D</li>
                                                <li>Jika Total Nilai 401 - 550 maka mendapat Grade C</li>
                                                <li>Jika Total Nilai 551 - 670 maka mendapat Grade B</li>
                                                <li>Jika Total Nilai > 670 maka mendapat Grade A</li>
                                            </ol>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <table class="tabel-proved" cellpadding="10px" width="100%" border="1">
                                    <tr>
                                        <td class="align-top text-left border-bottom-0" width=" 30% ">
                                            note :
                                        </td>
                                        <td width=" 20% "></td>
                                        <td width=" 20% ">Made</td>
                                        <td width=" 20% ">Approved</td>
                                        <td width=" 10% ">Nilai</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4" class="align-top border-top-0 text-justify"> <?php if ($k->total_skor < 550) {
                                                                                                            $catatan = "Mendapat SP";
                                                                                                        } else {
                                                                                                            $catatan = "Mendapat Insentif";
                                                                                                        }
                                                                                                        echo $catatan;
                                                                                                        ?></td>
                                        <td>Date</td>
                                        <td><?= date('d/m/Y'); ?></td>
                                        <td><?= date('d/m/Y'); ?></td>
                                        <td rowspan=" 2 "><?= $k->total_skor; ?></td>
                                    </tr>
                                    <tr>
                                        <td rowspan=" 2 ">Signature</td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0" height="30px" style="color: #fff"></td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0"></td>
                                        <td class="border-top-0" height="30px" style="color: #fff"></td>
                                        <td rowspan=" 2 ">
                                            <h3 class="m-0">
                                                <?php if ($k->total_skor > 670) {
                                                    $grade = "A";
                                                } else if ($k->total_skor > 551 && $k->total_skor < 670) {
                                                    $grade = "B";
                                                } else if ($k->total_skor > 401 && $k->total_skor < 550) {
                                                    $grade = "C";
                                                } else if ($k->total_skor > 350 && $k->total_skor < 400) {
                                                    $grade = "D";
                                                } else if ($k->total_skor < 350) {
                                                    $grade = "E";
                                                }
                                                echo $grade; ?>
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <?= $k->nama_CM; ?>
                                        </td>
                                        <td><?= $this->session->userdata('nama'); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $lap++;
    } ?>

    <!-- plugins:js -->
    <script src="<?= base_url('assets/cetak/'); ?>vendors/js/vendor.bundle.base.js "></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url('assets/cetak/'); ?>vendors/chart.js/Chart.min.js "></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('assets/cetak/'); ?>js/off-canvas.js "></script>
    <script src="<?= base_url('assets/cetak/'); ?>js/hoverable-collapse.js "></script>
    <script src="<?= base_url('assets/cetak/'); ?>js/misc.js "></script>
    <!-- endinject -->

    <?php
    $scr = "1";
    foreach ($kinerja->result() as $s) {
    ?>
        <!-- Custom js for this page -->
        <script>
            $(function() {
                /* ChartJS
                 * -------
                 * Data and config for chartjs
                 */
                "use strict";
                var dataPenilaian<?= $scr; ?> = {
                    labels: [" Poor ", "Average", " Good ", " Excelent "],
                    datasets: [{
                        label: "Penilaian Pemain",
                        data: [<?= $s->total_poor; ?>, <?= $s->total_average; ?>, <?= $s->total_good; ?>, <?= $s->total_excellent; ?>],
                        backgroundColor: [
                            "rgba(222, 0, 0, 0.9)",
                            "rgba(255,171,0,0.9)",
                            "rgba(255, 206, 86, 0.9)",
                            "rgba(107, 255, 59, 0.9)",
                        ],
                        borderColor: [
                            "rgba(222, 0, 0, 1)",
                            "rgba(255,171,0,1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(107, 255, 59, 1)",
                        ],
                        borderWidth: 1,
                        fill: false,
                    }, ],
                };

                var dataAbsen<?= $scr; ?> = {
                    labels: ["Masuk", "Alpa", "Sakit"],
                    datasets: [{
                        label: "Penilaian Pemain",
                        data: [<?= $s->total_absen; ?>, <?= $s->total_alpa; ?>, <?= $s->total_sakit; ?>],
                        backgroundColor: [
                            "rgba(107, 255, 59, 0.9)",
                            "rgba(222, 0, 0, 0.9)",
                            "rgba(255, 206, 86, 0.9)",
                        ],
                        borderColor: [
                            "rgba(107, 255, 59, 1)",
                            "rgba(222, 0, 0, 1)",
                            "rgba(255, 206, 86, 1)",
                        ],
                        borderWidth: 1,
                        fill: false,
                    }, ],
                };

                var optionsBar<?= $scr; ?> = {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                            gridLines: {
                                color: "#322f2f",
                                zeroLineColor: "#322f2f",
                            },
                        }, ],
                    },
                    legend: {
                        display: false,
                    },
                    elements: {
                        point: {
                            radius: 0,
                        },
                    },
                };

                // Get context with jQuery - using jQuery's .get() method.
                if ($("#absensiChart<?= $scr; ?>").length) {
                    var barChartCanvas = $("#absensiChart<?= $scr; ?>").get(0).getContext("2d");
                    // This will get the first returned node in the jQuery collection.
                    var barChart = new Chart(barChartCanvas, {
                        type: "bar",
                        data: dataAbsen<?= $scr; ?>,
                        options: optionsBar<?= $scr; ?>,
                    });
                }

                if ($("#nilaiChart<?= $scr; ?>").length) {
                    var barChartCanvas = $("#nilaiChart<?= $scr; ?>").get(0).getContext("2d");
                    // This will get the first returned node in the jQuery collection.
                    var barChart = new Chart(barChartCanvas, {
                        type: "bar",
                        data: dataPenilaian<?= $scr; ?>,
                        options: optionsBar<?= $scr; ?>,
                    });
                }
            });
        </script>
    <?php $scr++;
    } ?>
    <!-- End custom js for this page -->
    <script>
        window.print();
    </script>
</body>

</html>