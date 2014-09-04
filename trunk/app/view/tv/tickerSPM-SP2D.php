<?php //echo var_dump($this->data); ?>

<!-- Header -->
<div class="main-window-segment bottom-padded">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">
                <h2 class="uppercase"><b><?php echo date('d-M-Y', time()); ?></b></h2>
            </div>

            <div class="col-md-6 align-right">
                <h2 id="current-clock"></h2>
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
                            
                                <h3 class="tight-margin"><b>Satker <?php echo substr($value->get_invoice_num(), 7, 6); ?></b></h3>
                                <h3 class="tight-margin"><b>SPM No. <?php echo $value->get_invoice_num(); ?></b></h3>
                                <h3 class="tight-margin"><b><?php if ($value->get_status() == 'OPEN' || $value->get_check_number()=='') { echo 'DALAM PROSES'; } else if ($value->get_status() == 'CLOSED') { echo 'SELESAI SP2D'; } else { echo 'DIBATALKAN'; } ?></b></h3>
                                
                            </td>
                            <td>
                                
                                <h4 class="tight-margin segmented-bottom">No. SP2D: <?php if ($value->get_check_number() == '') { echo '-'; } else { echo $value->get_check_number(); } ?></h4>
                                <p class="tight-margin">Tanggal: <?php if ($value->get_check_date() == '') { echo '-'; } else { echo $value->get_check_date(); } ?></p>
                                <p class="tight-margin">Nominal: <?php if ($value->get_nominal_sp2d() == '') { echo '-'; } else { echo $value->get_mata_uang()." ".number_format($value->get_nominal_sp2d());} ?></p>
                                
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