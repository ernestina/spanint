<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            <?php
			 foreach ($this->data1 as $value) {
                        $jml_invoice=$value->get_jml_invoice();
						$jml_pmrt=$value->get_jml_pmrt();
						$jml_nil_invoice=$value->get_jml_nilai_inv();
				}
			
			?>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Proses Invoice Hasil Konversi Yang Belum Diproses di SPAN</h2>
				<h4>Jumlah Invoice : <?php echo $jml_invoice ?>  || Jumlah PMRT : <?php echo $jml_pmrt ?> || Jumlah Nilai Invoice : <?php echo number_format($jml_nil_invoice) ?> </h4>
				
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <!--pdf-->
				<?php
							//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

				//-----------------------------------
				 foreach ($this->data as $value) {
                        $file_name=$value->get_file_name();
				}
				?>
				<a href="<?php echo URL; ?>PDF/errorSpm_PDF/<?php echo $file_name; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
				<?php
				//----------------------------------
				?>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <!--detail filter-->
                <?php
                    if (isset($this->d_file_name)) {
                        echo "File PMRT : ".$this->d_file_name;
                    }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server):<br/>" . $last_update->get_last_update() . " WIB";
                        }
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>


<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th>No.</th>
				<th>Satker</th>
                <th>Nomor Invoice</th>
				<th>Tanggal Invoice</th>
				<th>Tanggal Konversi</th>
                <th>Nilai Invoice</th>
                <th>Nama File</th>
                <th>Nama File ZIP</th> 
				<th>Durasi</th> 
                                
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=11 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
						echo "<td>" . $value->get_satker() . "</td>";
                        echo "<td>" . $value->get_invoice_num() .  "</td>";
						echo "<td>" . $value->get_invoice_date() .  "</td>";
						echo "<td>" . $value->get_conversion_date() . "</td>";  
                        echo "<td class='ratakanan'>" . number_format($value->get_invoice_amount()) . "</td>";                       
                        echo "<td>" . $value->get_file_name() . "</td>";
                        echo "<td>" . $value->get_file_name_zip() . "</td>";                       
                        echo "<td>" . $value->get_durasi() . " (hari) </td>";                     
                        echo "</tr>	";
                    }
                }
            } else {
                echo '<td colspan=11 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.error').fadeOut(0);
    }

    function hideWarning() {
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_invoice = document.getElementById('invoice').value;

        var jml = 0;
        if (v_invoice == '') {
            $('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>