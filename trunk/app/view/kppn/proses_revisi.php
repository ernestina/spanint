<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataDIPA/ProsesRevisi -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Informasi Proses Revisi DIPA</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <!-- PDF -->
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
    <a href="<?php echo URL; ?>PDF/ProsesRevisi_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdrevisi; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
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
    <a href="<?php echo URL; ?>PDF/ProsesRevisi_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>    <?php
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
    <a href="<?php echo URL; ?>PDF/ProsesRevisi_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
    <?php
	
//------------------------------
}
if (Session::get('role') == SATKER) {
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
		$kdsatker = Session::get('kd_satker');
	}
	
	if (isset($this->d_nm_satker)) {
		$nmsatker = $this->d_nm_satker;
	} else {
		$nmsatker = 'null';
	}
	
	?>
    <a href="<?php echo URL; ?>PDF/ProsesRevisi_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
    <?php
	
//------------------------------
}

			//----------------------------------------------------		
			?>


                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
				
                <?php if (Session::get('role') != SATKER) { ?>
                    <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
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
                <?php

                    if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                        echo "<br/>" . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
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

<!--Tabel-->
<div id="table-container" class="wrapper">
    <table width="100%" class="footable">

        <thead>
            
            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">Kode Satker</th>
                <th>Nama Satker</th>
                <th class="align-center">KPPN</th>
                <th class="align-center">Revisi Ke</th>
                <th>Tahapan Proses</th>
                <th width="100px" class="align-center">Tanggal</th>
                <th class="align-center">Locked Akun</th>
            </tr>
            
        </thead>
        
        <tbody>
            
            <?php $no = 1; $total; ?>

            <?php if (isset($this->data)) { ?>
            
                <?php if (empty($this->data)) { ?>
            
                    <td colspan=8 class="align-center">Tidak ada data.</td>
            
                <?php } else { ?>
            
                    <?php foreach ($this->data as $value) { ?>
            
                        <tr>
                            <td class="align-center"><?php echo $no++; ?></td>
                            <td class="align-center"><?php echo $value->get_satker_code(); ?></td>
                            <td><?php echo $value->get_nmsatker(); ?></td>
                            <td class="align-center"><?php echo $value->get_kppn(); ?></td>
                            <td class="align-center"><?php echo $value->get_revision_no(); ?></td>
                            <td><?php echo $value->get_meaning(); ?></td>
                            <td class="align-center"><?php echo $value->get_last_update_date(); ?></td>
                            <td class="align-center"><a href="<?php echo URL; ?>dataDIPA/DetailRevisi/<?php echo $value->get_satker_code(); ?>">Lihat Detail</a></td>
                        </tr>

                    <?php } ?>
                            
                <?php } ?>
                            
            <?php } else { ?>
                            
                <td colspan=8 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>
            
            <?php } ?>
            
        </tbody>
        
    </table>
</div>

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
                    
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control"  type="text" name="kdkppn" id="kdkppn">
                            
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
                    
                    <div id="wsatker" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker : </label>
                    <input class="form-control"  type="text" name="satker" id="satker">
                    
                    <br/>
                    
                    <div id="wnamasatker" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Nama Satker : </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker">
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary fullwidth" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    //Skrip validasi di sini

</script>