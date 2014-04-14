<div id="top">KPPN xxx

<div id="table-content">
        <table class="table-bordered zebra">
            <thead>
                <tr>
                    <th>Tanggal</th>
					<th>Satker</th>
                    <th>ADK</th>
                    <th>Jumlah PDF</th>
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
                    echo "<td style=\'text-align: center\'>".$val->get_kd_jml_pdf()."</td>";
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
					echo "<td><a href=../adk/".$val->get_kd_file_name(). "><i class=\"icon-download\"></i></a></td>";
                    echo "</tr>";
					}
				?>
            </tbody>
        </table>
		</div>