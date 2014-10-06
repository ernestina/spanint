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
    
    <?php if (Session::get('role')==SATKER) { ?>
    
    var pieStatusDIPAData = [

        {
            "value" : <?php echo $this->pieStatusDIPA->get_dipa_terpakai(); ?>,
            "color" : "#409ACA"
        },
        {
            "value" : <?php echo $this->pieStatusDIPA->get_dipa_sisa(); ?>,
            "color" : "#8E5696"
        }

    ]
    
    <?php } else { ?>
    
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
    
    <?php } ?>
    
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
            
            <div class="col-lg-10 col-md-6 col-sm-12"><h2>Dashboard</h2></div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 align-right top-padded">
                
                <?php if ($this->mode == 'Mingguan') { ?>
                    <?php if (Session::get('role') == SATKER) { ?>
                        <a href="<?php echo URL; ?>home/dashboard/triwulanan/<?php if (isset($this->kodeunit)) { echo $this->kodeunit; } ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> 90 Hari</a>
                    <?php } else { ?>
                        <a href="<?php echo URL; ?>home/dashboard/harian/<?php if (isset($this->kodeunit)) { echo $this->kodeunit; } ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> Hari Ini</a>
                    <?php } >
                <?php } else { ?>
                    <a href="<?php echo URL; ?>home/dashboard/mingguan/<?php if (isset($this->kodeunit)) { echo $this->kodeunit; } ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> 7 Hari</a>
                <?php } ?>
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 align-right top-padded">
                
                <?php if ($this->mode == 'Bulanan') { ?>
                    <?php if (Session::get('role') == SATKER) { ?>
                        <a href="<?php echo URL; ?>home/dashboard/triwulanan/<?php if (isset($this->kodeunit)) { echo $this->kodeunit; } ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> 90 Hari</a>
                    <?php } else { ?>
                        <a href="<?php echo URL; ?>home/dashboard/harian/<?php if (isset($this->kodeunit)) { echo $this->kodeunit; } ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> Hari Ini</a>
                    <?php } >
                <?php } else { ?>
                    <a href="<?php echo URL; ?>home/dashboard/bulanan/<?php if (isset($this->kodeunit)) { echo $this->kodeunit; } ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-calendar"></span> 30 Hari</a>
                <?php } ?>
                
            </div>
        </div>
        <div class="row top-padded-little">
            
            <div class="col-md-6 col-sm-12">
                <?php

                if ($this->mode == 'Mingguan') {
                    echo "7 HARI TERAKHIR";
                } else if ($this->mode == 'Bulanan') {
                    echo "30 HARI TERAKHIR";
                } else if ($this->mode == 'Triwulanan') {
                    echo "90 HARI TERAKHIR";
                } else {
                    echo "HARI INI";
                }

                ?>
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
                            <h4>DIPA</h4>
                            <div style="width: 100%; float: left; border-left: 4px solid #409ACA">
                                <p><?php echo (number_format(round($this->pieStatusDIPA->get_dipa_terpakai() / 1000000000, 2), 2)." M"); ?></p>
                                <p class="sub">Terpakai</p>
                            </div>
                            <div style="width: 100%; float: left; border-left: 4px solid #8E5696">
                                <p><?php echo (number_format(round($this->pieStatusDIPA->get_dipa_sisa() / 1000000000, 2), 2)." M"); ?></p>
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

        <div class="row"><div class="col-md-12 top-padded table-container" style="border: 1px solid #e5e5e5">

            <table class="dashtable">

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

                            <?php if ($overtotal > 0 || $value->nama_unit[0] != 'K') { ?>

                                <tr>
                                    <td><a href="<?php echo URL; ?>home/dashboard/harian/<?php echo $value->nama_unit; ?>"><?php echo $value->nama_lengkap_unit; ?></a></td>

                                    <td class="align-center"><?php echo $value->data_pos_spm; $total_pos_spm += $value->data_pos_spm; ?></td> 

                                    <td class="align-center"><?php echo number_format($total_row_gaji); ?></td> 
                                    <td class="align-center"><?php echo number_format($total_row_non_gaji); ?></td> 
                                    <td class="align-center"><?php echo number_format($total_row_lainnya); ?></td>
                                    <td class="align-center"><?php echo number_format($total_row_void); ?></td> 
                                    <td class="align-center"><?php echo number_format(($total_row_gaji + $total_row_non_gaji + $total_row_lainnya + $total_row_void)); ?></td> 

                                    <td class="align-center"><?php echo number_format($value->data_retur->get_retur_sudah_proses()); ?></td> 
                                    <td class="align-center"><?php echo number_format($value->data_retur->get_retur_belum_proses()); ?></td>

                                    <td class="align-center"><?php echo number_format($total_row_lhp_completed); ?></td>
                                    <td class="align-center"><?php echo number_format($total_row_lhp_validated); ?></td>
                                    <td class="align-center"><?php echo number_format($total_row_lhp_etc); ?></td>
                                    <td class="align-center"><?php echo number_format($total_row_lhp_error); ?></td>
                                    <td class="align-center"><?php echo number_format(($total_row_lhp_completed + $total_row_lhp_validated + $total_row_lhp_etc + $total_row_lhp_error)); ?></td>
                                </tr>

                            <?php } ?>

                    <?php } ?>

                    <tfoot>
                        <tr>
                            <td>Total</td>

                            <td class="align-center"><?php echo number_format($total_pos_spm); ?></td> 

                            <td class="align-center"><?php echo number_format($total_gaji); ?></td> 
                            <td class="align-center"><?php echo number_format($total_non_gaji); ?></td> 
                            <td class="align-center"><?php echo number_format($total_lainnya); ?></td>
                            <td class="align-center"><?php echo number_format($total_void); ?></td> 
                            <td class="align-center"><?php echo number_format(($total_gaji + $total_non_gaji + $total_lainnya + $total_void)); ?></td> 

                            <td class="align-center"><?php echo number_format($this->pieReturSP2D->get_retur_sudah_proses()); ?></td> 
                            <td class="align-center"><?php echo number_format($this->pieReturSP2D->get_retur_belum_proses()); ?></td>

                            <td class="align-center"><?php echo number_format($total_lhp_completed); ?></td>
                            <td class="align-center"><?php echo number_format($total_lhp_validated); ?></td>
                            <td class="align-center"><?php echo number_format($total_lhp_etc); ?></td>
                            <td class="align-center"><?php echo number_format($total_lhp_error); ?></td>
                            <td class="align-center"><?php echo number_format(($total_lhp_completed + $total_lhp_validated + $total_lhp_etc + $total_lhp_error)); ?></td>
                        </tr>
                    </tfoot>

                <?php } ?>

                </tbody>
            </table>
        </div></div>
    </div>
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

<?php if (isset($this->SP2DFinished)) { ?>

<div style="padding: 0px 10px;">
    <div class="container-fluid">

        <div class="row">
            
            <div class="col-lg-6 col-md-12 top-padded table-container" style="border: 1px solid #e5e5e5">
                
                <table class="dashtable">
                    
                    <thead>
                        <tr>
                            <th colspan=4>SPM dalam Proses (<?php echo (count($this->SPMOngoing)); ?>)</th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>No. SPM</th>
                            <th>User</th>
                            <th>Waktu Mulai</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        <?php if (empty($this->SPMOngoing)) { ?>

                            <tr><td colspan=14 class="align-center">Tidak ada data.</td></tr>

                        <?php } else { ?>
                        
                            <?php $no = 1; ?>

                            <?php foreach ($this->SPMOngoing as $value) { ?>
                        
                                <tr>
                                    
                                    <td class="align-center"><?php echo $no++; ?></td>                        
                                    <td class="align-center"><?php echo $value->get_invoice_num(); ?></td>
                                    <td class="align-center"><?php echo $value->get_to_user(); ?> - <?php echo $value->get_fu_description(); ?></td>
                                    <td class="align-center"><?php echo $value->get_begin_date(); ?> <?php echo $value->get_time_begin_date(); ?></td>
                        
                                </tr>
                        
                            <?php } ?>
                        
                        <?php } ?>
                        
                    </tbody>
                
                </table>
            
            </div>
            
            <?php if ($this->kodeunit == '140' || Session::get('role')==SATKER) { ?>
            
                <div class="col-lg-6 col-md-12 top-padded table-container" style="border: 1px solid #e5e5e5">
                
                    <table class="dashtable">

                        <thead>
                            <tr>
                                <th colspan=5>SP2D Hari Ini (<?php echo (count($this->SP2DFinished)); ?>)</th>
                            </tr>
                            <tr>
                                <th>No.</th>
                                <th>No. SP2D</th>
                                <th>Jenis SP2D</th>
                                <th class="align-right">Nominal</th>
                                <th class="align-right">Nominal (Rupiah)</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($this->SP2DFinished)) { ?>

                                <tr><td colspan=14 class="align-center">Tidak ada data.</td></tr>

                            <?php } else { ?>

                                <?php $disp_minus_warning = false; ?>

                                <?php $no = 1; ?>

                                <?php $total_nominal_sp2d = 0; ?>

                                <?php foreach ($this->SP2DFinished as $value) { ?>

                                    <tr>

                                        <td class="align-center"><?php echo $no++; ?></td>                        
                                        <td class="align-center"><?php echo $value->get_check_number(); ?></td>
                                        <td class="align-center"><?php echo $value->get_jenis_sp2d(); ?></td>
                                        <td class="align-right"><?php echo number_format($value->get_gross_nominal_sp2d()).' '.$value->get_currency_sp2d(); ?></td>
                                        <td class="align-right">
                                            <?php if ($value->get_currency_sp2d() == 'IDR' || ($value->get_rate_sp2d() != 0 && $value->get_rate_sp2d() != null)) { echo number_format($value->get_nominal_sp2d()); } else { echo '-'; } ?>
                                        </td>

                                        <?php 
                                            if ($value->get_nominal_sp2d() >= 0) {                  
                                                if ($value->get_currency_sp2d() == 'IDR' || ($value->get_rate_sp2d() != 0 && $value->get_rate_sp2d() != null)) {
                                                    $total_nominal_sp2d += $value->get_nominal_sp2d(); 
                                                }
                                            } else {
                                                $disp_minus_warning = true;
                                            }
                                        ?>

                                    </tr>

                                <?php } ?>

                            <?php } ?>

                        </tbody>

                        <?php if (!empty($this->SP2DFinished)) { ?>

                        <tfoot>

                                <tr>

                                    <td colspan=4 class="align-center">Jumlah <?php if ($disp_minus_warning == true) { echo '(Tidak termasuk SP2D Pengesahan)'; } ?></td>
                                    <td class="align-right"><?php echo number_format($total_nominal_sp2d); ?></td>

                                </tr>

                        </tfoot>

                        <?php } ?>

                    </table>

                </div>

            <?php } else { ?>
            
                <div class="col-lg-6 col-md-12 top-padded table-container" style="border: 1px solid #e5e5e5">

                    <table class="dashtable">

                        <thead>
                            <tr>
                                <th colspan=4>SP2D Hari Ini (<?php echo (count($this->SP2DFinished)); ?>)</th>
                            </tr>
                            <tr>
                                <th>No.</th>
                                <th>No. SP2D</th>
                                <th>Jenis SP2D</th>
                                <th class="align-right">Nominal</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($this->SP2DFinished)) { ?>

                                <tr><td colspan=14 class="align-center">Tidak ada data.</td></tr>

                            <?php } else { ?>

                                <?php $disp_currency_warning = false; ?>

                                <?php $disp_minus_warning = false; ?>

                                <?php $no = 1; ?>

                                <?php $total_nominal_sp2d = 0; ?>

                                <?php foreach ($this->SP2DFinished as $value) { ?>

                                    <tr>

                                        <td class="align-center"><?php echo $no++; ?></td>                        
                                        <td class="align-center"><?php echo $value->get_check_number(); ?></td>
                                        <td class="align-center"><?php echo $value->get_jenis_sp2d(); ?></td>
                                        <td class="align-right"><?php echo number_format($value->get_nominal_sp2d()); ?> <?php if ($value->get_currency_sp2d() != 'IDR' && ($value->get_rate_sp2d() == 0 || $value->get_rate_sp2d() == null)) { echo $value->get_currency_sp2d().'*'; $disp_currency_warning = true; } ?></td>

                                        <?php 
                                            if ($value->get_nominal_sp2d() >= 0) {                  
                                                if ($value->get_currency_sp2d() == 'IDR' || ($value->get_rate_sp2d() != 0 && $value->get_rate_sp2d() != null)) {
                                                    $total_nominal_sp2d += $value->get_nominal_sp2d(); 
                                                }
                                            } else {
                                                $disp_minus_warning = true;
                                            }
                                        ?>

                                    </tr>

                                <?php } ?>

                            <?php } ?>

                        </tbody>

                        <?php if (!empty($this->SP2DFinished)) { ?>

                        <tfoot>

                                <tr>

                                    <td colspan=3 class="align-center">Jumlah <?php if ($disp_currency_warning == true) { echo '(SP2D dengan tanda bintang belum memiliki informasi nilai tukar, sehingga tidak disertakan dalam perhitungan)'; } ?> <?php if ($disp_minus_warning == true) { echo '(Tidak termasuk SP2D Pengesahan)'; } ?></td>                        
                                    <td class="align-right"><?php echo number_format($total_nominal_sp2d); ?></td>

                                </tr>

                        </tfoot>

                        <?php } ?>

                    </table>

                </div>

            <?php } ?>
            
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
        window.setTimeout(function() {
            
            var pieJenisSP2DCanvas = document.getElementById("pieJenisSP2D").getContext("2d");
            var pieJenisSP2D = new Chart(pieJenisSP2DCanvas).Doughnut(pieJenisSP2DData);

            var pieNominalSP2DCanvas = document.getElementById("pieNominalSP2D").getContext("2d");
            var pieNominalSP2D = new Chart(pieNominalSP2DCanvas).Doughnut(pieNominalSP2DData);

            var pieJumlahReturSP2DCanvas = document.getElementById("pieJumlahReturSP2D").getContext("2d");
            var pieJumlahReturSP2D = new Chart(pieJumlahReturSP2DCanvas).Doughnut(pieJumlahReturSP2DData);
            
            <?php if (Session::get('role')==SATKER) { ?>
            
            var pieStatusDIPACanvas = document.getElementById("pieStatusDIPA").getContext("2d");
            var pieStatusDIPA = new Chart(pieStatusDIPACanvas).Doughnut(pieStatusDIPAData);
            
            <?php } else { ?>

            var pieStatusLHPCanvas = document.getElementById("pieStatusLHP").getContext("2d");
            var pieStatusLHP = new Chart(pieStatusLHPCanvas).Doughnut(pieStatusLHPData);
            
            <?php } ?>
            
            <?php if (isset($this->lineHistSP2D)) { ?>
            
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