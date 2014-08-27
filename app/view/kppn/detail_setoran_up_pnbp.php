<div id="top">
    <div id="header">
        <h2>Form Pengawasan PNBP <br/>
			Setoran UP/TUP PNBP
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
			<th>NTPN</th>
            <th>Kode Satker</th>
            <th>KPPN</th>
			<th>Tanggal</th>
            <th>Akun</th>
            <th>Jumlah</th>
            <!--th>Usulan Revisi</th>
            <!--th>Tanggal</th-->

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                $total = 0;

                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_ntpn() . "</td>";
                            echo "<td>" . $value->get_satker_code() . "</td>";
                            echo "<td>" . $value->get_kppn_code() . "</td>";
                            echo "<td>" . $value->get_tanggal() . "</td>";
                            echo "<td>" . $value->get_account_code() . "</td>";
                            //echo "<td>" . $value->get_revision_no() . "</td>";
                            echo "<td align='right'>" . number_format($value->get_line_amount()) . "</td>";
                            //echo "<td>" . $value->get_last_update_date(). "</td>";
							$total = $total + $value->get_line_amount;
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
			<tfoot>
                    <tr>
                        <td colspan='5'></td>
                        <td class='ratatengah'><b>GRAND TOTAL</td>
                        <td align='right'><b><?php echo number_format($total); ?>
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