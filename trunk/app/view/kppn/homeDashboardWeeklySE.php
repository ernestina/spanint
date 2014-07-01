<div id="top">
	<div id="header">
        <h2>7 Hari Terakhir di <?php echo Session::get('user') ?></h2>
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
                        <div class="pie-info-title">Status LHP</div>
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
        <div id="line-container">
            <div id="line-chart-container">
                <div class="ticker-title">Histori Jumlah SP2D
                    <div class="line-legend">
                        <span class="sphere blue"></span>Gaji
                    </div>
                    <div class="line-legend">
                        <span class="sphere purple"></span>Non Gaji
                    </div>
                    <div class="line-legend">
                        <span class="sphere yellow"></span>Lainnya
                    </div>
                    <div class="line-legend">
                        <span class="sphere red"></span>Void
                    </div>
                </div>
                <canvas id="line-sp2d-canvas"></canvas>
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
                <div style="float: right;">Periode: <a href="<?php echo URL; ?>home/harian">Hari Ini</a><a href="<?php echo URL; ?>home/mingguan" class="active">7 Hari</a><a href="<?php echo URL; ?>home/bulanan">30 Hari</a></div>
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
    
    function renderLineChart() {
        for (i=0; i<7; i++) {
            if (homeDataJSON.spmNonGajiDetail[i] == "") {
                homeDataJSON.spmNonGajiDetail[i] = 0;
            }
            if (homeDataJSON.spmGajiDetail[i] == "") {
                homeDataJSON.spmGajiDetail[i] = 0;
            }
            if (homeDataJSON.spmLainnyaDetail[i] == "") {
                homeDataJSON.spmLainnyaDetail[i] = 0;
            }
            if (homeDataJSON.spmVoidDetail[i] == "") {
                homeDataJSON.spmVoidDetail[i] = 0;
            }
            
            homeDataJSON.spmNonGajiDetail[i] = parseInt(homeDataJSON.spmNonGajiDetail[i]);
            homeDataJSON.spmGajiDetail[i] = parseInt(homeDataJSON.spmGajiDetail[i]);
            homeDataJSON.spmLainnyaDetail[i] = parseInt(homeDataJSON.spmLainnyaDetail[i]);
            homeDataJSON.spmVoidDetail[i] = parseInt(homeDataJSON.spmVoidDetail[i]);
        }
        dataHistoriSP2D = {
            labels : homeDataJSON.tanggalPeriode,
            datasets : [
                {
                    fillColor : "rgba(142,86,150,0.5)",
                    strokeColor : "rgba(142,86,150,1)",
                    pointColor : "rgba(142,86,150,1)",
                    pointStrokeColor : "#fff",
                    data : homeDataJSON.spmNonGajiDetail
                },
                {
                    fillColor : "rgba(64,154,202,0.5)",
                    strokeColor : "rgba(64,154,202,1)",
                    pointColor : "rgba(64,154,202,1)",
                    pointStrokeColor : "#fff",
                    data : homeDataJSON.spmGajiDetail
                },
                {
                    fillColor : "rgba(246,206,64,0.5)",
                    strokeColor : "rgba(246,206,64,1)",
                    pointColor : "rgba(246,206,64,1)",
                    pointStrokeColor : "#fff",
                    data : homeDataJSON.spmLainnyaDetail
                },
                {
                    fillColor : "rgba(227,92,92,0.5)",
                    strokeColor : "rgba(227,92,92,1)",
                    pointColor : "rgba(227,92,92,1)",
                    pointStrokeColor : "#fff",
                    data : homeDataJSON.spmVoidDetail
                }
            ]
        };
        
        //display the chart
        var canvasHistoriSP2D = $("#line-sp2d-canvas").get(0).getContext("2d");
        var chartHistoriSP2D = new Chart(canvasHistoriSP2D).Line(dataHistoriSP2D);
    }
    
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
        
        $("#number-retur-completed").html(accounting.formatNumber(homeDataJSON.jumlahReturSudahProses) + " (" + accounting.formatNumber(parseInt(homeDataJSON.nominalReturSudahProses) / 1000000000) + " M<span class='low-res-hidden'>ILYAR</span>)");
        $("#number-retur-in-progress").html(accounting.formatNumber(homeDataJSON.jumlahReturBelumProses) + " (" + accounting.formatNumber(parseInt(homeDataJSON.nominalReturBelumProses) / 1000000000) + " M<span class='low-res-hidden'>ILYAR</span>)");
        
        $("#number-sp2d-gaji").html(accounting.formatNumber(homeDataJSON.jumlahSPMGaji));
        $("#number-sp2d-non-gaji").html(accounting.formatNumber(homeDataJSON.jumlahSPMNonGaji));
        $("#number-sp2d-retur").html(accounting.formatNumber(homeDataJSON.jumlahSPMLainnya));
        $("#number-sp2d-void").html(accounting.formatNumber(homeDataJSON.jumlahSPMVoid));
        
        $("#number-sp2d-nominal-gaji").html(accounting.formatNumber(homeDataJSON.volumeSPMGaji) + " M<span class='low-res-hidden'>ILYAR</span>");
        $("#number-sp2d-nominal-non-gaji").html(accounting.formatNumber(homeDataJSON.volumeSPMNonGaji) + " M<span class='low-res-hidden'>ILYAR</span>");
        
        $("#number-lhp-completed").html(accounting.formatNumber(homeDataJSON.jumlahLHPCompleted));
        $("#number-lhp-validated").html(accounting.formatNumber(homeDataJSON.jumlahLHPValidated));
        $("#number-lhp-error").html(accounting.formatNumber(homeDataJSON.jumlahLHPError));
        $("#number-lhp-lainnya").html(accounting.formatNumber(homeDataJSON.jumlahLHPLainnya));
        
        renderLineChart();
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
        
        $("#line-sp2d-canvas").attr("width",$("#line-sp2d-canvas").parent().innerWidth()-40);
        $("#line-sp2d-canvas").attr("height",$(window).innerHeight()-640);
        
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
                redrawExecuted = true;
                calculateWidth();
            }
        }, 500);
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
        
        $.ajax({
            'async': false,
            'global': false,
            'url': '<?php echo URL; ?>home/mingguanJSON'+urlAddon,
            'dataType': "json",
            'success': function (data) {
                homeDataJSON = data;
            }
        });
        
        //prepare to draw
        redrawExecuted = false;
        setWindowMode();
    }
    
    $('#kppn-list').change(function() {
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
        homeDisplayProcessing();
        window.setInterval(homeDisplayProcessing(),20*60*1000);
    });
    
    $(window).resize(function() {
        redrawExecuted = false; 
        setWindowMode();
    }); 
</script>