<div id="top">
	<div id="header">
        <h2>GANTI USER SPAN (belum jadi) <?php //echo Session::get('user'); ?></h2>
    </div>

<a href="#xModal" class="modal">FORM ISIAN</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FORM PENGGANTIAN USER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="#" enctype="multipart/form-data">
		<div class='error' id='wall'></div>
		
		<div id="wnosurat" class="error"></div>
		<label class="isian">No. Surat: </label>
		<input type="text" name="no_surat" id="no_surat" value="<?php if (isset($this->no_surat)){echo $this->no_surat;}?>">
		
		<div id="wtglsurat" class="error"></div>
		<label class="isian">Tanggal Surat: </label>
		<input type="text" class="tanggal" name="tgl_surat" id="tgl_surat" value="<?php if (isset($this->tgl_surat)){echo $this->tgl_surat;}?>">
		
		
		<div id="wsetuju" class="error"></div>
		<label class="isian">Sts Persetujuan: </label>
		<select type="text" name="status_persetujuan" id="status_persetujuan">
			<option value=''>- pilih -</option>
			<option value='SETUJU' <?php if ($this->status_persetujuan == SETUJU){echo "selected";}?>>SETUJU</option>
			<option value='TIDAKSETUJU' <?php if ($this->status_persetujuan == TIDAKSETUJU){echo "selected";}?>>TIDAK SETUJU</option>
		</select>
		
		<div id="walasan" class="error"></div>
		<label class="isian">Alasan: </label>
		<textarea class="mini" name="alasan" id="alasan" value="<?php if (isset($this->alasan)){echo $this->alasan;}?>"></textarea>
		
		<div id="wtgl" class="error"></div>
		<label class="isian">Tgl Penggantian: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="tgl_mulai" value="<?php if (isset($this->tgl_mulai)){echo $this->tgl_mulai;}?>"> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->tgl_akhir;}?>"></li>
		</ul>

		<br>(pegawai yang berhalangan)
		<div id="wnama" class="error"></div>
		<label class="isian">Nama: </label>
		<input type="text" name="nama_user1" id="nama_user1" value="<?php if (isset($this->nama_user1)){echo $this->nama_user1;}?>">
		
		<div id="wnip" class="error"></div>
		<label class="isian">NIP: </label>
		<input type="text" name="nip_user1" id="nip_user1" value="<?php if (isset($this->nip_user1)){echo $this->nip_user1;}?>">
		
		<div id="wemail" class="error"></div>
		<label class="isian">Email: </label>
		<input type="text" name="email_user1" id="email_user1" value="<?php if (isset($this->email_user1)){echo $this->email_user1;}?>">
		
		<div id="wposisi" class="error"></div>
		<label class="isian">Posisi: </label>
		<select type="text" name="posisi_user1" id="posisi_user1">
			<option value=''>- pilih -</option>
			<option value='KAKANTOR' <?php if ($this->posisi_user1 == KAKANTOR){echo "selected";}?>>Kepala Kantor</option>
			<option value='KASIPD' <?php if ($this->posisi_user1 == KASIPD){echo "selected";}?>>Kasi Pencairan Dana</option>
			<option value='KASIBGP' <?php if ($this->posisi_user1 == KASIBGP){echo "selected";}?>>Kasi Bank Giro Pos</option>
			<option value='KASIVERA' <?php if ($this->posisi_user1 == KASIVERA){echo "selected";}?>>Kasi Verifikasi Akuntansi</option>
			<option value='FOPD' <?php if ($this->posisi_user1 == FOPD){echo "selected";}?>>FO Pencairan Dana</option>
			<option value='MOPD' <?php if ($this->posisi_user1 == MOPD){echo "selected";}?>>MO Pencairan Dana</option>
			<option value='STAFFPD' <?php if ($this->posisi_user1 == STAFFPD){echo "selected";}?>>Staff Pencairan Dana</option>
		</select>
		
		<br>(digantikan oleh)
		
		<div id="wnama2" class="error"></div>
		<label class="isian">Nama: </label>
		<input type="text" name="nama_user2" id="nama_user2" value="<?php if (isset($this->nama_user2)){echo $this->nama_user2;}?>">
		
		<div id="wnip2" class="error"></div>
		<label class="isian">NIP: </label>
		<input type="text" name="nip_user1" id="nip_user1" value="<?php if (isset($this->nip_user2)){echo $this->nip_user2;}?>">
		
		
		<div id="wemail2" class="error"></div>
		<label class="isian">Email: </label>
		<input type="text" name="email_user2" id="email_user2" value="<?php if (isset($this->email_user2)){echo $this->email_user2;}?>">
		
		<div id="wposisi2" class="error"></div>
		<label class="isian">Posisi: </label>
		<select type="text" name="posisi_user2" id="posisi_user2">
			<option value=''>- pilih -</option>
			<option value='KAKANTOR' <?php if ($this->posisi_user1 == KAKANTOR){echo "selected";}?>>Kepala Kantor</option>
			<option value='KASIPD' <?php if ($this->posisi_user1 == KASIPD){echo "selected";}?>>Kasi Pencairan Dana</option>
			<option value='KASIBGP' <?php if ($this->posisi_user1 == KASIBGP){echo "selected";}?>>Kasi Bank Giro Pos</option>
			<option value='KASIVERA' <?php if ($this->posisi_user1 == KASIVERA){echo "selected";}?>>Kasi Verifikasi Akuntansi</option>
			<option value='FOPD' <?php if ($this->posisi_user1 == FOPD){echo "selected";}?>>FO Pencairan Dana</option>
			<option value='MOPD' <?php if ($this->posisi_user1 == MOPD){echo "selected";}?>>MO Pencairan Dana</option>
			<option value='STAFFPD' <?php if ($this->posisi_user1 == STAFFPD){echo "selected";}?>>Staff Pencairan Dana</option>
		</select>
		
		<br>(dilaporkan oleh)
		
		<div id="wnama3" class="error"></div>
		<label class="isian">Nama: </label>
		<input type="text" name="nama_pelapor" id="nama_pelapor" value="<?php if (isset($this->nama_pelapor)){echo $this->nama_pelapor;}?>">
		
		<div id="wnip3" class="error"></div>
		<label class="isian">NIP: </label>
		<input type="text" name="nip_pelapor" id="nip_pelapor" value="<?php if (isset($this->nip_pelapor)){echo $this->nip_pelapor;}?>">
		
		
		<div id="wemail3" class="error"></div>
		<label class="isian">Email: </label>
		<input type="text" name="email_pelapor" id="email_pelapor" value="<?php if (isset($this->email_pelapor)){echo $this->email_pelapor;}?>">
		
		<div id="wtlp" class="error"></div>
		<label class="isian">No. Telp: </label>
		<input type="number" name="tlp_pelapor" id="tlp_pelapor" value="<?php if (isset($this->tlp_pelapor)){echo $this->tlp_pelapor;}?>">
		
		<div id="wposisi3" class="error"></div>
		<label class="isian">Posisi: </label>
		<select type="text" name="posisi_pelapor" id="posisi_pelapor">
			<option value=''>- pilih -</option>
			<option value='KAKANTOR' <?php if ($this->posisi_pelapor == KAKANTOR){echo "selected";}?>>Kepala Kantor</option>
			<option value='KASIPD' <?php if ($this->posisi_pelapor == KASIPD){echo "selected";}?>>Kasi Pencairan Dana</option>
			<option value='KASIBGP' <?php if ($this->posisi_pelapor == KASIBGP){echo "selected";}?>>Kasi Bank Giro Pos</option>
			<option value='KASIVERA' <?php if ($this->posisi_pelapor == KASIVERA){echo "selected";}?>>Kasi Verifikasi Akuntansi</option>
			<option value='FOPD' <?php if ($this->posisi_pelapor == FOPD){echo "selected";}?>>FO Pencairan Dana</option>
			<option value='MOPD' <?php if ($this->posisi_pelapor == MOPD){echo "selected";}?>>MO Pencairan Dana</option>
			<option value='STAFFPD' <?php if ($this->posisi_pelapor == STAFFPD){echo "selected";}?>>Staff Pencairan Dana</option>
		</select>
		
		<!--nama unit ini ambil dari kode kppn login-->
		<input type="hidden" name="nama_unit" id="nama_unit" value="<?php echo $nama_unit; ?>">

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="KIRIM" onClick="return cek_upload();"></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>
</div>
</div>



<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader' >
            <!--baris pertama-->
			<thead>
				<tr>
					<th rowspan='2' class='mid'>No.</th>
					<th rowspan='2' class='mid'>No. Surat</th>
					<th rowspan='2' class='mid'>Tgl Surat</th>
					<th colspan='2'>Pegawai yang berhalangan</th>
					<th colspan='2'>Pegawai yang menggantikan</th>
					<th rowspan='2' class='mid'>Tanggal mulai</th>
					<th rowspan='2' class='mid'>Tanggal selesai</th>
					<th rowspan='2' class='mid'>Persetujuan</th></th>
				</tr>
				<tr>
					<th>Nama/NIP</th>
					<th>Posisi</th>
					<th>Nama/NIP</th>
					<th>Posisi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no=1;
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td><a href='#'>" . $value->get_no_surat() . "</a></td>";
					echo "<td>" . $value->get_tgl_surat() . "</td>";
					echo "<td>" . $value->get_nama_user1() . "<br>" .$value->get_nip_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_nama_user2() . "<br>" .$value->get_nip_user2() . "</td>";
					echo "<td>" . $value->get_posisi_user2() . "</td>";
					echo "<td>" . $value->get_tgl_mulai() . "</td>";
					echo "<td>" . $value->get_tgl_akhir() . "</td>";
					echo "<td>
						<ul class='inline'>
							<li><button class='sukses'>SETUJU</button></li>
							<li><button class='normal'>TIDAK SETUJU</button></li>
						</ul>
					</td>";
					
				echo "</tr>	";
			} 
			}
			}
			else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
			}
			?>
			</tbody>
        </table>
		</div>
</div>

<!--javascriptnya belooommmmm-->
<script type="text/javascript">
    $(function(){
        hideErrorId();
        hideWarning();
		$("#tgl_mulai").datepicker({
        minDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 1);
                console.log(selectedDate, date);
                $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                $("#tgl_akhir").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#tgl_akhir").datepicker({
        maxDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate) {
            $("#tgl_awal").datepicker("option", "maxDate", selectedDate);
			}
		});	
	$("#tgl_surat").datepicker({
        minDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate) {
            $("#tgl_surat").datepicker("option", "maxDate", selectedDate);
			}
		});
        
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		$('#no_surat').keyup(function(){
            if(document.getElementById('no_surat').value !=''){
                $('#wnosurat').fadeOut(200);
            }
        });
		$('#tgl_surat').keyup(function(){
            if(document.getElementById('tgl_surat').value !=''){
                $('#wtglsurat').fadeOut(200);
            }
        });
		$('#status_persetujuan').change(function(){
            if(document.getElementById('status_persetujuan').value !=''){
                $('#wsetuju').fadeOut(200);
            }
        });
		$('#alasan').keyup(function(){
            if(document.getElementById('alasan').value !=''){
                $('#walasan').fadeOut(200);
            }
        });
		$('#tgl_mulai').change(function(){
            if(document.getElementById('tgl_mulai').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#tgl_akhir').change(function(){
            if(document.getElementById('tgl_mulai').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		$('#nama_user1').keyup(function(){
            if(document.getElementById('nama_user1').value !=''){
                $('#wnama').fadeOut(200);
            }
        });
		$('#nama_user2').keyup(function(){
            if(document.getElementById('nama_user2').value !=''){
                $('#wnama2').fadeOut(200);
            }
        });
		$('#nama_pelapor').keyup(function(){
            if(document.getElementById('nama_pelapor').value !=''){
                $('#wnama3').fadeOut(200);
            }
        });
		$('#nip_user1').keyup(function(){
            if(document.getElementById('nip_user1').value !=''){
                $('#wnip').fadeOut(200);
            }
        });
		$('#nip_user2').keyup(function(){
            if(document.getElementById('nip_user2').value !=''){
                $('#wnip2').fadeOut(200);
            }
        });
		$('#nip_pelapor').keyup(function(){
            if(document.getElementById('nip_pelapor').value !=''){
                $('#wnip3').fadeOut(200);
            }
        });
		$('#email_user1').keyup(function(){
            if(document.getElementById('email_user1').value !=''){
                $('#wemail').fadeOut(200);
            }
        });
		$('#email_user2').keyup(function(){
            if(document.getElementById('email_user2').value !=''){
                $('#wemail2').fadeOut(200);
            }
        });
		$('#email_pelapor').keyup(function(){
            if(document.getElementById('email_pelapor').value !=''){
                $('#wemail3').fadeOut(200);
            }
        });
		$('#posisi_user1').change(function(){
            if(document.getElementById('posisi_user1').value !=''){
                $('#wposisi').fadeOut(200);
            }
        });
		$('#posisi_user2').change(function(){
            if(document.getElementById('posisi_user2').value !=''){
                $('#wposisi2').fadeOut(200);
            }
        });
		$('#posisi_pelapor').change(function(){
            if(document.getElementById('posisi_pelapor').value !=''){
                $('#wposisi3').fadeOut(200);
            }
        });
		$('#tlp_pelapor').keyup(function(){
            if(document.getElementById('tlp_pelapor').value !=''){
                $('#wtlp').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_nosurat = document.getElementById('no_surat').value;
		var v_tglsurat = document.getElementById('tgl_surat').value;
		var v_setuju = document.getElementById('status_persetujuan').value;
		var v_alasan = document.getElementById('alasan').value;
		var v_tglmulai = document.getElementById('tgl_mulai').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		var v_nama = document.getElementById('nama_user1').value;
		var v_nama2 = document.getElementById('nama_user2').value;
		var v_nama3 = document.getElementById('nama_pelapor').value;
		var v_nip = document.getElementById('nip_user1').value;
		var v_nip2 = document.getElementById('nip_user2').value;
		var v_nip3 = document.getElementById('nip_pelapor').value;
		var v_posisi = document.getElementById('posisi_user1').value;
		var v_posisi2 = document.getElementById('posisi_user2').value;
		var v_posisi3 = document.getElementById('posisi_pelapor').value;
		var v_email = document.getElementById('email_user1').value;
		var v_email2 = document.getElementById('email_user2').value;
		var v_email3 = document.getElementById('email_pelapor').value;
		var v_tlp = document.getElementById('tlp_pelapor').value;
		
        var jml = 0;
		if(v_nosurat=='' && v_tglsurat=='' && v_setuju==''&& v_alasan=='' && v_tglmulai=='' && v_tglakhir=='' && v_nama=='' && v_nama2=='' && v_nama3=='' && v_nip=='' && v_nip2=='' && v_nip3=='' && v_posisi=='' && v_posisi2=='' && v_posisi3=='' && v_email=='' && v_email2=='' && v_email3=='' && v_tlp==''){
            $('#wnosurat').html('Harap isi salah satu parameter');
            $('#wnosurat').fadeIn();
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