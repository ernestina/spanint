<?php //echo var_dump($this->data); ?>

<!-- Header -->
<div class="main-window-segment bottom-padded">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">
                <h2 class="uppercase"><b>SP2D Hari Ini</b></h2>
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

        <thead>

            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">Jenis SP2D</th>
                <th>Nomor SP2D</th>
                <th class="align-center">Tanggal</th>
                <th class="align-right">Nominal</th>
            </tr>

        </thead>

        <tbody>

            <?php $no = 1; ?>

            <?php if (isset($this->data)) { ?>
                <?php if (empty($this->data)) { ?>

                    <td colspan=8 align="center">Tidak ada data.</td>

                <?php } else { ?>

                    <?php foreach ($this->data as $value) { ?>

                        <tr>
                            
                            <td class="align-center"><?php echo $no++; ?></td>
                            <td class="align-center"><?php echo $value->get_jenis_sp2d(); ?></td>
                            <td><?php echo $value->get_check_number(); ?></td>
                            <td class="align-center"><?php echo $value->get_tanggal_sp2d(); ?></td>
                            <td class="align-right"><?php echo number_format($value->get_nominal_sp2d()); ?></td>
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