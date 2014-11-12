<!-- A beautiful app starts with a beautiful code :) -->

<script type="text/javascript" charset="utf-8">
    
    dashMode = true;
    
    Chart.defaults.global.responsive = true;
    Chart.defaults.global.showTooltips = false;
    Chart.defaults.global.maintainAspectRatio = false;
    
    //Jenis SP2D
    
    <?php

    $total_gaji = 0;
    $total_non_gaji = 0;
    $total_lainnya = 0;
    $total_void = 0;

    $total_gaji += $this->pieJenisSP2D->get_gaji();
    $total_non_gaji += $this->pieJenisSP2D->get_non_gaji();
    $total_void += $this->pieJenisSP2D->get_void();
    $total_lainnya += $this->pieJenisSP2D->get_lainnya();

    ?>
    
    var pieJenisSP2DData = [

        {
            "value" : <?php echo $total_gaji; ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_non_gaji; ?>,
            "color" : "#8E5696"
        },
        {
            "value" : <?php echo $total_lainnya; ?>,
            "color" : "#F6CE40"
        },
        {
            "value" : <?php echo $total_void; ?>,
            "color" : "#E35C5C"
        }
        
        <?php if ($total_void + $total_lainnya + $total_non_gaji + $total_gaji == 0) { ?>
        
        ,{
            
            "value" : 1,
            "color" : "#F3F3F3"
            
        }
        
        <?php } ?>

    ]
    
    //Nominal SP2D
    
    <?php

    $total_vol_gaji = 0;
    $total_vol_non_gaji = 0;
    $total_vol_lainnya = 0;

    $total_vol_gaji += $this->pieNominalSP2D->get_vol_gaji();
    $total_vol_non_gaji += $this->pieNominalSP2D->get_vol_non_gaji();
    $total_vol_lainnya += $this->pieNominalSP2D->get_vol_lainnya();

    ?>
    
    var pieNominalSP2DData = [

        {
            "value" : <?php echo $total_vol_gaji; ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_vol_non_gaji; ?>,
            "color" : "#8E5696"
        },{
            "value" : <?php echo $total_vol_lainnya; ?>,
            "color" : "#F6CE40"
        }
        
        <?php if ($total_vol_non_gaji + $total_vol_gaji + $total_vol_lainnya == 0) { ?>
        
        ,{
            
            "value" : 1,
            "color" : "#F3F3F3"
            
        }
        
        <?php } ?>

    ]
    
    //Retur SP2D
    
    var pieJumlahReturSP2DData = [

        {
            "value" : <?php echo $this->pieReturSP2D->get_retur_sudah_proses(); ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $this->pieReturSP2D->get_retur_belum_proses(); ?>,
            "color" : "#F6CE40"
        }

    ]
    
    var pieNominalReturSP2DData = [

        {
            "value" : <?php echo $this->pieReturSP2D->get_vol_retur_sudah_proses(); ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $this->pieReturSP2D->get_vol_retur_belum_proses(); ?>,
            "color" : "#F6CE40"
        }

    ]
    
    //Status LHP
    
    <?php

    $total_lhp_completed = 0;
    $total_lhp_validated = 0;
    $total_lhp_error = 0;
    $total_lhp_etc = 0;

    $tanggal_lhp = "";

    //var_dump($this->data_lhp_rekap);

    foreach ($this->pieStatusLHP as $lhp_rekap_harian) {
        $tanggal_lhp = $lhp_rekap_harian->get_tgl_lhp();
        
        $total_lhp_completed += $lhp_rekap_harian->get_lhp_completed();
        $total_lhp_validated += $lhp_rekap_harian->get_lhp_validated();
        $total_lhp_error += $lhp_rekap_harian->get_lhp_error();
        $total_lhp_etc += $lhp_rekap_harian->get_lhp_etc();
        
        $total_vol_lhp_completed += $lhp_rekap_harian->get_vol_lhp_completed();
        $total_vol_lhp_validated += $lhp_rekap_harian->get_vol_lhp_validated();
        $total_vol_lhp_error += $lhp_rekap_harian->get_vol_lhp_error();
        $total_vol_lhp_etc += $lhp_rekap_harian->get_vol_lhp_etc();
    }

    ?>
    
    var pieStatusLHPData = [

        {
            "value" : <?php echo $total_lhp_completed; ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_lhp_validated; ?>,
            "color" : "#8E5696"
        },
        {
            "value" : <?php echo $total_lhp_etc; ?>,
            "color" : "#F6CE40"
        },
        {
            "value" : <?php echo $total_lhp_error; ?>,
            "color" : "#E35C5C"
        }

    ]
    
    var pieNominalLHPData = [

        {
            "value" : <?php echo $total_vol_lhp_completed; ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_vol_lhp_validated; ?>,
            "color" : "#8E5696"
        },
        {
            "value" : <?php echo $total_vol_lhp_etc; ?>,
            "color" : "#F6CE40"
        },
        {
            "value" : <?php echo $total_vol_lhp_error; ?>,
            "color" : "#E35C5C"
        }

    ]
    
    <?php if (isset($this->summaryUnit)) { ?>
    
    var lineHistSP2DData =  {

        "labels" : [
            
            <?php 
        
                $count_unit = 0;

                foreach ($this->summaryUnit as $value) {
                    
                    $total_sp2d = 0;

                    foreach ($value->data_sp2d_rekap as $sp2d_rekap_harian) {
                        $total_sp2d += $sp2d_rekap_harian->get_gaji();
                        $total_sp2d += $sp2d_rekap_harian->get_non_gaji();
                        $total_sp2d += $sp2d_rekap_harian->get_void();
                        $total_sp2d += $sp2d_rekap_harian->get_lainnya();
                    }
                    
                    if (($value->data_pos_spm > 0) && ($total_sp2d > 0)) {
                        if ($count_unit > 0) { echo " , "; }
                        echo '"'.$value->nama_unit.'"';
                        $count_unit ++;
                    }
                    
                } 
            
            ?>

        ],

        "datasets" : [
            {
                "fillColor" : "rgba(64,154,202,0.5)",
                "strokeColor" : "rgba(64,154,202,1)",
                "pointColor" : "rgba(64,154,202,1)",
                "pointStrokeColor" : "#fff",
                "data" : [
                
                    <?php 

                        $count_unit = 0;

                        foreach ($this->summaryUnit as $value) {
                            
                            $total_sp2d = 0;

                            foreach ($value->data_sp2d_rekap as $sp2d_rekap_harian) {
                                $total_sp2d += $sp2d_rekap_harian->get_gaji();
                                $total_sp2d += $sp2d_rekap_harian->get_non_gaji();
                                $total_sp2d += $sp2d_rekap_harian->get_void();
                                $total_sp2d += $sp2d_rekap_harian->get_lainnya();
                            }
                            
                            if (($value->data_pos_spm > 0) && ($total_sp2d > 0)) {
                                if ($count_unit > 0) { echo " , "; }
                                echo $total_sp2d;
                                $count_unit ++;
                            }
                            
                        } 

                    ?>
                
                ]
            },
            {
                "fillColor" : "rgba(227,92,92,0.5)",
                "strokeColor" : "rgba(227,92,92,1)",
                "pointColor" : "rgba(227,92,92,1)",
                "pointStrokeColor" : "#fff",
                "data" : [

                    <?php 

                        $count_unit = 0;

                        foreach ($this->summaryUnit as $value) {
                            
                            $total_sp2d = 0;

                            foreach ($value->data_sp2d_rekap as $sp2d_rekap_harian) {
                                $total_sp2d += $sp2d_rekap_harian->get_gaji();
                                $total_sp2d += $sp2d_rekap_harian->get_non_gaji();
                                $total_sp2d += $sp2d_rekap_harian->get_void();
                                $total_sp2d += $sp2d_rekap_harian->get_lainnya();
                            }
                            
                            if (($value->data_pos_spm > 0) && ($total_sp2d > 0)) {
                                if ($count_unit > 0) { echo " , "; }
                                echo $value->data_pos_spm;
                                $count_unit ++;
                            }
                            
                        }

                    ?>

                ]
            }
        ]

    }
    
    <?php } ?>
    
</script>

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12"><h2>Dashboard</h2></div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 align-right top-padded">
                
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 align-right top-padded">
                
            </div>
        </div>
        <div class="row top-padded-little">
            
            <div class="col-md-6 col-sm-12">
                <?php echo "PENERBITAN SP2D HARI INI"; ?>
                <br/>
                <?php

                    if (!isset($this->kodeunit)) {
                        if (Session::get('role') == ADMIN) {
                            echo "DJPB";
                        } else {
                            echo Session::get('user');
                        }
                    } else {
                        echo $this->namaunit;
                    }

                ?>
            </div>
            
            <div class="col-md-6 col-sm-12 align-right">
                <?php

                if (isset($this->last_update)) {
                    echo "Update Data Terakhir (Waktu Server)<br>" . $this->last_update . " WIB";
                }

                ?>
            </div>
        </div>
    </div>
</div>

<div class="main-window-segment sub-segment">
    <div class="container-fluid">

        <div class="row top-padded">
            <div class="col-md-6">
                
                <?php if ((Session::get('role') == ADMIN) && !isset($this->kodeunit)) { ?>
                
                <h4>Lihat Detail Unit: &nbsp;
                <select id="ke_unit">  
                            
                    <?php 
                    
                        echo '<option value="">Pilih unit...</option>';
                    
                        if (isset($this->summaryUnit)) {
        
                            $count_unit = 0;

                            foreach ($this->summaryUnit as $value) {

                                $total_sp2d = 0;

                                foreach ($value->data_sp2d_rekap as $sp2d_rekap_harian) {
                                    $total_sp2d += $sp2d_rekap_harian->get_gaji();
                                    $total_sp2d += $sp2d_rekap_harian->get_non_gaji();
                                    $total_sp2d += $sp2d_rekap_harian->get_void();
                                    $total_sp2d += $sp2d_rekap_harian->get_lainnya();
                                }

                                if ((($value->data_pos_spm > 0) || ($total_sp2d > 0)) && ($value->nama_unit[0] == 'K')) {
                                    if ($count_unit > 0) { echo " , "; }
                                    echo '<option value="'.$value->nama_unit.'">'.$value->nama_unit.' - '.$value->nama_lengkap_unit.'</option>';
                                    $count_unit ++;
                                }

                            } 
                            
                        } else {
                            
                            foreach ($this->unit_list as $value) {

                                echo '<option value="'.$value->get_kd_d_kppn().'">'.$value->get_kd_d_kppn().'</option>';

                            } 
                            
                        }

                    ?>

                </select>
                </h4>
                
                <?php } ?>
                
            </div>

            <div class="col-md-6 align-right top-padded-little">
                
                <?php

                    if (isset($this->kodeunit) && (Session::get('role') == ADMIN)) {
                        
                        echo 'Kembali ke: &nbsp;';
                        echo '<a href="'.URL.'home/dashboardPenerbitan/">DJPB</a>';
                        
                    }

                ?>
                
            </div>
        </div>
        
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                <div class="pie-segment">
                    <div class="pie-canvas"><canvas id="pieJenisSP2D"></canvas></div>
                    <div class="pie-legend">
                        <h4>Jenis SP2D</h4>
                        <div style="width: 50%; float: left; border-left: 4px solid #409ACA">
                            <p><?php echo number_format($total_gaji); ?></p>
                            <p class="sub">Gaji</p>
                        </div>
                        <div style="width: 50%; float: left; border-left: 4px solid #8E5696">
                            <p><?php echo number_format($total_non_gaji); ?></p>
                            <p class="sub">Non Gaji</p>
                        </div>
                        <div style="width: 50%; float: left; border-left: 4px solid #F6CE40">
                            <p><?php echo number_format($total_lainnya); ?></p>
                            <p class="sub">Lainnya</p>
                        </div>
                        <div style="width: 50%; float: left; border-left: 4px solid #E35C5C">
                            <p><?php echo number_format($total_void); ?></p>
                            <p class="sub">Void</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                <div class="pie-segment">
                    <div class="pie-canvas"><canvas id="pieNominalSP2D"></canvas></div>
                    <div class="pie-legend">
                        <h4>Nominal SP2D</h4>
                        <div style="width: 50%; float: left; border-left: 4px solid #409ACA">
                            <p><?php echo (number_format(round(($total_vol_gaji / 1000000000), 2), 2)." M"); ?></p>
                            <p class="sub">Gaji</p>
                        </div>
                        <div style="width: 50%; float: left; border-left: 4px solid #F6CE40">
                            <p><?php echo (number_format(round(($total_vol_lainnya / 1000000000), 2), 2)." M"); ?></p>
                            <p class="sub">Lainnya</p>
                        </div>
                        <div style="width: 100%; float: left; border-left: 4px solid #8E5696">
                            <p><?php echo (number_format(round(($total_vol_non_gaji / 1000000000), 2), 2)." M"); ?></p>
                            <p class="sub">Non Gaji</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                
                <div class="pie-segment" id="pie-jumlah-retur">
                    <div class="pie-canvas"><canvas id="pieJumlahReturSP2D"></canvas></div>
                    <div class="pie-legend">
                        <h4>Retur SP2D</h4>
                        <div id="legend-jumlah-retur">
                            <div style="width: 100%; float: left; border-left: 4px solid #409ACA">
                                <p><?php echo (number_format($this->pieReturSP2D->get_retur_sudah_proses())); ?> SP2D</p>
                                <p class="sub">Sudah Proses</p>
                            </div>
                            <div style="width: 100%; float: left; border-left: 4px solid #F6CE40">
                                <p><?php echo (number_format($this->pieReturSP2D->get_retur_belum_proses())); ?> SP2D</p>
                                <p class="sub">Belum Proses</p>
                            </div>
                        </div>
                        <div id="legend-nominal-retur" style="display:none">
                            <div style="width: 100%; float: left; border-left: 4px solid #409ACA">
                                <p><?php echo (number_format(round($this->pieReturSP2D->get_vol_retur_sudah_proses() / 1000000000, 2), 2)." M"); ?></p>
                                <p class="sub">Sudah Proses</p>
                            </div>
                            <div style="width: 100%; float: left; border-left: 4px solid #F6CE40">
                                <p><?php echo (number_format(round($this->pieReturSP2D->get_vol_retur_belum_proses() / 1000000000, 2), 2)." M"); ?></p>
                                <p class="sub">Belum Proses</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <?php if (Session::get('role')==SATKER) { ?>
            
                <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                    <div class="pie-segment">
                        <div class="pie-canvas"><canvas id="pieStatusDIPA"></canvas></div>
                        <div class="pie-legend">
                            <h4>DIPA (<?php echo (number_format(round(($tot_actual + $tot_encumbrance + $tot_balancing) / 1000000000, 2), 2)." M"); ?>)</h4>
                            <div style="width: 100%; float: left; border-left: 4px solid #409ACA">
                                <p><?php echo (number_format(round(($tot_actual + $tot_encumbrance) / 1000000000, 2), 2)." M (".round($tot_actual / ($tot_actual + $tot_encumbrance + $tot_balancing) * 100, 2)."%)"); ?></p>
                                <p class="sub">Terpakai</p>
                            </div>
                            <div style="width: 100%; float: left; border-left: 4px solid #8E5696">
                                <p><?php echo (number_format(round($tot_balancing / 1000000000, 2), 2)." M (".round($tot_balancing / ($tot_actual + $tot_encumbrance + $tot_balancing) * 100, 2)."%)"); ?></p>
                                <p class="sub">Sisa</p>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php } else { ?>

                <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                    <div class="pie-segment">
                        <div class="pie-canvas"><canvas id="pieStatusLHP"></canvas></div>
                        <div class="pie-legend">
                            <h4>LHP (<?php echo $tanggal_lhp; ?>)</h4>
                            <div id="legend-jumlah-lhp">
                                <div style="width: 50%; float: left; border-left: 4px solid #409ACA">
                                    <p><?php echo number_format($total_lhp_completed); ?></p>
                                    <p class="sub">Completed</p>
                                </div>
                                <div style="width: 50%; float: left; border-left: 4px solid #8E5696">
                                    <p><?php echo number_format($total_lhp_validated); ?></p>
                                    <p class="sub">Validated</p>
                                </div>
                                <div style="width: 50%; float: left; border-left: 4px solid #F6CE40">
                                    <p><?php echo number_format($total_lhp_etc); ?></p>
                                    <p class="sub">Lainnya</p>
                                </div>
                                <div style="width: 50%; float: left; border-left: 4px solid #E35C5C">
                                    <p><?php echo number_format($total_lhp_error); ?></p>
                                    <p class="sub">Error</p>
                                </div>
                            </div>
                            <div id="legend-nominal-lhp" style="display:none">
                                <div style="width: 50%; float: left; border-left: 4px solid #409ACA">
                                    <p><?php echo (number_format(round($total_vol_lhp_completed / 1000000000, 2), 2)." M"); ?></p>
                                    <p class="sub">Completed</p>
                                </div>
                                <div style="width: 50%; float: left; border-left: 4px solid #8E5696">
                                    <p><?php echo (number_format(round($total_vol_lhp_validated / 1000000000, 2), 2)." M"); ?></p>
                                    <p class="sub">Validated</p>
                                </div>
                                <div style="width: 50%; float: left; border-left: 4px solid #F6CE40">
                                    <p><?php echo (number_format(round($total_vol_lhp_etc / 1000000000, 2), 2)." M"); ?></p>
                                    <p class="sub">Lainnya</p>
                                </div>
                                <div style="width: 50%; float: left; border-left: 4px solid #E35C5C">
                                    <p><?php echo (number_format(round($total_vol_lhp_error / 1000000000, 2), 2)." M"); ?></p>
                                    <p class="sub">Error</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php } ?>

        </div>

        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12">

            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

            </div>    

        </div>

    </div>
</div>

<?php if (isset($this->summaryUnit)) { ?>

<div style="padding: 0px 10px;">
    <div class="container-fluid">

        <div class="row top-padded">
            <div class="col-md-6">
                <h4>Status Penerbitan SP2D</h4>
            </div>

            <div class="col-md-6 align-right top-padded-little">
                <div class="sub" style="float: right; margin-left: 10px; padding-left: 5px; border-left: 8px solid #E35C5C">SPM Dalam Proses</div>
                <div class="sub" style="float: right; margin-left: 10px; padding-left: 5px; border-left: 8px solid #409ACA">SP2D Selesai</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="dashboard-line" class="top-padded" style="border-top: 1px solid #e5e5e5;">
                    <canvas id="lineHistSP2D"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<?php } ?>

<script type="text/javascript" charset="utf-8">
    
    $('#ke_unit').change(function() {
       
        window.location.assign('<?php echo URL; ?>home/dashboardPenerbitan/' + $(this).val());
        
    });
    
    //Render Charts
    $(document).ready(function() {
        $(".pie-canvas").each(function() {
            $(this).css("height", $(this).parent().children(".pie-legend").height());
        });
        window.setTimeout(function() {
            
            var pieJenisSP2DCanvas = document.getElementById("pieJenisSP2D").getContext("2d");
            var pieJenisSP2D = new Chart(pieJenisSP2DCanvas).Doughnut(pieJenisSP2DData);

            var pieNominalSP2DCanvas = document.getElementById("pieNominalSP2D").getContext("2d");
            var pieNominalSP2D = new Chart(pieNominalSP2DCanvas).Doughnut(pieNominalSP2DData);

            var pieJumlahReturSP2DCanvas = document.getElementById("pieJumlahReturSP2D").getContext("2d");
            var pieJumlahReturSP2D = new Chart(pieJumlahReturSP2DCanvas).Doughnut(pieJumlahReturSP2DData);

            var pieStatusLHPCanvas = document.getElementById("pieStatusLHP").getContext("2d");
            var pieStatusLHP = new Chart(pieStatusLHPCanvas).Doughnut(pieStatusLHPData);
            
            <?php if (isset($this->summaryUnit)) { ?>
            
                Chart.defaults.global.showTooltips = true;
            
                var lineHistSP2DCanvas = document.getElementById("lineHistSP2D").getContext("2d");
                var lineHistSP2D = new Chart(lineHistSP2DCanvas).Bar(lineHistSP2DData); 
            
            <?php } ?>
            
            window.setInterval(function() {
            
                if ($('#legend-jumlah-retur').css('display') == 'none' || $('#legend-jumlah-retur').css('visibility') == 'hidden') {
                    
                    $('#legend-nominal-retur').fadeOut(400, function() { 
                        $('#legend-jumlah-retur').fadeIn(); 
                        pieJumlahReturSP2D.segments[0].value = pieJumlahReturSP2DData[0].value;
                        pieJumlahReturSP2D.segments[1].value = pieJumlahReturSP2DData[1].value;
                        pieJumlahReturSP2D.update();
                    });
                    
                } else {
                    
                    $('#legend-jumlah-retur').fadeOut(400, function() { 
                        $('#legend-nominal-retur').fadeIn();
                        pieJumlahReturSP2D.segments[0].value = pieNominalReturSP2DData[0].value;
                        pieJumlahReturSP2D.segments[1].value = pieNominalReturSP2DData[1].value;
                        pieJumlahReturSP2D.update();
                    });
                    
                }
                
                if ($('#legend-jumlah-lhp').css('display') == 'none' || $('#legend-jumlah-lhp').css('visibility') == 'hidden') {
                    
                    $('#legend-nominal-lhp').fadeOut(400, function() { 
                        $('#legend-jumlah-lhp').fadeIn(); 
                        pieStatusLHP.segments[0].value = pieStatusLHPData[0].value;
                        pieStatusLHP.segments[1].value = pieStatusLHPData[1].value;
                        pieStatusLHP.update();
                    });
                    
                } else {
                    
                    $('#legend-jumlah-lhp').fadeOut(400, function() { 
                        $('#legend-nominal-lhp').fadeIn();
                        pieStatusLHP.segments[0].value = pieNominalLHPData[0].value;
                        pieStatusLHP.segments[1].value = pieNominalLHPData[1].value;
                        pieStatusLHP.update();
                    });
                    
                }
            
            }, 7000);
            
        }, 1000);
        
    });

</script>