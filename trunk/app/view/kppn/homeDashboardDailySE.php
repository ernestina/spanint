<div id="top">
	<div id="header">
        <h2>Hari ini di <?php echo Session::get('user') ?></h2>
    </div>
    
    <div id="fitur">
        <div id="pie-container">
            <div>
                <div id="pie-jenis-container">
                    <canvas id="pie-jenis-canvas"></canvas>
                    <div id="pie-jenis-info" class="pie-info">
                        <div class="pie-info-title">Jenis SP2D</div>
                        <div class="pie-info-content half">
                            <div class="sphere blue"></div>
                            <span id="number-sp2d-gaji" class="info-number">0</span><br/>
                            <span class="info-text">Gaji</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere purple"></div>
                            <span id="number-sp2d-non-gaji" class="info-number">0</span><br/>
                            <span class="info-text">Non Gaji</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere yellow"></div>
                            <span id="number-sp2d-retur" class="info-number">0</span><br/>
                            <span class="info-text">Lainnya</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere red"></div>
                            <span id="number-sp2d-void" class="info-number">0</span><br/>
                            <span class="info-text">Void</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div id="pie-nominal-container">
                    <canvas id="pie-nominal-canvas"></canvas>
                    <div id="pie-nominal-info" class="pie-info">
                        <div class="pie-info-title">Nominal SP2D</div>
                        <div class="pie-info-content full">
                            <div class="sphere blue"></div>
                            <span id="number-sp2d-nominal-gaji" class="info-number">0</span><br/>
                            <span class="info-text">Gaji</span>
                        </div>
                        <div class="pie-info-content full">
                            <div class="sphere purple"></div>
                            <span id="number-sp2d-nominal-non-gaji" class="info-number">0</span><br/>
                            <span class="info-text">Non Gaji</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div id="pie-retur-container">
                    <canvas id="pie-retur-canvas"></canvas>
                    <div id="pie-retur-info" class="pie-info">
                        <div class="pie-info-title">Status Retur</div>
                        <div class="pie-info-content full">
                            <div class="sphere yellow"></div>
                            <span id="number-retur-in-progress" class="info-number">0</span><br/>
                            <span class="info-text">Belum Diproses</span>
                        </div>
                        <div class="pie-info-content full">
                            <div class="sphere blue"></div>
                            <span id="number-retur-completed" class="info-number">0</span><br/>
                            <span class="info-text">Sudah Diproses</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div id="pie-lhp-container">
                    <canvas id="pie-lhp-canvas"></canvas>
                    <div id="pie-lhp-info" class="pie-info">
                        <div class="pie-info-title">LHP <span id="tgl-lhp-last"></span></div>
                        <div class="pie-info-content half">
                            <div class="sphere blue"></div>
                            <span id="number-lhp-completed" class="info-number">0</span><br/>
                            <span class="info-text">Completed</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere purple"></div>
                            <span id="number-lhp-validated" class="info-number">0</span><br/>
                            <span class="info-text">Validated</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere red"></div>
                            <span id="number-lhp-error" class="info-number">0</span><br/>
                            <span class="info-text">Error</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere yellow"></div>
                            <span id="number-lhp-lainnya" class="info-number">0</span><br/>
                            <span class="info-text">Lainnya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ticker-container">
            <div id="ticker-ongoing-container">
                <div class="ticker-title">SPM Dalam Proses<div class="ticker-total">0</div></div>
                <div class="ticker-content">Tidak ada data.</div>
            </div>
            <div id="ticker-completed-container">
                <div class="ticker-title">SP2D Selesai<div class="ticker-total">0</div></div>
                <div class="ticker-content">Tidak ada data.</div>
            </div>
        </div>
        <div id="summary-container" style="display: none">
            <div>
                <div class="ticker-title">Rekapitulasi</div>
                <div class="ticker-content">Tidak ada data.</div>
            </div>
        </div>
        <div id="bottom-status-bar">
            <div>
                <div id="kppn-select" style="float: left;">
                    <?php
                        if (Session::get('role')==KANWIL) {
                            
                            echo "Tampilkan data: <select id='kppn-list'>";
                            echo "<option value='ALL'>SEMUA KPPN</option>";
                            foreach ($this->kppn_list as $val) {
                                echo "<option value='".$val->get_kd_d_kppn()."'>".$val->get_nama_user()."</option>";
                            }
                            echo "</select>";
                        }
                    ?>
                </div>
                <div style="float: right;">Periode: <a href="<?php echo URL; ?>home/harian" class="active">Hari Ini</a><a href="<?php echo URL; ?>home/mingguan">7 Hari</a><a href="<?php echo URL; ?>home/bulanan">30 Hari</a></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //init variables - chart
    var homeDataJSON;
    var dataStatusSPM;
    var dataJumlahSPM;
    var dataVolumeSPM;
    var dataStatusLHP;
    
    //init variables - ticker
    tickerOngoingTotal = 0;
    tickerOngoingNow = 0;
    tickerCompleteTotal = 0;
    tickerCompleteNow = 0;
    
    tickerOngoingContents = "";
    tickerCompletedContents = "";
    
    //init variables - page resizing
    redrawExecuted = false;
    widthThreshold = 1280;
    heightThreshold = 720;
    
    function renderChart() {
        if (homeDataJSON.jumlahReturSudahProses == 0) { homeDataJSON.jumlahReturSudahProses = 0; }
        if (homeDataJSON.jumlahReturBelumProses == 0) { homeDataJSON.jumlahReturBelumProses = 0; }
        
        dataRetur = [
            {
                value: parseInt(homeDataJSON.jumlahReturSudahProses),
                color: "#409ACA"
            },
            {
                value : parseInt(homeDataJSON.jumlahReturBelumProses),
                color : "#F6CE40"
            }
        ];
        
        if ((parseInt(homeDataJSON.jumlahReturSudahProses) == 0) && (parseInt(homeDataJSON.jumlahReturBelumProses) == 0)) {
            dataRetur = [
                {
                    value: 100,
                    color: "#DEDEDE"
                }
            ];
        }
        
        dataJumlahSPM = [
            {
                value: parseInt(homeDataJSON.jumlahSPMGaji),
                color:"#409ACA"
            },
            {
                value : parseInt(homeDataJSON.jumlahSPMNonGaji),
                color : "#8E5696"
            },
            {
                value : parseInt(homeDataJSON.jumlahSPMLainnya),
                color : "#F6CE40"
            },
            {
                value : parseInt(homeDataJSON.jumlahSPMVoid),
                color : "#E35C5C"
            }
        ];
        
        if ((parseInt(homeDataJSON.jumlahSPMGaji) == 0) && (parseInt(homeDataJSON.jumlahSPMNonGaji) == 0) && (parseInt(homeDataJSON.jumlahSPMLainnya) == 0) && (parseInt(homeDataJSON.jumlahSPMVoid) == 0)) {
            dataJumlahSPM = [
                {
                    value: 100,
                    color: "#DEDEDE"
                }
            ];
        }
        
        dataVolumeSPM = [
            {
                value: parseInt(homeDataJSON.volumeSPMGaji),
                color:"#409ACA"
            },
            {
                value : parseInt(homeDataJSON.volumeSPMNonGaji),
                color : "#8E5696"
            }
        ];
        
        if ((parseInt(homeDataJSON.jumlahSPMGaji) == 0) && (parseInt(homeDataJSON.jumlahSPMNonGaji) == 0)) {
            dataVolumeSPM = [
                {
                    value: 100,
                    color: "#DEDEDE"
                }
            ];
        }
        
        dataStatusLHP = [
            {
                value: parseInt(homeDataJSON.jumlahLHPCompleted),
                color: "#409ACA"
            },
            {
                value : parseInt(homeDataJSON.jumlahLHPValidated),
                color : "#8E5696"
            },
            {
                value : parseInt(homeDataJSON.jumlahLHPError),
                color : "#E35C5C"
            },
            {
                value : parseInt(homeDataJSON.jumlahLHPLainnya),
                color : "#F6CE40"
            }
        ];
        
        if ((parseInt(homeDataJSON.jumlahLHPCompleted) == 0) && (parseInt(homeDataJSON.jumlahLHPValidated) == 0) && (parseInt(homeDataJSON.jumlahLHPError) == 0) && (parseInt(homeDataJSON.jumlahLHPLainnya) == 0)) {
            dataStatusLHP = [
                {
                    value: 100,
                    color: "#DEDEDE"
                }
            ];
        }
        
        var canvasRetur = $("#pie-retur-canvas").get(0).getContext("2d");
        var chartRetur = new Chart(canvasRetur).Doughnut(dataRetur);
        var canvasJumlahSPM = $("#pie-jenis-canvas").get(0).getContext("2d");
        var chartJumlahSPM = new Chart(canvasJumlahSPM).Doughnut(dataJumlahSPM);
        var canvasVolumeSPM = $("#pie-nominal-canvas").get(0).getContext("2d");
        var chartVolumeSPM = new Chart(canvasVolumeSPM).Doughnut(dataVolumeSPM);
        var canvasStatusLHP = $("#pie-lhp-canvas").get(0).getContext("2d");
        var chartStatusLHP = new Chart(canvasStatusLHP).Doughnut(dataStatusLHP);
        
        $("#number-retur-completed").html(homeDataJSON.jumlahReturSudahProses);
        $("#number-retur-in-progress").html(homeDataJSON.jumlahReturBelumProses);
        
        $("#number-sp2d-gaji").html(homeDataJSON.jumlahSPMGaji);
        $("#number-sp2d-non-gaji").html(homeDataJSON.jumlahSPMNonGaji);
        $("#number-sp2d-retur").html(homeDataJSON.jumlahSPMLainnya);
        $("#number-sp2d-void").html(homeDataJSON.jumlahSPMVoid);
        
        if (homeDataJSON.displayMode == "REKAP") {
            $("#tgl-lhp-last").html("");
        } else {
            $("#tgl-lhp-last").html(homeDataJSON.tanggalLHPTerakhir);
            $("#ticker-ongoing-container .ticker-total").html(homeDataJSON.jumlahSPMOngoing + " SPM");
            $("#ticker-completed-container .ticker-total").html(parseInt(homeDataJSON.jumlahSPMGaji) + parseInt(homeDataJSON.jumlahSPMNonGaji) + parseInt(homeDataJSON.jumlahSPMLainnya) + parseInt(homeDataJSON.jumlahSPMVoid) + " SP2D");
        }
        
        $("#number-sp2d-nominal-gaji").html(homeDataJSON.volumeSPMGaji + " M<span class='low-res-hidden'>ILYAR</span>");
        $("#number-sp2d-nominal-non-gaji").html(homeDataJSON.volumeSPMNonGaji + " M<span class='low-res-hidden'>ILYAR</span>");
        
        $("#number-lhp-completed").html(homeDataJSON.jumlahLHPCompleted);
        $("#number-lhp-validated").html(homeDataJSON.jumlahLHPValidated);
        $("#number-lhp-error").html(homeDataJSON.jumlahLHPError);
        $("#number-lhp-lainnya").html(homeDataJSON.jumlahLHPLainnya);
    }
    
    function calculateWidth() {
        //use this function and draw the chart automatically after, so the graph is drawn with the correct size
        $("#pie-retur-canvas").attr("width",$("#pie-retur-canvas").width()-1);
        $("#pie-retur-canvas").attr("height",$("#pie-retur-info").height());
        
        $("#pie-jenis-canvas").attr("width",$("#pie-jenis-canvas").width()-1);
        $("#pie-jenis-canvas").attr("height",$("#pie-jenis-info").height());
        
        $("#pie-nominal-canvas").attr("width",$("#pie-nominal-canvas").width()-1);
        $("#pie-nominal-canvas").attr("height",$("#pie-nominal-info").height());
        
        $("#pie-lhp-canvas").attr("width",$("#pie-lhp-canvas").width()-1);
        $("#pie-lhp-canvas").attr("height",$("#pie-lhp-info").height());
        
        if (homeDataJSON.displayMode == "REKAP") {
            
        } else {
            $("#ticker-ongoing-container > .ticker-content").height($(window).innerHeight()-620);
            $("#ticker-completed-container > .ticker-content").height($(window).innerHeight()-620);
        }
        
        redrawExecuted = true;
        window.setTimeout(renderChart(), 500);
    }
    
    function setWindowMode() {
        //detect low-res screen
        if ($(window).innerWidth() <= 1440) {
            $("#pie-container > div").addClass("low-res");
        } else {
            $("#pie-container > div").removeClass("low-res");
        }
        
        $("#pie-retur-canvas").removeAttr("width");
        $("#pie-retur-canvas").removeAttr("height");
        $("#pie-retur-canvas").removeAttr("style");
        
        $("#pie-jenis-canvas").removeAttr("width");
        $("#pie-jenis-canvas").removeAttr("height");
        $("#pie-jenis-canvas").removeAttr("style");
        
        $("#pie-nominal-canvas").removeAttr("width");
        $("#pie-nominal-canvas").removeAttr("height");
        $("#pie-nominal-canvas").removeAttr("style");
        
        $("#pie-lhp-canvas").removeAttr("width");
        $("#pie-lhp-canvas").removeAttr("height");
        $("#pie-lhp-canvas").removeAttr("style");
        
        //wait before resizing so the resizing is executed only once
        window.setTimeout(function() {
            if (!redrawExecuted) {
                calculateWidth();
            }
        }, 100);
    }
    
    function homeDisplayProcessing() {
        
        //load the data via ajax
        urlAddon = "";
        
        <?php
            if (Session::get('role')==KANWIL) {
                
                echo "if ($('#kppn-list').val() != 'ALL') {"; 
                echo "  urlAddon = '/'+$('#kppn-list').val();";
                echo "}"; 
            }
        ?>
        
        $("#ticker-ongoing-container > .ticker-content").html("Tidak ada data.");
        $("#ticker-completed-container > .ticker-content").html("Tidak ada data.");
        
        $.ajax({
            'async': false,
            'global': false,
            'url': '<?php echo URL; ?>home/harianJSON'+urlAddon,
            'dataType': "json",
            'success': function (data) {
                homeDataJSON = data;
            }
        });
        
        if (homeDataJSON.displayMode == "REKAP") {
            
            $("#summary-container").show();
            $("#ticker-container").hide();
            
            tableSummaryContents = '';
                
            tableSummaryContents  += "<table>";

            tableSummaryContents  += "<tr class='bold'>";
            tableSummaryContents  +=   "<td rowspan=2 style='text-align: left'>Nama KPPN</td>";
            tableSummaryContents  +=   "<td colspan=4>SP2D</td>";
            tableSummaryContents  +=   "<td colspan=2>Retur</td>";
            tableSummaryContents  +=   "<td colspan=4>LHP</td>";
            tableSummaryContents  += "</tr>";
            
            tableSummaryContents  += "<tr class='bold'>";
            tableSummaryContents  +=   "<td>Gaji</td>";
            tableSummaryContents  +=   "<td>Non Gaji</td>";
            tableSummaryContents  +=   "<td>Lainnya</td>";
            tableSummaryContents  +=   "<td>Void</td>";
            tableSummaryContents  +=   "<td>Sudah Proses</td>";
            tableSummaryContents  +=   "<td>Belum Proses</td>";
            tableSummaryContents  +=   "<td>Completed</td>";
            tableSummaryContents  +=   "<td>Validated</td>";
            tableSummaryContents  +=   "<td>Error</td>";
            tableSummaryContents  +=   "<td>Lainnya</td>";
            tableSummaryContents  += "</tr>";
            
            for (j=0; j<homeDataJSON.listKPPN.length; j++) {
                tableSummaryContents  += "<tr>";
                tableSummaryContents  +=   "<td style='text-align: left'>" + homeDataJSON.listKPPN[j] + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.sp2dKPPN[j].gaji + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.sp2dKPPN[j].nonGaji + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.sp2dKPPN[j].lainnya + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.sp2dKPPN[j].void + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.returKPPN[j].sudahProses + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.returKPPN[j].belumProses + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.lhpKPPN[j].completed + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.lhpKPPN[j].validated + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.lhpKPPN[j].error + "</td>";
                tableSummaryContents  +=   "<td>" + homeDataJSON.lhpKPPN[j].etc + "</td>";
                tableSummaryContents  += "</tr>";
            }
            
            tableSummaryContents  += "<tr class='bold'>";
            tableSummaryContents  +=   "<td style='text-align: left'>" + homeDataJSON.listKPPN[j] + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahSPMGaji + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahSPMNonGaji + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahSPMLainnya + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahSPMVoid + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahReturSudahProses + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahReturBelumProses + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahLHPCompleted + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahLHPValidated + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahLHPError + "</td>";
            tableSummaryContents  +=   "<td>" + homeDataJSON.jumlahLHPLainnya + "</td>";
            tableSummaryContents  += "</tr>";

            tableSummaryContents  += "</table>";

            $("#summary-container .ticker-content").html(tableSummaryContents);
            
        } else {
            
            tickerOngoingContents = '';
            tickerCompletedContents = '';
            
            $("#summary-container").hide();
            $("#ticker-container").show();
            
            $("#ticker-ongoing-container > .ticker-content").html("Tidak ada data.");
            $("#ticker-completed-container > .ticker-content").html("Tidak ada data.");
            
            tickerOngoingTotal = homeDataJSON.spmDalamProses.length;
            if (homeDataJSON.spmDalamProses.length > 0) {
                for (i=0; i<homeDataJSON.spmDalamProses.length; i++) {
                    tickerOngoingContents += "<div id='ticker-item-" + i + "' class='ticker-item'>";
                    tickerOngoingContents +=   "<div class='kiri' style='width: 40px; text-align:right;'>" + (i+1) + "</div>";
                    tickerOngoingContents +=   "<div class='kiri spaced-left'>" + homeDataJSON.spmDalamProses[i].nomorSPM + "</div>";
                    tickerOngoingContents +=   "<div class='kiri spaced-left'>" + homeDataJSON.spmDalamProses[i].userSPM + "</div>";
                    tickerOngoingContents +=   "<div class='kanan spaced-right'>" + homeDataJSON.spmDalamProses[i].mulaiSPM + "</div>";
                    tickerOngoingContents += "</div>";
                }
                $("#ticker-ongoing-container > .ticker-content").html(tickerOngoingContents);
            }

            tickerCompletedTotal = homeDataJSON.sp2dSelesai.length;
            if (homeDataJSON.sp2dSelesai.length > 0) {
                for (j=0; j<homeDataJSON.sp2dSelesai.length; j++) {
                    tickerCompletedContents += "<div id='ticker-item-" + j + "' class='ticker-item'>";
                    tickerCompletedContents +=   "<div class='kiri' style='width: 40px; text-align:right;'>" + (j+1) + "</div>";
                    tickerCompletedContents +=   "<div class='kiri spaced-left'>" + homeDataJSON.sp2dSelesai[j].nomorSP2D + "</div>";
                    tickerCompletedContents +=   "<div class='kiri spaced-left'>" + homeDataJSON.sp2dSelesai[j].jenisSP2D + "</div>";
                    tickerCompletedContents +=   "<div class='kanan spaced-right'>" + homeDataJSON.sp2dSelesai[j].nominalSP2D + "</div>";
                    tickerCompletedContents += "</div>";
                }
                $("#ticker-completed-container > .ticker-content").html(tickerCompletedContents);
            }
            
        }
        
        //prepare to draw
        redrawExecuted = false;
        setWindowMode();
    }
    
    $('#kppn-list').change(function() {
        
        $("#ticker-ongoing-container > .ticker-content").empty();
        $("#ticker-completed-container > .ticker-content").empty();
        
        homeDisplayProcessing();
        
    });
    
    $(document).ready(function() {
        $( document ).tooltip(
            {
                content: function() {
                    var element = $( this );
                    if ( element.is( "[title]" ) ) {
                      return element.attr( "title" );
                    }
                }
            }
        );
        window.setInterval(homeDisplayProcessing(),20*60*1000);
    });
    
    $(window).resize(function() {
        redrawExecuted = false;
        setWindowMode();
    }); 
</script>