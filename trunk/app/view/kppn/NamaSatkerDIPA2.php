<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataDIPA/nmsatker1 -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Sisa Pagu Belanja Realisasi dan Pencadangan</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
 <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  

if (Session::get('role') == ADMIN  || Session::get('role') == DJA) {
//-----------------------------
if( isset($this->d_nama_kppn) || isset($this->d_kd_satker) || isset($this->d_nm_satker)){
	if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
          }
	} else {
		$kdkppn = 'null';
	}
	if (isset($this->d_kd_satker)) {
		$kdsatker = $this->d_kd_satker;
	} else {
		$kdsatker = 'null';
	}
	
	if (isset($this->d_nm_satker)) {
		$nmsatker = $this->d_nm_satker;
	} else {
		$nmsatker = 'null';
	}
	
	?>
    <a href="<?php echo URL; ?>PDF/nmsatker1_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
    <?php
	}
//------------------------------
}
if (Session::get('role') == KANWIL) {
//-----------------------------
if( isset($this->d_nama_kppn) || isset($this->d_kd_satker) || isset($this->d_nm_satker)){
	if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
          }
	} else {
		$kdkppn = 'null';
	}
	if (isset($this->d_kd_satker)) {
		$kdsatker = $this->d_kd_satker;
	} else {
		$kdsatker = 'null';
	}
	
	if (isset($this->d_nm_satker)) {
		$nmsatker = $this->d_nm_satker;
	} else {
		$nmsatker = 'null';
	}
	
	?>
    <a href="<?php echo URL; ?>PDF/nmsatker1_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>    <?php
	}
//------------------------------
}
if (Session::get('role') == KPPN) {
//-----------------------------
	if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
          }
	} else {
		$kdkppn = Session::get('id_user');
	}
	if (isset($this->d_kd_satker)) {
		$kdsatker = $this->d_kd_satker;
	} else {
		$kdsatker = 'null';
	}
	
	if (isset($this->d_nm_satker)) {
		$nmsatker = $this->d_nm_satker;
	} else {
		$nmsatker = 'null';
	}
	
	?>
    <a href="<?php echo URL; ?>PDF/nmsatker1_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
    <?php
	
//------------------------------
}

			//----------------------------------------------------		
			?>
		  
                <!-- PDF -->
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
            
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
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
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php

                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server)<br/>" . $last_update->get_last_update() . " WIB";
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
                <th class="align-center">Kode Satker</th>
                <th>Nama Satker</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php $no = 1; ?>
            
            <?php if (isset($this->data)) { ?>
                <?php if (empty($this->data)) { ?>
            
                    <td colspan=3 class="align-center">Tidak ada data.</td>
            
                <?php } else { ?>
            
                    <?php foreach ($this->data as $value) { ?>
            
                        <tr>
                            <td class="align-center"><?php echo $no++; ?></td>
                            <td class="align-center"><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1/<?php echo $value->get_kdsatker(); ?>" ><?php echo $value->get_kdsatker(); ?></a></td>
                            <td><?php echo $value->get_nmsatker(); ?></td>
                        </tr>
                            
                    <?php } ?>
                            
                <?php } ?>
                            
            <?php } else { ?>
                            
                <td colspan=3 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>
            
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
            
            <form id="filter-form" method="POST" action="nmsatker1" enctype="multipart/form-data">

                <div class="modal-body">

                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">Kode KPPN: </label>
                    
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            
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
                    
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)) { echo $this->kdsatker; } ?>">
                    
                    <br/>
                    
                    <label class="isian">Nama Satker: </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker" value="<?php if (isset($this->nmsatker)) { echo $this->nmsatker; } ?>">

                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . '_' . $kode_kppn . '_' . date('d-m-y') . '_'; ?>">  

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary fullwidth" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Blok Skrip -->
<script type="text/javascript">

    //Skrip validasi
    
</script>