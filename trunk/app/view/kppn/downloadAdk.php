<div id="header">
<div id="barat">
<h2><?php echo Session::get('user') ?></h2></div>
<div id="timur">
<form method="POST" action="download" enctype="multipart/form-data">
	<table valign="top">
	<tr>
	<td><label>Pilih</label></td>
	<td><select name="filter" id="filter">
		<option value='0'>belum di download</option>
		<option value='1'>SUDAH di download</option>
		<option value='2'>Proses SP2D</option>
		<option value='3'>Ditolak</option>
	</select></td>
	<td><input id="submit" class="warning" type="submit" name="cari" value="OK" onClick="return cek_upload();" style="margin-top: -0.5px"></td>
	</tr>
	</table>
</form>
</div>
</div>
<div id="table-content">
        <table class="table-bordered zebra" width="96%">
            <thead>
                <tr>
                    <th>Tanggal</th>
					<th>Satker</th>
                    <th>ADK</th>
                    <!--<th>Jumlah PDF</th>-->
                    <th>Status</th>
                    <th>Aksi</th>
                    </tr>
            </thead>
            <tbody>
				<?php 
				foreach ($this->data as $val) {
				echo "<tr>";
                    echo "<td style=\'text-align: center\'>".$val->get_kd_tgl()."</td>";
                    echo "<td style=\'text-align: center\'>".$val->get_kd_satker()."</td>";
                    echo "<td style=\'text-align: center\'>".$val->get_kd_adk_name()."</td>";
                    //echo "<td style=\'text-align: center\'>".$val->get_kd_jml_pdf()."</td>";
					$status = '';
					if($val->get_kd_status()==0){
						$status = 'belum di download';
					} elseif ($val->get_kd_status()==1){
						$status = 'SUDAH di download';
					} elseif ($val->get_kd_status()==2){
						$status = 'Proses SP2D';
					} elseif ($val->get_kd_status()==3){
						$status = 'Ditolak, harap cek ulang adk';
					} else{
						$status = 'tanpa keterangan';
					}
					echo "<td style=\'text-align: center\'>".$status."</td>";
					echo "<td><a href=download_adk/".$val->get_kd_d_adk(). "/".$val->get_kd_status(). "/".$val->get_kd_file_name(). "><i class=\"icon-download-alt\"></i></a></td>";
					echo "</tr>";
					}
				?>
            </tbody>
        </table>
	</div>
</div></div>