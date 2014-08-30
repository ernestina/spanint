<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataDIPA/nmsatker1 -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Data Pagu Minus <em>(Fund Fail)</em></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php if (isset($this->d_nama_kppn) || isset($this->satker_code)) {
                    if (isset($this->d_nama_kppn)) {
                        $kdkppn = $this->d_nama_kppn;
                    } else {
                        $kdkppn = Session::get('id_user');
                    }
                    if (isset($this->satker_code)) {
                        $kdsatker = $this->satker_code;
                    } else {
                        $kdsatker = 'null';
                    }
                ?>
                
                <a href="<?php echo URL; ?>PDF/Fund_fail_PDF/<?php echo $kdsatker . "/" . $kdkppn; ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-print"></span> PDF</a>

                <?php } ?>
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php if (Session::get('role') != SATKER) { ?>
                    <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <?php } ?>
                
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-sm-12">
                <?php

                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                } else {
                    echo Session::get('user');
                }

                ?>
            </div>
            
            <div class="col-md-6 col-sm-12 align-right">
                <?php

                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server) : " . $last_update->get_last_update() . " WIB";
                    }
                }

                ?>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">

        <thead>
            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">Tanggal Error</th>
                <th class="align-center">Satker</th>
                <th class="align-center">Kode KPPN</th>
                <th class="align-center">Akun</th>
                <th class="align-center">Program</th>
                <th class="align-center">Output</th>
                <th class="align-center">Dana</th>
                <th>Description</th>
                <th class="align-right">Blokir/Kontrak</th>
                <th class="align-right">Realisasi</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php $no = 1; ?>
            
            <?php if (isset($this->data)) { ?>
            
                <?php if (empty($this->data)) { ?>
            
                    <td colspan=11 align="center">Tidak ada data.</td>
            
                <?php } else { ?>
            
                    <?php foreach ($this->data as $value) { ?>
            
                        <tr>
                            <td class="align-center"><?php echo $no++; ?></td>
                            <td class="align-center"><?php echo $value->get_error_date(); ?></td>
                            <td class="align-center"><?php echo $value->get_satker_code(); ?></td>
                            <td class="align-center"><?php echo $value->get_kppn_code(); ?></td>
                            <td class="align-center"><?php echo $value->get_account_code(); ?></td>
                            <td class="align-center"><?php echo $value->get_program_code(); ?></td>
                            <td class="align-center"><?php echo $value->get_output_code(); ?></td>
                            <td class="align-center"><?php echo $value->get_dana_code(); ?></td>

                            <?php $description = $value->get_description(); ?>
                            <?php if (substr($description,0,4) == 'Fund') { ?>

                                <td><a href="<?php echo URL; ?>dataDIPA/Detail_Fund_Fail_KD/1/<?php echo $value->get_satker_code(); ?>/<?php echo $value->get_output_code(); ?>/<?php echo $value->get_account_code(); ?>"><?php echo $value->get_description(); ?></td>

                            <?php } else { ?>

                                <td><a href="<?php echo URL; ?>dataDIPA/Detail_Fund_Fail_KD/2/<?php echo $value->get_satker_code(); ?>/<?php echo $value->get_output_code(); ?>/<?php echo $value->get_account_code(); ?>"><?php echo $value->get_description(); ?></td>

                            <?php } ?>

                            <td class="align-right"><?php echo number_format($value->get_blokir_kontrak()); ?></td>
                            <td class="align-right"><?php echo number_format($value->get_blokir_realisasi()); ?></td>
                        </tr>
                                
                    <?php } ?>
                                
                <?php } ?>
                                
            <?php } else { ?>
                                
                <td colspan=11 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>
            
            <?php } ?>
            
        </tbody>
    </table>
</div>

<!-- Blok Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">Kode KPPN: </label>
                    
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            
                            <option value='' selected>SEMUA KPPN</option>
                            
                            <?php foreach ($this->kppn_list as $value1) { ?>
                            
                                <?php if ($kode_kppn == $value1->get_kd_d_kppn()) { ?>
                            
                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>" selected><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>
                            
                                <?php } else { ?>
                            
                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>"><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>
                            
                                <?php } ?>
                            
                            <?php } ?>
                            
                        </select>
                    
                        <br/>
                    
                    <?php } ?>
                    
                    <div id="wakun" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Satker : </label>
                    <input class="form-control" type="text" name="kd_satker" id="kd_satker">

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary fullwidth" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript" charset="utf-8">
    
    //Skrip validasi

</script>