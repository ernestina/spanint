<div id="top">
    <div id="header">
        <h2>Form Pengawasan PNBP <br/>
			Belanja PNBP
			<br/>
			
            <?php
             
		
            if (isset($this->nmsatker)) {

                foreach ($this->nmsatker as $value1) {
                    $satker = $value1->get_nmsatker();
                }
            }
            echo $satker . " ";
            
                ?>
        </h2>
    </div>



    <?php
    // untuk menampilkan last_update
    if (isset($this->last_update)) {
        foreach ($this->last_update as $last_update) {
            echo "Update Data Terakhir (Waktu Server)  "
            ?> <br/>
            <?php
            echo $last_update->get_last_update() . " WIB";
        }
    }
    ?>
    <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : detail_revisi.php  

if(isset($this->d_kdsatker)){
	$kdkppn = Session::get('id_user');
	if (isset($this->d_kdsatker)) {
		$kdsatker = $this->d_kdsatker;
	}
	?>
<a href="<?php echo URL; ?>PDF/DetailRevisi_PDF/<?php echo $kdsatker; ?>" class="modal">PDF</a>
<?php
//----------------------------------------------------		

}

?>


    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th>Kode Satker</th>
			<th>Jendok</th>
			<th>Jenis SPM</th>
			<th>Nomor Invoice</th>
			<th>Tanggal Invoice</th>
            <th>Akun</th>
			<th>Program</th>
			<th>Output</th>
			<th>Deskripsi</th>
            <th>Nomor Sp2d</th>
			<th>Tanggal Sp2d</th>
            <th>Nilai Belanja</th>
			<th>Nilai SP2D</th>
            <!--th>Usulan Revisi</th>
            <!--th>Tanggal</th-->

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                $total1 = 0;
				$total2 = 0;

                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada akun yang di lock.</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_satker_code() . "</td>";
                            echo "<td>" . $value->get_jendok() . "</td>";
                            echo "<td>" . $value->get_jenis_spm() . "</td>";
                            echo "<td>" . $value->get_invoice_num() . "</td>";
                            echo "<td>" . $value->get_tanggal() . "</td>";
							echo "<td>" . $value->get_account_code() . "</td>";
							echo "<td>" . $value->get_program_code() . "</td>";
							echo "<td>" . $value->get_output_code() . "</td>";
							echo "<td>" . $value->get_description() . "</td>";
							echo "<td>" . $value->get_check_num() . "</td>";
							echo "<td>" . $value->get_tanggal_sp2d() . "</td>";
                            echo "<td align='right'>" . number_format($value->get_line_amount()) . "</td>";
							echo "<td align='right'>" . number_format($value->get_amount()) . "</td>";
							
							$total1 = $total1 + $value->get_line_amount();
							$total2 = $total2 + $value->get_amount();
                            //echo "<td>" . $value->get_last_update_date(). "</td>";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
		<tfoot>
                    <tr>
                        <td colspan='11'></td>
                        <td class='ratatengah'><b>GRAND TOTAL</td>
                        <td align='right'><b><?php echo number_format($total1); ?>
						<td align='right'><b><?php echo number_format($total2); ?>
                        </td>

                    </tr>
                </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();

        $("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
        });

        $("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
        });
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
        $('#tgl_awal').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

        $('#tgl_akhir').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_invoice = document.getElementById('invoice').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_invoice == '' && v_tglawal == '' && v_tglakhir == '') {
            $('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            $('#wtgl').html('Harap isi tanggal');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }

    $(document).ready(function() {
        var oTable = $('#fixheader').dataTable({
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
        });

        var keys = new KeyTable({
            "table": document.getElementById('example'),
            "datatable": oTable
        });
    });
</script>