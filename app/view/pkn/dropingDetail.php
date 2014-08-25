<div id="top">
    <div id="header">
        <h2>MONITORING Penyaluran & Droping Dana SP2D - DETAIL
            <?php
            if (isset($this->d_bank)) {
                if ($this->d_bank == "MDRI") {
                    echo "<br> Mandiri";
                } elseif ($this->d_bank == "SEMUA_BANK") {
                    echo "<br> SEMUA_BANK";
                } else {
                    echo "<br> " . $this->d_bank;
                }
            }
            ?>
            <?php
            if (isset($this->d_tanggal)) {
                echo "Tanggal : " . $this->d_tanggal;
            }
            ?>
        </h2>
    </div>
	    <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : dropingDetail.php  

if(isset($this->data)){
	if($this->d_id){
		$id=$this->d_id;
	}		
	if($this->d_bank){
		$bank=$this->d_bank;
	}
	if (isset($this->d_tanggal)) {
		$tanggal=$this->d_tanggal;
	}
    ?>
 <ul class="inline" style="float: right"><li>
 <a href="<?php echo URL; ?>PDF/detailDroping_PDF/<?php echo $id . "/" .$bank . "/" . $tanggal; ?>" class="warning"><i class="icon icon-file icon-white"></i>PDF</a></li>							
   <?php
//----------------------------------------------------			
	}
?>

 <?php
// untuk menampilkan last_update
    if (isset($this->last_update)) {
        foreach ($this->last_update as $last_update) {
            echo "Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB";
        }
    }
    ?>

    <div id="fitur">

        <table width="100%" class="table table-bordered zebra" id='fixheader' style="font-size: 80%">
            <!--baris pertama-->
            <thead>
            <th class='mid'>No.</th>
            <th >Tanggal - Jam</th>
            <th >Mata Uang</th>
            <th >Nomor Transaksi BAT</th>
            <th >Nilai Transaksi</th>
            <th >Nama Rekening</th>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        $total = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_creation_date() . "</td>";
                            echo "<td>" . $value->get_payment_currency_code() . "</td>";
                            echo "<td>" . $value->get_bank_trxn_number() . "</td>";
                            echo "<td align = 'right'>" . number_format($value->get_payment_amount()) . "</td>";
                            $total+=$value->get_payment_amount();
                            echo "<td>" . $value->get_attribute4() . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            <td colspan="4"><b>TOTAL</b></td>
            <td align = 'right'><b><?php echo number_format($total) ?></b></td>
            <td > </td>
            </tbody>
        </table></div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
        $("#tgl_awal").datepicker({
            maxDate: "dateToday",
            dateFormat: 'dd-mm-yy',
            onClose: function(selectedDate, instance) {
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
            onClose: function(selectedDate) {
                $("#tgl_awal").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

    function hideErrorId() {
        $('.error').fadeOut(0);
    }

    function hideWarning() {

        $('#bank').change(function() {
            if (document.getElementById('bank').value != '') {
                $('#wbank').fadeOut(200);
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
        var pattern = '^[0-9]+$';
        var v_bank = document.getElementById('bank').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_bank == '' && v_tglawal == '' && v_tglakhir == '') {
            $('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
            $('#wtgl').html('Harap isi salah satu parameter');
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
            "table": document.getElementById('fixheader'),
            "datatable": oTable
        });
    });
</script>