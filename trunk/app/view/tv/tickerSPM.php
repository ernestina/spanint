<!-- Header -->
<div class="main-window-segment bottom-padded">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">
                <h2 class="uppercase"><b>SPM dalam Proses</b></h2>
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
                            <td class="align-center"><?php echo $no++; ?></td>
                            <td><?php echo $value->get_invoice_num(); ?></td>
                            <td class="align-right"><?php echo $value->get_invoice_amount(); ?></td>
                            <td><?php echo $value->get_invoice_description(); ?></td>
                            <td class="align-center"><?php echo $value->get_status(); ?></td>
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