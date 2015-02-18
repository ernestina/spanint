<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar File XML SP2D</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
              
			</div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">			  
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : dropingDetail.php  

				if($this->d_bank){
					$kdbank=$this->d_bank;
				}
				if (isset($this->d_tanggal)) {
					$kdtanggal=$this->d_tanggal;
				}
				?>	
			 <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/detailSPAN_PDF/<?php echo $kdbank . "/" . $kdtanggal; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/detailSPAN_PDF/<?php echo $kdbank . "/" . $kdtanggal; ?>/XLS">EXCEL</a></li>
                          </ul>
            </div>
			   <?php
			//----------------------------------------------------			
			?>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php if (isset($this->d_bank)) {
					if($this->d_bank=="MDRI"){
						echo "Bank : Mandiri <br>" ;
					} elseif($this->d_bank=="SEMUA"){
						echo "SEMUA <br>" ;
					}else {
						echo "Bank : " . $this->d_bank;
                        echo "<br>";
					}
                }
                ?>
                <?php if (isset($this->d_tanggal)) {
                        echo "Tanggal : ".$this->d_tanggal;
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
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

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
			<thead>
                <tr>
					<th class='mid'>No.</th>
					<th >Bank</th>
					<th >Nama File FTP</th>
					<th >Jumlah SP2D</th>
					<th >Jumlah Transaksi</th>
					<th >Jumlah Uang</th>
                </tr>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			if (isset($this->data)){
				if (empty($this->data)){
					echo '<td colspan=12 align="center">Tidak ada data.</td>';
				} else {
					$total = 0;
					foreach ($this->data as $value){ 
						echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_creation_date() . "</td>";
							echo "<td>" . $value->get_payment_currency_code() . "</td>";
							echo "<td align = 'right'>" . number_format($value->get_bank_trxn_number()) . "</td>";
							echo "<td align = 'right'>" . number_format($value->get_payment_amount()) . "</td>";
							echo "<td align = 'right'>" . number_format($value->get_attribute4()) . "</td>";
						echo "</tr>	";
                        $total_sp2d +=$value->get_bank_trxn_number();
                        $total_trx +=$value->get_payment_amount();
                        $total_nilai +=$value->get_attribute4();
					}
				} 
			} else {
				echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
			}
			?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><b>TOTAL</b></td>
                <td align = 'right'><b><?php echo number_format($total_sp2d) ?></b>    </td>
                <td align = 'right'><b><?php echo number_format($total_trx) ?></b>    </td>
                <td align = 'right'><b><?php echo number_format($total_nilai) ?></b>    </td>
            </tr>
        </tfoot>
    </table>
</div>