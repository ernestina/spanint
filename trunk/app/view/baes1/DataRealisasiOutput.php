<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2><?php echo $this->judul;?></h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">

                <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  
				$kdaksi = $this->aksi1;
				
                if (isset($this->kdoutput)) {

                    $kdoutput = $this->kdoutput();
                } else {
                    $kdoutput = 'null';
                }
				if (isset($this->nmoutput)) {

                    $nmoutput = $this->nmoutput();
                } else {
                    $nmoutput = 'null';
                }
			  $kdaksi = $this->action;
				//var_dump($kdaksi);
			  $kdaksi1=$kdaksi.'_BAES1_PDF';
			  $kdaksi2=$kdaksi.'_BAES1_XLS';
				
						?>
						<div class="btn-group-sm">
							<button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
							</button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo URL; ?>PDF/<?php echo $kdaksi1;?>/<?php echo $kdoutput . "/" . $nmoutput;?>/PDF">PDF</a></li>
								<li><a href="<?php echo URL; ?>PDF/<?php echo $kdaksi2;?>/<?php echo $kdoutput . "/" . $nmoutput; ?>/XLS">EXCEL</a></li>																	
								  </ul>
							</div>						
						
					<?php
//------------------------------
                ?>
            </div>
        </div>

        <div class="row" style="padding-top: 10px">

            <div class="col-md-6 col-sm-12">
                <?php
                echo Session::get('user');
                ?>
                <br>Tanggal : s.d <?php
                echo (date('d-m-Y'));
                ?>
            </div>

            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                // untuk menampilkan last_update
                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server) :<br> " . $last_update->get_last_update() . " WIB";
                    }
                }
                ?>
            </div>

        </div>

    </div>
</div>

<!-- Tabel -->
<div id="table-container" class="wrapper" style="font-size: 85%">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='mid'>No.</th>
                <th class='align-left'><?php echo $this->judulkolom;?></th>
                <th class='mid'>Pagu </th>
                <th class='mid'>Realisasi</th>
                <th class='mid'>Persentase<br>Realisasi</th>
                <th class='mid'>Outstanding<br>Kontrak</th>
                <th class='mid'>Block/Revise<br>Amount</th>
                <th class='mid'>Total <br>Fund Available</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $tot_pot = 0;
            $tot_real = 0;
            $tot_kontrak = 0;
            $tot_block = 0;
            $tot_balance = 0;

            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo '<td ';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . $no++ . '</td>';
                        echo '<td align="left"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . $value->get_kdkegiatan() . " | " . $value->get_nmkegiatan() . "</td>";
                        echo '<td align="right"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . number_format($value->get_budget_amt()) . "</td> ";
                        echo '<td align="right"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . number_format($value->get_actual_amt()) .
                        "</td> ";
                        echo '<td align="right"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>';
                        if ($value->get_budget_amt() == 0) {
                            echo "0.00%";
                        } else {
                            echo number_format(($value->get_actual_amt() / $value->get_budget_amt()) * 100, 2) . "%";
                            "</td> ";
                        }
                        echo '<td align="right"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . number_format($value->get_obligation()) . "</td> ";
                        echo '<td align="right"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . number_format($value->get_block_amount()) . "</td> ";
                        echo '<td align="right"';
                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                            echo 'style="background:#FFC2C2"';
                        } echo '>' . number_format($value->get_balancing_amt()) . "</td> ";
                        echo "</tr>	";

                        if (substr($value->get_kdkegiatan(), 6, 1) == null) {
                        $tot_pagu+=$value->get_budget_amt();
                        $tot_real+=$value->get_actual_amt();
                        $tot_kontrak += $value->get_obligation();
                        $tot_block += $value->get_block_amount() ;
                        $tot_balance += $value->get_balancing_amt();
                        }
                    }
                    echo "<tr>";
                    echo "</tr>";
                }
            } else {

                echo '<td colspan=12 id="filter-first" align="center">Masukkan filter terlebih dahulu.</td>';
            }
            ?>
        </tbody>
        <tfoot>
           
			<tr>
                    <td colspan='2' rowspan=2 class='ratatengah'><b>GRAND TOTAL<b></td>
					<td align='right'><b> <?php echo number_format($tot_pagu) ;?> </b> </td>
					<td align='right'><b> <?php echo number_format($tot_real) ;?> </b></td>
					<td align='right'><b> <?php if($tot_pagu == 0) {echo '0.00%';} else { echo  number_format($tot_real/$tot_pagu*100,2). '%' ;}?> </b></td>
					<td align='right'><b> <?php echo number_format($tot_kontrak) ;?> </b></td>
					<td align='right'><b> <?php echo number_format($tot_block) ;?> </b></td>
					<td align='right'><b> <?php echo number_format($tot_balance) ;?> </b></td>
            </tr>

        </tfoot>
    </table>
</div>

<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action=<?php echo $this->action;?> enctype="multipart/form-data">

                <div class="modal-body">
                    
                <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                
                    <label class="isian"><?php echo $this->kodes;?> </label>
                    <input class="form-control" type="text" name="kode" id="kode" value="<?php if (isset($this->kode)) {echo $this->kode;} ?>">
                    <!--<label class="isian" >Nama : </label>-->
                    <input class="form-control" type="hidden" name="nama" id="nama" value="<?php if (isset($this->kode)) {echo $this->nama;} ?>">
                
                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>
        
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.alert-danger').fadeOut(0);
    }

    function hideWarning() {
        $('#status').change(function() {
            if (document.getElementById('status').value != '') {
                $('#wstatus').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_status = document.getElementById('kode').value;
        var v_status1 = document.getElementById('nama').value;

        var jml = 0;
        if (v_status == '' and v_status1=='') {
            $('#wstatus').html('Harap pilih');
            $('#wstatus').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>

    </div>

</div>
    <!-- Skrip -->

    <script type="text/javascript" charset="utf-8">
        $(function () {
            hideErrorId();
            hideWarning();

        });

        function hideErrorId() {
            $('.alert-danger').fadeOut(0);
        }

        function hideWarning() {
            $('#status').change(function () {
                if (document.getElementById('status').value != '') {
                    $('#wstatus').fadeOut(200);
                }
            });

        }

        function cek_upload() {
            var v_status = document.getElementById('status').value;

            var jml = 0;
            if (v_status == '') {
                $('#wstatus').html('Harap pilih');
                $('#wstatus').fadeIn();
                jml++;
            }
            if (jml > 0) {
                return false;
            }
        }
    </script>