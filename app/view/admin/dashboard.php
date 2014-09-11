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
            "index" : "<?php echo number_format($total_gaji); ?>",
            "label" : "Gaji",
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_non_gaji; ?>,
            "index" : "<?php echo number_format($total_non_gaji); ?>",
            "label" : "Non Gaji",
            "color" : "#8E5696"
        },
        {
            "value" : <?php echo $total_lainnya; ?>,
            "index" : "<?php echo number_format($total_lainnya); ?>",
            "label" : "Lainnya",
            "color" : "#F6CE40"
        },
        {
            "value" : <?php echo $total_void; ?>,
            "index" : "<?php echo number_format($total_void); ?>",
            "label" : "Void",
            "color" : "#E35C5C"
        }

    ]
    
    //Nominal SP2D
    
    <?php

    $total_vol_gaji = 0;
    $total_vol_non_gaji = 0;

    $total_vol_gaji += $this->pieNominalSP2D->get_vol_gaji();
    $total_vol_non_gaji += $this->pieNominalSP2D->get_vol_non_gaji();

    ?>
    
    var pieNominalSP2DData = [

        {
            "value" : <?php echo $total_vol_gaji; ?>,
            "index" : "<?php echo (number_format(round(($total_vol_gaji / 1000000000), 2), 2)." M"); ?>",
            "label" : "Gaji",
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_vol_non_gaji; ?>,
            "index" : "<?php echo (number_format(round(($total_vol_non_gaji / 1000000000), 2), 2)." M"); ?>",
            "label" : "Non Gaji",
            "color" : "#8E5696"
        }

    ]
    
    //Retur SP2D
    
    var pieReturSP2DData = [

        {
            "value" : <?php echo $this->pieReturSP2D->get_retur_sudah_proses(); ?>,
            "index" : "<?php echo (number_format($this->pieReturSP2D->get_retur_sudah_proses())." (".number_format(round($this->pieReturSP2D->get_vol_retur_sudah_proses() / 1000000000, 2), 2)." M)"); ?>",
            "label" : "Sudah Proses",
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $this->pieReturSP2D->get_retur_belum_proses(); ?>,
            "index" : "<?php echo (number_format($this->pieReturSP2D->get_retur_belum_proses())." (".number_format(round($this->pieReturSP2D->get_vol_retur_belum_proses() / 1000000000, 2), 2)." M)"); ?>",
            "label" : "Belum Proses",
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
    }

    ?>
    
    var pieStatusLHPData = [

        {
            "value" : <?php echo $total_lhp_completed; ?>,
            "index" : "<?php echo number_format($total_lhp_completed); ?>",
            "label" : "Completed",
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $total_lhp_validated; ?>,
            "index" : "<?php echo number_format($total_lhp_validated); ?>",
            "label" : "Validated",
            "color" : "#8E5696"
        },
        {
            "value" : <?php echo $total_lhp_etc; ?>,
            "index" : "<?php echo number_format($total_lhp_etc); ?>",
            "label" : "Lainnya",
            "color" : "#F6CE40"
        },
        {
            "value" : <?php echo $total_lhp_error; ?>,
            "index" : "<?php echo number_format($total_lhp_error); ?>",
            "label" : "Error",
            "color" : "#E35C5C"
        }

    ]
    
    <?php if (isset($this->lineHistSP2D)) { ?>
    
    var lineHistSP2DData =  {

        "labels" : [

        <?php 

        //var_dump($this->data_sp2d_rekap);

        for ($i=($this->periode - 1); $i>=0; $i--) {
            if ($i < ($this->periode - 1)) {
                echo ' , ';
            }
            echo '"'.date("d-m",time()-($i*24*60*60)).'"';
        } ?>

        ],

        "datasets" : [
            {
                "fillColor" : "rgba(64,154,202,0.5)",
                "strokeColor" : "rgba(64,154,202,1)",
                "pointColor" : "rgba(64,154,202,1)",
                "pointStrokeColor" : "#fff",
                "data" : [
                
                <?php for ($i=($this->periode - 1); $i>=0; $i--) {
                    if ($i < ($this->periode - 1)) {
                        echo ' , ';
                    }
                    echo ''.$this->lineHistSP2D[$i]->get_gaji().'';
                } ?>
                
                ]
            },
            {
                "fillColor" : "rgba(142,86,150,0.5)",
                "strokeColor" : "rgba(142,86,150,1)",
                "pointColor" : "rgba(142,86,150,1)",
                "pointStrokeColor" : "#fff",
                "data" : [

                <?php for ($i=($this->periode - 1); $i>=0; $i--) {
                    if ($i < ($this->periode - 1)) {
                        echo ' , ';
                    }
                    echo ''.$this->lineHistSP2D[$i]->get_non_gaji().'';
                } ?>

                ]
            },
            {
                "fillColor" : "rgba(246,206,64,0.5)",
                "strokeColor" : "rgba(246,206,64,1)",
                "pointColor" : "rgba(246,206,64,1)",
                "pointStrokeColor" : "#fff",
                "data" : [

                <?php for ($i=($this->periode - 1); $i>=0; $i--) {
                    if ($i < ($this->periode - 1)) {
                        echo ' , ';
                    }
                    echo ''.$this->lineHistSP2D[$i]->get_lainnya().'';
                } ?>    

                ]
            },
            {
                "fillColor" : "rgba(227,92,92,0.5)",
                "strokeColor" : "rgba(227,92,92,1)",
                "pointColor" : "rgba(227,92,92,1)",
                "pointStrokeColor" : "#fff",
                "data" : [

                <?php for ($i=($this->periode - 1); $i>=0; $i--) {
                    if ($i < ($this->periode - 1)) {
                        echo ' , ';
                    }
                    echo ''.$this->lineHistSP2D[$i]->get_void().'';
                } ?>

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
            
            <div class="col-lg-10 col-md-6 col-sm-12"><h2>Dashboard: Hari Ini</h2></div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 align-right top-padded">
                <button type="button" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> 7 Hari</button>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 align-right top-padded">
                <button type="button" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> 30 Hari</button>
            </div>
        </div>
        <div class="row top-padded-little">
            
            <div class="col-md-6 col-sm-12">			 
                <?php

                if (!isset($this->kodeunit)) {
                    if (Session::get('role') == KANWIL) {
                        echo Session::get('user');
                    } else {
                        echo "DJPB";
                    }
                } else {
                    if (Session::get('role') == KPPN) {
                        echo Session::get('user');
                    } else {
                        echo $this->namaunit;
                    }
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
                        <div style="width: 100%; float: left; border-left: 4px solid #409ACA">
                            <p><?php echo (number_format(round(($total_vol_gaji / 1000000000), 2), 2)." M"); ?></p>
                            <p class="sub">Gaji</p>
                        </div>
                        <div style="width: 100%; float: left; border-left: 4px solid #8E5696">
                            <p><?php echo (number_format(round(($total_vol_non_gaji / 1000000000), 2), 2)." M"); ?></p>
                            <p class="sub">Non Gaji</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                <div class="pie-segment">
                    <div class="pie-canvas"><canvas id="pieReturSP2D"></canvas></div>
                    <div class="pie-legend">
                        <h4>Retur SP2D</h4>
                        <div style="width: 100%; float: left; border-left: 4px solid #409ACA">
                            <p><?php echo (number_format($this->pieReturSP2D->get_retur_sudah_proses())." (".number_format(round($this->pieReturSP2D->get_vol_retur_sudah_proses() / 1000000000, 2), 2)." M)"); ?></p>
                            <p class="sub">Sudah Proses</p>
                        </div>
                        <div style="width: 100%; float: left; border-left: 4px solid #8E5696">
                            <p><?php echo (number_format($this->pieReturSP2D->get_retur_belum_proses())." (".number_format(round($this->pieReturSP2D->get_vol_retur_belum_proses() / 1000000000, 2), 2)." M)"); ?></p>
                            <p class="sub">Belum Proses</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                <div class="pie-segment">
                    <div class="pie-canvas"><canvas id="pieStatusLHP"></canvas></div>
                    <div class="pie-legend">
                        <h4>LHP (<?php echo $tanggal_lhp; ?>)</h4>
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
                </div>
            </div>

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

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        
        <thead>
            <tr>
                <th rowspan="2" style="text-align: left;">Unit</th>
                <th rowspan="2">SPM dalam Proses</th>
                <th colspan="5">Penerbitan SP2D</th>
                <th colspan="2">Retur SP2D</th>
                <th colspan="5">Status LHP</th>
            </tr>
            <tr>
                <th>Gaji</th>
                <th>Non Gaji</th>
                <th>Lainnya</th>
                <th>Void</th>
                <th>Total</th>
                <th>Sudah Proses</th>
                <th>Belum Proses</th>
                <th>Completed</th>
                <th>Validated</th>
                <th>Lainnya</th>
                <th>Error</th>
                <th>Total</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php if (empty($this->summaryUnit)) { ?>

                <td colspan=14 class="align-center">Tidak ada data.</td>

            <?php } else { ?>
            
                <?php
                          
                    $total_pos_spm = 0;
                          
                ?>

                <?php foreach ($this->summaryUnit as $value) { ?>

                    <?php

                        $total_row_gaji = 0;
                        $total_row_non_gaji = 0;
                        $total_row_lainnya = 0;
                        $total_row_void = 0;

                        foreach ($value->data_sp2d_rekap as $sp2d_rekap_harian) {
                            $total_row_gaji += $sp2d_rekap_harian->get_gaji();
                            $total_row_non_gaji += $sp2d_rekap_harian->get_non_gaji();
                            $total_row_void += $sp2d_rekap_harian->get_void();
                            $total_row_lainnya += $sp2d_rekap_harian->get_lainnya();
                        }

                        $total_row_lhp_completed = 0;
                        $total_row_lhp_validated = 0;
                        $total_row_lhp_error = 0;
                        $total_row_lhp_etc = 0;

                        foreach ($value->data_lhp_rekap as $lhp_rekap_harian) {
                            $tanggal_lhp = $lhp_rekap_harian->get_tgl_lhp();
                            $total_row_lhp_completed += $lhp_rekap_harian->get_lhp_completed();
                            $total_row_lhp_validated += $lhp_rekap_harian->get_lhp_validated();
                            $total_row_lhp_error += $lhp_rekap_harian->get_lhp_error();
                            $total_row_lhp_etc += $lhp_rekap_harian->get_lhp_etc();
                        }
                    
                        $overtotal = $total_row_gaji + $total_row_non_gaji + $total_row_lainnya + $total_row_void + $value->data_retur->get_retur_sudah_proses() + $value->data_retur->get_retur_belum_proses() + $total_row_lhp_completed + $total_row_lhp_validated + $total_row_lhp_etc + $total_row_lhp_error;

                    ?>
            
                    <?php //if ($overtotal > 0) { ?>

                        <tr>
                            <td><a href="<?php echo URL; ?>home/dashboard/harian/<?php echo $value->nama_unit; ?>"><?php echo $value->nama_lengkap_unit; ?></a></td>

                            <td class="align-center"><?php echo $value->data_pos_spm; $total_pos_spm += $value->data_pos_spm; ?></td> 

                            <td class="align-center"><?php echo $total_row_gaji; ?></td> 
                            <td class="align-center"><?php echo $total_row_non_gaji; ?></td> 
                            <td class="align-center"><?php echo $total_row_lainnya; ?></td>
                            <td class="align-center"><?php echo $total_row_void; ?></td> 
                            <td class="align-center"><?php echo ($total_row_gaji + $total_row_non_gaji + $total_row_lainnya + $total_row_void); ?></td> 

                            <td class="align-center"><?php echo $value->data_retur->get_retur_sudah_proses(); ?></td> 
                            <td class="align-center"><?php echo $value->data_retur->get_retur_belum_proses(); ?></td>

                            <td class="align-center"><?php echo $total_row_lhp_completed; ?></td>
                            <td class="align-center"><?php echo $total_row_lhp_validated; ?></td>
                            <td class="align-center"><?php echo $total_row_lhp_etc; ?></td>
                            <td class="align-center"><?php echo $total_row_lhp_error; ?></td>
                            <td class="align-center"><?php echo ($total_row_lhp_completed + $total_row_lhp_validated + $total_row_lhp_etc + $total_row_lhp_error); ?></td>
                        </tr>
                    
                    <?php //} ?>

            <?php } ?>
            
            <tfoot>
                <tr>
                    <td>Total</td>

                    <td class="align-center"><?php echo $total_pos_spm; ?></td> 

                    <td class="align-center"><?php echo $total_gaji; ?></td> 
                    <td class="align-center"><?php echo $total_non_gaji; ?></td> 
                    <td class="align-center"><?php echo $total_lainnya; ?></td>
                    <td class="align-center"><?php echo $total_void; ?></td> 
                    <td class="align-center"><?php echo ($total_gaji + $total_non_gaji + $total_lainnya + $total_void); ?></td> 

                    <td class="align-center"><?php echo $this->pieReturSP2D->get_retur_sudah_proses(); ?></td> 
                    <td class="align-center"><?php echo $this->pieReturSP2D->get_retur_belum_proses(); ?></td>

                    <td class="align-center"><?php echo $total_lhp_completed; ?></td>
                    <td class="align-center"><?php echo $total_lhp_validated; ?></td>
                    <td class="align-center"><?php echo $total_lhp_etc; ?></td>
                    <td class="align-center"><?php echo $total_lhp_error; ?></td>
                    <td class="align-center"><?php echo ($total_lhp_completed + $total_lhp_validated + $total_lhp_etc + $total_lhp_error); ?></td>
                </tr>
            </tfoot>

        <?php } ?>
            
        </tbody>
    </table>
</div>

<?php } ?>

<?php if (isset($this->lineHistSP2D)) { ?>

<div style="padding: 0px 10px;">
    <div class="container-fluid">

        <div class="row top-padded">
            <div class="col-md-6">
                <h4>Riwayat Penerbitan SP2D</h4>
            </div>

            <div class="col-md-6 align-right top-padded-little">
                <div class="sub" style="float: right; margin-left: 10px; padding-left: 5px; border-left: 8px solid #409ACA">Gaji</div>
                <div class="sub" style="float: right; margin-left: 10px; padding-left: 5px; border-left: 8px solid #8E5696">Non Gaji</div>
                <div class="sub" style="float: right; margin-left: 10px; padding-left: 5px; border-left: 8px solid #F6CE40">Lainnya</div>
                <div class="sub" style="float: right; margin-left: 10px; padding-left: 5px; border-left: 8px solid #E35C5C">Void</div>
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
    
    //Render Charts
    $(document).ready(function() {
        $(".pie-canvas").each(function() {
            $(this).css("height", $(this).parent().children(".pie-legend").height());
        });
        setTimeout(function() {
            
            var pieJenisSP2DCanvas = document.getElementById("pieJenisSP2D").getContext("2d");
            var pieJenisSP2D = new Chart(pieJenisSP2DCanvas).Doughnut(pieJenisSP2DData);

            var pieNominalSP2DCanvas = document.getElementById("pieNominalSP2D").getContext("2d");
            var pieNominalSP2D = new Chart(pieNominalSP2DCanvas).Doughnut(pieNominalSP2DData);

            var pieReturSP2DCanvas = document.getElementById("pieReturSP2D").getContext("2d");
            var pieReturSP2D = new Chart(pieReturSP2DCanvas).Doughnut(pieReturSP2DData);

            var pieStatusLHPCanvas = document.getElementById("pieStatusLHP").getContext("2d");
            var pieStatusLHP = new Chart(pieStatusLHPCanvas).Doughnut(pieStatusLHPData);
            
            <?php if (isset($this->lineHistSP2D)) { ?>
            
                var lineHistSP2DCanvas = document.getElementById("lineHistSP2D").getContext("2d");
                var lineHistSP2D = new Chart(lineHistSP2DCanvas).Bar(lineHistSP2DData); 
            
            <?php } ?>
            
        }, 1000);
    });

</script>