<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Alasan Penolakan PMRT</h2>
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
                <th>Nomor, Tanggal Invoice</th>
                <th>Nilai Invoice</th>
                <!--th>Tanggal Invoice</th-->
                <th>Uraian Invoice</th>
                <th>Nama File</th>
                <th>Status Code</th>
                <th>Site Supplier<br>Supplier</th>
                <th>Nama Kolom<br>Nilai Kolom</th>
                <th>Error Message</th>
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
                        echo "<td>" . $value->get_invoice_num() . '<br>' . $value->get_invoice_date() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_invoice_amount()) . "</td>";
                        //echo "<td>" . $value->get_invoice_date() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_description() . "</td>";
                        echo "<td>" . $value->get_file_name() . "</td>";
                        echo "<td>" . $value->get_status_code() . "</td>";
                        echo "<td class='ratakiri'>Site: " . $value->get_vendor_site_code() . "<br>";
                        echo "Supplier: " . $value->get_vendor_name() . "</td>";
                        

                        echo "<td>" . $value->get_column_name() . "<br>";
                        echo $value->get_column_value() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_error_message() . "</td>";

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