<div id="top">
	<div id="header">
        <h2>CEK DATA SUPPLIER <br>
			
		</h2>
    </div>


<a href="#oModal" class="modal">FILTER DATA</a>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>

	<div id="top">	
		<form method="POST" action="cekSupplier" enctype="multipart/form-data">
		
		<div id='wtipesup' class='error'></div>
		<label class='isian'>Tipe Supplier: </label>
		<select type='text' name='tipesup' id='tipesup'>
			<option value='1' <?php if ($this->d_tipesup==1){echo "selected";}?>>1. Satker</option>
			<option value='2' <?php if ($this->d_tipesup==2){echo "selected";}?>>2. Penyedia BJ</option>
			<option value='3' <?php if ($this->d_tipesup==3){echo "selected";}?>>3. Pegawai</option>
			<option value='4' <?php if ($this->d_tipesup==4){echo "selected";}?>>4. BA.999</option>
			<option value='5' <?php if ($this->d_tipesup==5){echo "selected";}?>>5. Transfer Daerah</option>
			<option value='6' <?php if ($this->d_tipesup==6){echo "selected";}?>>6. PP/Banyak Penerima</option>
			<option value='7' <?php if ($this->d_tipesup==7){echo "selected";}?>>7. Lain-lain</option>
		</select>
		
		<div id="wnrs" class="error"></div>
		<label class="isian">NRS: </label>
		<input type="number" name="nrs" id="nrs" size="15" value="<?php if (isset($this->d_nrs)){echo $this->d_nrs;}?>">
		
		<div id="wnamasupplier" class="error"></div>
		<label class="isian">Nama Supplier: </label>
		<input type="text" name="namasupplier" id="namasupplier" value="<?php if (isset($this->d_namasupplier)){echo $this->d_namasupplier;}?>">
		
		<div id="wnpwpsupplier" class="error"></div>
		<label class="isian">NPWP Supplier: </label>
		<input type="text" name="npwpsupplier" id="npwpsupplier" value="<?php if (isset($this->d_npwpsupplier)){echo $this->d_npwpsupplier;}?>">
		
		<div id="wnip" class="error"></div>
		<label class="isian">NIP Penerima: </label>
		<input type="number" name="nip" id="nip" size="18" value="<?php if (isset($this->d_nip)){echo $this->d_nip;}?>">
		
		<div id="wnamapenerima" class="error"></div>
		<label class="isian">Nama Penerima: </label>
		<input type="text" name="namapenerima" id="namapenerima" value="<?php if (isset($this->d_namapenerima)){echo $this->d_namapenerima;}?>">
		
		<div id="wnorek" class="error"></div>
		<label class="isian">Nomor Rek.: </label>
		<input type="text" name="norek" id="norek" value="<?php if (isset($this->d_norek)){echo $this->d_norek;}?>">
		
		<div id="wnamarek" class="error"></div>
		<label class="isian">Nama Rek.: </label>
		<input type="text" name="namarek" id="namarek" value="<?php if (isset($this->d_namarek)){echo $this->d_namarek;}?>">
		
		<div id="wnpwppenerima" class="error"></div>
		<label class="isian">NPWP Penerima: </label>
		<input type="text" name="npwppenerima" id="npwppenerima" value="<?php if (isset($this->d_npwppenerima)){echo $this->d_npwppenerima;}?>">

		<ul class="inline" style="margin-left: 150px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
		</ul>
	</form>
</div>
</div>
</div>

<?php
// untuk menampilkan last_update
if (isset($this->last_update)){
	foreach ($this->last_update as $last_update){ 
		echo "Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB";
	}
}
?>

<div id="fitur">
		<form name='listSupplier' method='POST' action='downloadSupplier' enctype='multipart/form-data'>
		<table width="100%" class="table table-bordered zebra" id='fixheader' style="font-size: 80%">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Kode KPPN</th>
					<th>NRS / Tipe Kode Pos</th>
					<th>Nama Supplier<br>NPWP Supplier</th>
					<th>Nama Bank</th>
					<th>KD NAB - Kode Valas</th>
					<th>Nama Penerima</th>
					<th>Nama pemilik Rekening<br>Nomor Rekening</th>
					<th>SWIFT / IBAN</th>
					<th>NPWP Penerima</th>
					<th>NIP Penerima</th>
					<th>pilih <input type="checkbox" onClick="toggle(this)" /> </th>
					
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
					foreach ($this->data as $value){ 
						echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_kppn_code() . "</td>";
							echo "<td>" . $value->get_v_supplier_number()." / ". $value->get_tipe_supp() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_nama_supplier() . "<br>". $value->get_npwp_supplier() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_nm_bank() . "</td>";
							echo "<td>" . $value->get_asal_bank()." - ".$value->get_kdvalas(). "</td>";
							echo "<td class='ratakiri'>" . $value->get_nm_penerima() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_nm_pemilik_rek() . "<br>" . $value->get_norek_penerima() . "</td>";
							echo "<td>" . $value->get_kd_swift()." / ".$value->get_iban() . "</td>";
							echo "<td>" . $value->get_npwp_penerima() . "</td>";
							echo "<td>" . $value->get_nip_penerima() . "</td>";
							echo "<td><input name='checkbox[]' type='checkbox' id='checkbox' value='".$value->get_ids()."'> </td>";
						echo "</tr>	";
					}
				} 
			} else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
			}
			?>
			
			</tbody>
        </table>
            <br/>
			<input id='download_ext' type='hidden' name='download_ext' value='txt'>
		<input class='sukses' type='button' name='submit_txt' value='UNDUH .txt' onclick='downloadSupplier("txt");'>
		<input class='sukses' type='button' name='submit_xml' value='UNDUH .xml' onclick='downloadSupplier("xml");'>
		</form>
		</div>
</div>

<div id="checkFirst" class="modalDialog" >
    <div><h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">Perhatian</h2>
    <a href="#close" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
        <div id="top">
            <h3 style="text-align: center">Centang terlebih dahulu data yang akan diunduh.</h3>
        </div>
    </div>
</div>

<div id="checkMax" class="modalDialog" >
    <div><h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">Perhatian</h2>
    <a href="#close" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
        <div id="top">
            <h3 style="text-align: center">Data yang dipilih maksimal 1000 record. Silahkan mengirimkan email ke datasupplierdtp@gmail.com jika ingin mengubah lebih dari 1000 record.</h3>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
    
    function downloadSupplier(type) {
        
        $("#alert-nocheck").hide();
        $("#alert-toomanycheck").hide();
		
		if (type == "txt") {
			$("#download_ext").val("txt");
		} 
		if (type == "xml"){
			$("#download_ext").val("xml");
		}
        
        var countChecked = $("#checkbox:checked").length;
        
        if (countChecked == 0) {
            window.location = "#checkFirst";
        } else if (countChecked > 1000) {
            window.location = "#checkMax";
        } else {
            document.listSupplier.submit();
        }
        
    }
    
    $(function(){
        hideErrorId();
        hideWarning();
		
	});
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }
	
	function toggle(source) {
		checkboxes = document.getElementsByName('checkbox[]');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}

    function hideWarning(){
		
        $('#tipesup').keyup(function() {
            if (document.getElementById('tipesup').value != '') {
                $('#wtipesup').fadeOut(200);
            }
        })
		
		$('#nrs').keyup(function(){
            if(document.getElementById('nrs').value !=''){
                $('#wnrs').fadeOut(200);
            }
        });
		
		$('#namasupplier').keyup(function(){
            if(document.getElementById('namasupplier').value !=''){
                $('#wnamasupplier').fadeOut(200);
            }
        });
		
		$('#npwpsupplier').keyup(function(){
            if(document.getElementById('npwpsupplier').value !=''){
                $('#wnpwpsupplier').fadeOut(200);
            }
        });
		
		$('#nip').keyup(function(){
            if(document.getElementById('nip').value !=''){
                $('#wnip').fadeOut(200);
            }
        });
		
		$('#namapenerima').keyup(function(){
            if(document.getElementById('namapenerima').value !=''){
                $('#wnamapenerima').fadeOut(200);
            }
        });
		
		$('#norek').keyup(function(){
            if(document.getElementById('norek').value !=''){
                $('#wnorek').fadeOut(200);
            }
        });
		
		$('#namarek').keyup(function(){
            if(document.getElementById('namarek').value !=''){
                $('#wnamarek').fadeOut(200);
            }
        });
		
		$('#npwppenerima').keyup(function(){
            if(document.getElementById('npwppenerima').value !=''){
                $('#wnpwppenerima').fadeOut(200);
            }
        });

    }
	
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_tipesup = document.getElementById('tipesup').value;
		var v_nrs = document.getElementById('nrs').value;
		var v_namasupplier = document.getElementById('namasupplier').value;
		var v_npwpsupplier = document.getElementById('npwpsupplier').value;
		var v_nip = document.getElementById('nip').value;
		var v_namapenerima = document.getElementById('namapenerima').value;
		var v_norek = document.getElementById('norek').value;
		var v_namarek = document.getElementById('namarek').value;
		var v_npwppenerima = document.getElementById('npwppenerima').value;
		
        var jml = 0;
		
		if(v_tipesup =='2' && v_norek==''){
            var wnorek = 'Untuk tipe supplier 2, nomor rekening harus diisi';
            $('#wnorek').html(wnorek);
            $('#wnorek').fadeIn(200);
            jml++;
        }
		
		if(v_tipesup =='1' || v_tipesup =='3'){
            document.getElementById("namasupplier").value='<?php echo Session::get('kd_satker');?>';
        }
		
		if((v_tipesup =='4' || v_tipesup =='5' || v_tipesup =='6' || v_tipesup =='7')&& v_npwpsupplier==''){
            var wnpwpsupplier = 'Untuk tipe supplier selain 1,2 atau 3, npwp harus diisi';
            $('#wnpwpsupplier').html(wnpwpsupplier);
            $('#wnpwpsupplier').fadeIn(200);
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
	
	$(document).ready( function () {
		var oTable = $('#fixheader').dataTable( {
			"sScrollY": 400,
			"sScrollX": "100%",
			"sScrollXInner": "100%",
			"bSort": false,
			"bPaginate": false,
			"bInfo": null,
			"bFilter": false,
			"oLanguage": {
			"sEmptyTable": "Tidak ada data di dalam tabel ini."
			
			},
		} );
				
		var keys = new KeyTable( {
			"table": document.getElementById('fixheader'),
			"datatable": oTable
		} );
	} );
</script>