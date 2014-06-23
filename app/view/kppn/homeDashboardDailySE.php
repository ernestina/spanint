<div id="top">
	<div id="header">
        <h2>Hari ini di <?php echo Session::get('user') ?></h2>
    </div>
    
    <div id="fitur">
        <div id="pie-container">
            <div>
                <div id="pie-status-container">
                    <canvas id="pie-status-canvas"></canvas>
                    <div id="pie-status-info" class="pie-info">
                        <div class="pie-info-title">Status SP2D</div>
                        <div class="pie-info-content full">
                            <div class="sphere yellow"></div>
                            <span id="number-sp2d-in-progress" class="info-number">999</span><br/>
                            <span class="info-text">Dalam Proses</span>
                        </div>
                        <div class="pie-info-content full">
                            <div class="sphere blue"></div>
                            <span id="number-sp2d-completed" class="info-number">999</span><br/>
                            <span class="info-text">Selesai</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div id="pie-jenis-container">
                    <canvas id="pie-jenis-canvas"></canvas>
                    <div id="pie-jenis-info" class="pie-info">
                        <div class="pie-info-title">Jenis SP2D</div>
                        <div class="pie-info-content half">
                            <div class="sphere blue"></div>
                            <span id="number-sp2d-gaji" class="info-number">999</span><br/>
                            <span class="info-text">Gaji</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere purple"></div>
                            <span id="number-sp2d-non-gaji" class="info-number">999</span><br/>
                            <span class="info-text">Non Gaji</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere yellow"></div>
                            <span id="number-sp2d-retur" class="info-number">999</span><br/>
                            <span class="info-text">Retur</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere red"></div>
                            <span id="number-sp2d-void" class="info-number">999</span><br/>
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
                            <span id="number-sp2d-nominal-gaji" class="info-number">999</span><br/>
                            <span class="info-text">Gaji</span>
                        </div>
                        <div class="pie-info-content full">
                            <div class="sphere purple"></div>
                            <span id="number-sp2d-nominal-non-gaji" class="info-number">999</span><br/>
                            <span class="info-text">Non Gaji</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div id="pie-lhp-container">
                    <canvas id="pie-lhp-canvas"></canvas>
                    <div id="pie-lhp-info" class="pie-info">
                        <div class="pie-info-title">Status LHP</div>
                        <div class="pie-info-content half">
                            <div class="sphere blue"></div>
                            <span id="number-lhp-completed" class="info-number">999</span><br/>
                            <span class="info-text">Completed</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere purple"></div>
                            <span id="number-lhp-validated" class="info-number">999</span><br/>
                            <span class="info-text">Validated</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere red"></div>
                            <span id="number-lhp-error" class="info-number">999</span><br/>
                            <span class="info-text">Error</span>
                        </div>
                        <div class="pie-info-content half">
                            <div class="sphere yellow"></div>
                            <span id="number-lhp-lainnya" class="info-number">999</span><br/>
                            <span class="info-text">Lainnya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ticker-container">
            <div id="ticker-ongoing-container">
                <div class="ticker-title">SPM Dalam Proses</div>
                <div class="ticker-content">Tidak ada data.</div>
            </div>
            <div id="ticker-completed-container">
                <div class="ticker-title">SP2D Selesai</div>
                <div class="ticker-content">Tidak ada data.</div>
            </div>
        </div>
        <div id="bottom-status-bar">
            <div>
                <div id="refresh-time"></div>
                <div style="float: right;">Tampilkan data: <a href="<?php echo URL; ?>home/harian" class="active">Hari Ini</a><a href="<?php echo URL; ?>home/mingguan">7 Hari</a><a href="<?php echo URL; ?>home/bulanan">30 Hari</a></div>
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
        dataStatusSPM = [
            {
                value: parseInt(homeDataJSON.jumlahSPMGaji) + parseInt(homeDataJSON.jumlahSPMNonGaji) + parseInt(homeDataJSON.jumlahSPMRetur) + parseInt(homeDataJSON.jumlahSPMVoid),
                color: "#409ACA"
            },
            {
                value : parseInt(homeDataJSON.jumlahSPMOngoing),
                color : "#F6CE40"
            }
        ];
        
        if (((parseInt(homeDataJSON.jumlahSPMGaji) + parseInt(homeDataJSON.jumlahSPMNonGaji) + parseInt(homeDataJSON.jumlahSPMRetur) + parseInt(homeDataJSON.jumlahSPMVoid)) == 0) && (parseInt(homeDataJSON.jumlahSPMOngoing) == 0)) {
            dataStatusSPM = [
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
                value : parseInt(homeDataJSON.jumlahSPMRetur),
                color : "#F6CE40"
            },
            {
                value : parseInt(homeDataJSON.jumlahSPMVoid),
                color : "#E35C5C"
            }
        ];
        
        if ((parseInt(homeDataJSON.jumlahSPMGaji) == 0) && (parseInt(homeDataJSON.jumlahSPMNonGaji) == 0) && (parseInt(homeDataJSON.jumlahSPMRetur) == 0) && (parseInt(homeDataJSON.jumlahSPMVoid) == 0)) {
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
        
        var canvasStatusSPM = $("#pie-status-canvas").get(0).getContext("2d");
        var chartStatusSPM = new Chart(canvasStatusSPM).Doughnut(dataStatusSPM);
        var canvasJumlahSPM = $("#pie-jenis-canvas").get(0).getContext("2d");
        var chartJumlahSPM = new Chart(canvasJumlahSPM).Doughnut(dataJumlahSPM);
        var canvasVolumeSPM = $("#pie-nominal-canvas").get(0).getContext("2d");
        var chartVolumeSPM = new Chart(canvasVolumeSPM).Doughnut(dataVolumeSPM);
        var canvasStatusLHP = $("#pie-lhp-canvas").get(0).getContext("2d");
        var chartStatusLHP = new Chart(canvasStatusLHP).Doughnut(dataStatusLHP);
        
        $("#number-sp2d-completed").html("" + (parseInt(homeDataJSON.jumlahSPMGaji) + parseInt(homeDataJSON.jumlahSPMNonGaji) + parseInt(homeDataJSON.jumlahSPMRetur) + parseInt(homeDataJSON.jumlahSPMVoid)));
        $("#number-sp2d-in-progress").html(homeDataJSON.jumlahSPMOngoing);
        
        $("#number-sp2d-gaji").html(homeDataJSON.jumlahSPMGaji);
        $("#number-sp2d-non-gaji").html(homeDataJSON.jumlahSPMNonGaji);
        $("#number-sp2d-retur").html(homeDataJSON.jumlahSPMRetur);
        $("#number-sp2d-void").html(homeDataJSON.jumlahSPMVoid);
        
        $("#number-sp2d-nominal-gaji").html(homeDataJSON.volumeSPMGaji + " M<span class='low-res-hidden'>ILYAR</span>");
        $("#number-sp2d-nominal-non-gaji").html(homeDataJSON.volumeSPMNonGaji + " M<span class='low-res-hidden'>ILYAR</span>");
        
        $("#number-lhp-completed").html(homeDataJSON.jumlahLHPCompleted);
        $("#number-lhp-validated").html(homeDataJSON.jumlahLHPValidated);
        $("#number-lhp-error").html(homeDataJSON.jumlahLHPError);
        $("#number-lhp-lainnya").html(homeDataJSON.jumlahLHPLainnya);
    }
    
    function calculateWidth() {
        //use this function and draw the chart automatically after, so the graph is drawn with the correct size
        $("#pie-status-canvas").attr("width",$("#pie-status-canvas").width()-1);
        $("#pie-status-canvas").attr("height",$("#pie-status-info").height());
        
        $("#pie-jenis-canvas").attr("width",$("#pie-jenis-canvas").width()-1);
        $("#pie-jenis-canvas").attr("height",$("#pie-jenis-info").height());
        
        $("#pie-nominal-canvas").attr("width",$("#pie-nominal-canvas").width()-1);
        $("#pie-nominal-canvas").attr("height",$("#pie-nominal-info").height());
        
        $("#pie-lhp-canvas").attr("width",$("#pie-lhp-canvas").width()-1);
        $("#pie-lhp-canvas").attr("height",$("#pie-lhp-info").height());
        
        $("#ticker-ongoing-container > .ticker-content").height($(window).innerHeight()-620);
        $("#ticker-completed-container > .ticker-content").height($(window).innerHeight()-620);
        
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
        
        $("#pie-status-canvas").removeAttr("width");
        $("#pie-status-canvas").removeAttr("height");
        $("#pie-status-canvas").removeAttr("style");
        
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
        $.ajax({
            'async': false,
            'global': false,
            'url': '<?php echo URL; ?>home/harianJSON',
            'dataType': "json",
            'success': function (data) {
                homeDataJSON = data;
                
                tickerOngoingTotal = homeDataJSON.spmDalamProses.length;
                for (i=0; i<homeDataJSON.spmDalamProses.length; i++) {
                    tickerOngoingContents += "<div id='ticker-item-" + i + "' class='ticker-item'>";
                    tickerOngoingContents +=   "<div class='kiri'>" + homeDataJSON.spmDalamProses[i].nomorSPM + "</div>";
                    tickerOngoingContents +=   "<div class='kiri spaced-left'>" + homeDataJSON.spmDalamProses[i].userSPM + "</div>";
                    tickerOngoingContents +=   "<div class='kanan spaced-right'>" + homeDataJSON.spmDalamProses[i].mulaiSPM + "</div>";
                    tickerOngoingContents += "</div>";
                }
                $("#ticker-ongoing-container > .ticker-content").html(tickerOngoingContents);
                
                tickerCompletedTotal = homeDataJSON.sp2dSelesai.length;
                if (homeDataJSON.sp2dSelesai.length > 0) {
                    for (j=0; j<homeDataJSON.sp2dSelesai.length; j++) {
                        tickerCompletedContents += "<div id='ticker-item-" + j + "' class='ticker-item'>";
                        tickerCompletedContents +=   "<div class='kiri'>" + homeDataJSON.sp2dSelesai[j].nomorSP2D + "</div>";
                        tickerCompletedContents +=   "<div class='kiri spaced-left'>" + homeDataJSON.sp2dSelesai[j].jenisSP2D + "</div>";
                        tickerCompletedContents +=   "<div class='kanan spaced-right'>" + homeDataJSON.sp2dSelesai[j].nominalSP2D + "</div>";
                        tickerCompletedContents += "</div>";
                    }
                    $("#ticker-completed-container > .ticker-content").html(tickerCompletedContents);
                }
            }
        });
        
        //prepare to draw
        redrawExecuted = false;
        setWindowMode();
    }
    
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
        homeDisplayProcessing();
        window.setInterval(homeDisplayProcessing(),20*60*1000);
    });
    
    $(window).resize(function() {
        redrawExecuted = false;
        setWindowMode();
    }); 
</script>