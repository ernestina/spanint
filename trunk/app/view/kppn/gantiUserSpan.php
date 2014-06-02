<div id="top">
	<div id="header">
        <h2>GANTI USER SPAN (belum jadi) <?php //echo Session::get('user'); ?></h2>
    </div>

<a href="#xModal" class="modal">FORM ISIAN</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="#" enctype="multipart/form-data">
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

		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

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
		<table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Nama Unit</th>
					<th>No. Surat</th>
					<th>Tgl Surat</th>
					<th>Nama User</th>
					<th>NIP User</th>
					<th>Email User</th>
								
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
					echo "<td>" . $value->get_nama_unit() . "</td>";
					echo "<td>" . $value->get_no_surat() . "</td>";
					echo "<td>" . $value->get_tgl_surat() . "</td>";
					echo "<td>" . $value->get_nama_user1() . "</td>";
					echo "<td>" . $value->get_nip_user1() . "</td>";
					echo "<td>" . $value->get_email_user1() . "</td>";
					/*echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";*/
					
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
        
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var v_invoice = document.getElementById('invoice').value;
		
        var jml = 0;
		if(v_invoice==''){
			$('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            jml++;
        }
		if(jml>0){
            return false;
        } 
    }
</script>