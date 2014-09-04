<?php //echo var_dump($this->data); ?>

<!-- Header -->
<div class="main-window-segment bottom-padded">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">
                <h2 class="uppercase" style="padding-left: 20px;"><b><?php echo date('d-M-Y', time()); ?></b></h2>
            </div>

            <div class="col-md-6 align-right">
                <h2 id="current-clock" style="padding-right: 20px;"></h2>
            </div>

        </div>
        
        <div class="row">

            <div class="col-md-6">
                <span id="reload-clock"></span>
            </div>

            <div class="col-md-6 align-right">
            </div>

        </div>

    </div>
</div>

<div id="table-container" class="wrapper">
    <table class="footable">

        <tbody>

            <?php $no = 1; ?>

            <?php if (isset($this->data)) { ?>
                <?php if (empty($this->data)) { ?>

                    <td colspan=8 align="center">Tidak ada data.</td>

                <?php } else { ?>

                    <?php foreach ($this->data as $value) { ?>

                        <tr>
                            
                            <td>
                            
                                <div class="container-fluid">
                                    <div class="row bottom-padded-little" style="margin: 0px;">
                                        <div class="col-md-6">

                                            <h3 class="tight-margin"><b><?php echo substr($value->get_invoice_num(), 7, 6); ?></b></h3>
                                            <h3 class="tight-margin"><b><?php echo $value->get_invoice_num(); ?></b></h3>

                                        </div>

                                        <div class="col-md-6 align-right">

                                            <h1 class="tight-margin top-padded"><b><?php if ($value->get_status() == 'CANCELED' ) { echo 'DITOLAK'; } else if ($value->get_status() == 'CLOSED' && $value->get_check_number() != '') { echo 'SELESAI SP2D'; } else { echo 'DALAM PROSES'; } ?></b></h1>

                                        </div>
                                    </div>
                                    
                                    <?php if ($value->get_check_number() != '') { ?>
                                    
                                    <div class="row top-padded-little" style="margin: 0px;">
                                        
                                        <div class="col-md-6">
                                            <h4 class="tight-margin"><b>No. SP2D: <?php if ($value->get_check_number() == '') { echo '-'; } else { echo $value->get_check_number(); } ?></b></h4>
                                            <h4 class="tight-margin"><b>Tanggal: <?php if ($value->get_check_date() == '') { echo '-'; } else { echo $value->get_check_date(); } ?></b></h4>
                                            <h4 class="tight-margin"><b>Nominal: <?php if ($value->get_nominal_sp2d() == '') { echo '-'; } else { echo $value->get_mata_uang()." ".number_format($value->get_nominal_sp2d());} ?></b></h4>
                                        </div>
                                        <div class="col-md-6 align-right">
                                            <h4 class="tight-margin"><b><?php if ($value->get_deskripsi() == '') { echo '-'; } else { echo $value->get_deskripsi(); } ?></b></h4>
                                        </div>
                                        
                                    </div>
                                    
                                    <?php } ?>
                                    
                                </div>
                                
                            </td>
                            
                        </tr>

                    <?php } ?>
            
                <?php } ?>

            <?php } else { ?>

                <td colspan=8 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>

            <?php } ?>

        </tbody>
    </table>
</div>

<script type="text/javascript">

    tvMode = true;
    
    //Reload setiap 1 jam
    setTimeout(function() {
        location.reload();
    }, 9*60*1000);

</script>