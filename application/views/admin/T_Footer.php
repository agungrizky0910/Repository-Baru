            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © PT. Damai Indah Golf <?= date("Y"); ?></span>
                </div>
            </footer>
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->
            <!-- plugins:js -->
            <script src="<?= base_url('assets/admin-template/'); ?>vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <script src="<?= base_url('assets/admin-template/'); ?>vendors/chart.js/Chart.min.js"></script>
            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="<?= base_url('assets/users-template/'); ?>js/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/admin-template/'); ?>js/off-canvas.js"></script>
            <script src="<?= base_url('assets/admin-template/'); ?>js/hoverable-collapse.js"></script>
            <script src="<?= base_url('assets/admin-template/'); ?>js/misc.js"></script>
            <script src="<?= base_url('assets/notiflix/'); ?>src/notiflix.js"></script>
            <script src="<?= base_url('assets/admin-template/'); ?>js/bootstrap-datepicker.js"></script>
            <?php if ($this->session->userdata('level') == 'CaddyMaster') { ?>
                <script src="<?= base_url('assets/ajax/'); ?>main.min.js"></script>
            <?php } else  if ($this->session->userdata('level') == 'GOManager') { ?>
                <script src="<?= base_url('assets/ajax/manager/'); ?>main.min.js"></script>
            <?php } else  if ($this->session->userdata('level') == 'Admin') { ?>
                <script src="<?= base_url('assets/ajax/admin/'); ?>main.min.js"></script>
            <?php } ?>
            <!-- endinject -->
            <!-- Custom js for this page -->
            <?php
            $function = $this->uri->segment(1);
            $action = $this->uri->segment(2);
            ?>

            <?php if ($function == "CaddyMaster" && $action == "AddCaddy") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>add_caddy.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.date-picker-input').datepicker({
                            language: "id",
                            todayHighlight: true,
                            format: 'dd/mm/yyyy'
                        });
                        $(document).on('click', "button.ui-datepicker-current", function() {
                            $(".date-picker-input").datepicker('setDate', new Date())
                        });
                    });
                </script>
            <?php } ?>
            <?php if ($function == "Admin" && $action == "AddUser") { ?>
                <script src="<?= base_url('assets/ajax/admin/'); ?>add_user.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "DataCaddy") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>data_caddy.min.js"></script>
            <?php } ?>
            <?php if ($function == "Admin" && $action == "") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>data_user.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "Profil") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>edit_profil.min.js"></script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "Profil") { ?>
                <script src="<?= base_url('assets/ajax/manager/'); ?>edit_profil.min.js"></script>
            <?php } ?>
            <?php if ($function == "Admin" && $action == "Profil") { ?>
                <script src="<?= base_url('assets/ajax/admin/'); ?>edit_profil.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "AbsenCaddy") { ?>
                <script>
                    $(document).ready(function() {
                        $('#absen-caddy').DataTable({
                            "scrollX": true,
                            "columnDefs": [{
                                "orderable": false,
                                "targets": 0
                            }]
                        });

                    });
                </script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "DetailAbsen") { ?>
                <script>
                    var fp = <?= $fp; ?>;
                </script>
                <script src="<?= base_url('assets/ajax/'); ?>detail_absen.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "AddAbsen") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>add_absen.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "AbsenSakit") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>caddy_sakit.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "AddAbsenSakit") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>add_absen_sakit.min.js"></script>
                <script src="<?= base_url('assets/'); ?>select2-master/dist/js/select2.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.date-picker-input').datepicker({
                            language: "id",
                            todayHighlight: true,
                            format: 'yyyy-mm-dd',
                            daysOfWeekDisabled: "2"
                        });
                        $(document).on('click', "button.ui-datepicker-current", function() {
                            $(".date-picker-input").datepicker('setDate', new Date())
                        });
                    });

                    $(document).ready(function() {
                        $('.select-option').select2({
                            placeholder: 'Pilih',
                            allowClear: true
                        });
                    });
                </script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "EditCaddy") { ?>

                <script>
                    var nip_encode = '<?= $nip_encode ?>';
                    $(document).ready(function() {
                        $('.date-picker-input').datepicker({
                            language: "id",
                            todayHighlight: true,
                            format: 'dd/mm/yyyy'
                        });
                        $(document).on('click', "button.ui-datepicker-current", function() {
                            $(".date-picker-input").datepicker('setDate', new Date())
                        });
                    });
                </script>
                <script src="<?= base_url('assets/ajax/'); ?>edit_caddy.min.js"></script>
            <?php } ?>
            <?php if ($function == "Admin" && $action == "EditUser") { ?>

                <script>
                    var nip_encode = '<?= $nip_encode ?>';
                </script>
                <script src="<?= base_url('assets/ajax/admin/'); ?>edit_user.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "BelumDinilai") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>Nilai_Caddy_Belum.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "SudahDinilai") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>Nilai_Caddy_Sudah.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "DetailPenilaian") { ?>
                <script>
                    var bulan = "<?= $bulan; ?>";
                    var tahun = "<?= $tahun; ?>";
                    var nip = "<?= $nip; ?>";
                </script>
                <script src="<?= base_url('assets/ajax/'); ?>Detail_Nilai.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "DetailPenilaianSelesai") { ?>
                <script>
                    $(document).ready(function() {
                        $('#nilai-caddy').DataTable({
                            "scrollX": true,
                            "columnDefs": [{
                                "orderable": false,
                                "targets": 4
                            }, {
                                "orderable": false,
                                "targets": 3
                            }, ]
                        });

                    });
                </script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "Laporan") { ?>
                <script src="<?= base_url('assets/ajax/'); ?>Laporan.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "DetailLaporan") { ?>
                <script>
                    $(document).ready(function() {
                        $('#table-laporan').DataTable({
                            "scrollX": true,
                            "columnDefs": [{
                                "orderable": false,
                                "targets": 1
                            }, ]
                        });

                    });
                </script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "LaporanMenunggu") { ?>
                <script src="<?= base_url('assets/ajax/manager/'); ?>Laporan.min.js"></script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "DetailLaporanMenunggu") { ?>
                <script>
                    var bulan = "<?= $bulan; ?>";
                    var tahun = "<?= $tahun; ?>";
                </script>
                <script src="<?= base_url('assets/ajax/manager/'); ?>Detail_Laporan_Menunggu.min.js"></script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "LaporanSelesai") { ?>
                <script src="<?= base_url('assets/ajax/manager/'); ?>Laporan_Selesai.min.js"></script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "DetailLaporanSelesai") { ?>
                <script>
                    var bulan = "<?= $bulan; ?>";
                    var tahun = "<?= $tahun; ?>";
                </script>
                <script src="<?= base_url('assets/ajax/manager/'); ?>Detail_Laporan_Selesai.min.js"></script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "LaporanKinerja") { ?>
                <script src="<?= base_url('assets/ajax/manager/'); ?>Kinerja.min.js"></script>
            <?php } ?>
            <?php if ($function == "CaddyMaster" && $action == "") { ?>
                <script>
                    $(document).ready(function() {
                        $('#kinerja-caddy').DataTable({
                            "scrollX": true,
                            "columnDefs": [{
                                "orderable": false,
                                "targets": 0
                            }]
                        });

                    });
                </script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "") { ?>
                <script>
                    $(document).ready(function() {
                        $('#penilaian').DataTable({
                            "scrollX": true,
                            "columnDefs": [{
                                "orderable": false,
                                "targets": 4
                            }]
                        });

                    });
                </script>
            <?php } ?>
            <?php if ($function == "Manager" && $action == "" || $function == "CaddyMaster" && $action == "") { ?>
                <script>
                    (function($) {
                        "use strict";
                        $(function() {
                            Chart.defaults.global.legend.labels.usePointStyle = true;

                            if ($("#visit-sale-chart").length) {
                                Chart.defaults.global.legend.labels.usePointStyle = true;
                                var ctx = document.getElementById("visit-sale-chart").getContext("2d");

                                var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
                                gradientStrokeViolet.addColorStop(0, "rgba(218, 140, 255, 1)");
                                gradientStrokeViolet.addColorStop(1, "rgba(154, 85, 255, 1)");
                                var gradientLegendViolet =
                                    "linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))";

                                var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
                                gradientStrokeBlue.addColorStop(0, "rgba(54, 215, 232, 1)");
                                gradientStrokeBlue.addColorStop(1, "rgba(177, 148, 250, 1)");
                                var gradientLegendBlue =
                                    "linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))";

                                var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
                                gradientStrokeRed.addColorStop(0, "rgba(255, 191, 150, 1)");
                                gradientStrokeRed.addColorStop(1, "rgba(254, 112, 150, 1)");
                                var gradientLegendRed =
                                    "linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))";

                                var myChart = new Chart(ctx, {
                                    type: "bar",
                                    data: {
                                        labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "NOV", "DES"],
                                        datasets: [{
                                            label: "KINERJA",
                                            borderColor: gradientStrokeRed,
                                            backgroundColor: gradientStrokeRed,
                                            hoverBackgroundColor: gradientStrokeRed,
                                            legendColor: gradientLegendRed,
                                            pointRadius: 0,
                                            fill: false,
                                            borderWidth: 1,
                                            fill: "origin",
                                            data: [<?= $totalJan->total;; ?>,
                                                <?= $totalFeb->total; ?>,
                                                <?= $totalMar->total; ?>,
                                                <?= $totalApr->total; ?>,
                                                <?= $totalMei->total; ?>,
                                                <?= $totalJun->total; ?>,
                                                <?= $totalJul->total; ?>,
                                                <?= $totalAgu->total; ?>,
                                                <?= $totalSep->total; ?>,
                                                <?= $totalOkt->total; ?>,
                                                <?= $totalNov->total; ?>,
                                                <?= $totalDes->total; ?>
                                            ],
                                        }, ],
                                    },
                                    options: {
                                        responsive: true,
                                        legend: false,
                                        legendCallback: function(chart) {
                                            var text = [];
                                            text.push("<ul>");
                                            for (var i = 0; i < chart.data.datasets.length; i++) {
                                                text.push(
                                                    '<li><span class="legend-dots" style="background:' +
                                                    chart.data.datasets[i].legendColor +
                                                    '"></span>'
                                                );
                                                if (chart.data.datasets[i].label) {
                                                    text.push(chart.data.datasets[i].label);
                                                }
                                                text.push("</li>");
                                            }
                                            text.push("</ul>");
                                            return text.join("");
                                        },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    display: true,
                                                    min: 0,
                                                    stepSize: 1000,
                                                    max: <?= max($nilai); ?>,
                                                },
                                                gridLines: {
                                                    drawBorder: false,
                                                    color: "rgba(235,237,242,1)",
                                                    zeroLineColor: "rgba(235,237,242,1)",
                                                },
                                            }, ],
                                            xAxes: [{
                                                gridLines: {
                                                    display: false,
                                                    drawBorder: false,
                                                    color: "rgba(0,0,0,1)",
                                                    zeroLineColor: "rgba(235,237,242,1)",
                                                },
                                                ticks: {
                                                    padding: 20,
                                                    fontColor: "#9c9fa6",
                                                    autoSkip: true,
                                                },
                                                categoryPercentage: 0.5,
                                                barPercentage: 0.5,
                                            }, ],
                                        },
                                    },
                                    elements: {
                                        point: {
                                            radius: 0,
                                        },
                                    },
                                });
                                $("#visit-sale-chart-legend").html(myChart.generateLegend());
                            }

                            if ($("#traffic-chart").length) {
                                var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
                                gradientStrokeViolet.addColorStop(0, "rgba(218, 140, 255, 1)");
                                gradientStrokeViolet.addColorStop(1, "rgba(154, 85, 255, 1)");
                                var gradientLegendViolet =
                                    "linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))";

                                var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 181);
                                gradientStrokeBlue.addColorStop(0, "rgba(177, 148, 250, 1)");
                                gradientStrokeBlue.addColorStop(1, " rgba(54, 215, 232, 1)");

                                var gradientLegendBlue =
                                    "linear-gradient(to right,  rgba(177, 148, 250, 1), rgba(54, 215, 232, 1))";
                                var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
                                gradientStrokeRed.addColorStop(0, "rgba(255, 191, 150, 1)");
                                gradientStrokeRed.addColorStop(1, "rgba(254, 112, 150, 1)");
                                var gradientLegendRed =
                                    "linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))";

                                var gradientStrokeGreen = ctx.createLinearGradient(0, 0, 0, 300);
                                gradientStrokeGreen.addColorStop(0, "rgba(6, 185, 157, 1)");
                                gradientStrokeGreen.addColorStop(1, "rgba(132, 217, 210, 1)");
                                var gradientLegendGreen =
                                    "linear-gradient(to right, rgba(6, 185, 157, 1), rgba(132, 217, 210, 1))";

                                var trafficChartData = {
                                    datasets: [{
                                        data: [<?= $excellent; ?>, <?= $good; ?>, <?= $average; ?>, <?= $poor; ?>],
                                        backgroundColor: [
                                            gradientStrokeGreen,
                                            gradientStrokeBlue,
                                            gradientStrokeViolet,
                                            gradientStrokeRed,
                                        ],
                                        hoverBackgroundColor: [
                                            gradientStrokeGreen,
                                            gradientStrokeBlue,
                                            gradientStrokeViolet,
                                            gradientStrokeRed,
                                        ],
                                        borderColor: [
                                            gradientStrokeGreen,
                                            gradientStrokeBlue,
                                            gradientStrokeViolet,
                                            gradientStrokeRed,
                                        ],
                                        legendColor: [
                                            gradientLegendGreen,
                                            gradientLegendBlue,
                                            gradientLegendViolet,
                                            gradientLegendRed,
                                        ],
                                    }, ],

                                    // These labels appear in the legend and in the tooltips when hovering different arcs
                                    labels: ["Excellent", "Good", "Average", "Poor"],
                                };
                                var trafficChartOptions = {
                                    responsive: true,
                                    animation: {
                                        animateScale: true,
                                        animateRotate: true,
                                    },
                                    legend: false,
                                    legendCallback: function(chart) {
                                        var text = [];
                                        text.push("<ul>");
                                        for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                                            text.push(
                                                '<li><span class="legend-dots" style="background:' +
                                                trafficChartData.datasets[0].legendColor[i] +
                                                '"></span>'
                                            );
                                            if (trafficChartData.labels[i]) {
                                                text.push(trafficChartData.labels[i]);
                                            }
                                            text.push(
                                                '<span class="float-right">' +
                                                trafficChartData.datasets[0].data[i] +
                                                "%" +
                                                "</span>"
                                            );
                                            text.push("</li>");
                                        }
                                        text.push("</ul>");
                                        return text.join("");
                                    },
                                };
                                var trafficChartCanvas = $("#traffic-chart").get(0).getContext("2d");
                                var trafficChart = new Chart(trafficChartCanvas, {
                                    type: "doughnut",
                                    data: trafficChartData,
                                    options: trafficChartOptions,
                                });
                                $("#traffic-chart-legend").html(trafficChart.generateLegend());
                            }
                            if ($("#inline-datepicker").length) {
                                $("#inline-datepicker").datepicker({
                                    enableOnReadonly: true,
                                    todayHighlight: true,
                                });
                            }
                        });
                    })(jQuery);
                </script>
            <?php } ?>
            <script src="<?= base_url('assets/admin-template/'); ?>js/file-upload.js"></script>

            <!-- End custom js for this page -->
            </body>

            </html>