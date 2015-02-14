<div id="top">
    <div id="header">
        <h2>MONITORING POSISI INVOICE <?php //echo $nama_satker;  ?> <?php //echo $kode_satker;  ?>
            <?php //echo Session::get('user'); ?>
        </h2>
    </div>
	<div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
		

	</div>
	<div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">

    <?php
	//----------------------------------------------------
	//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
    if($this->data as $value){
		foreach ($this->data as $value) {
			$kdnum = $value->get_invoice_num();
		}
    ?>
	
	<a href="<?php echo URL; ?>PDF/detailposisiSPM_PDF/<?php echo $kdnum; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
	</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
	<a href="<?php echo URL; ?>PDF/detailposisiSPM_PDF/<?php echo $kdnum; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>



    <?php

	}
    //----------------------------------------------------		
    ?>
	</div>
    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <!--th>KPPN</th-->
            <th>Nomor Invoice</th>
            <th>Nilai Invoice Rp</th>
            <th>Deskripsi Invoice</th>
            <th>Approval Status</th>
            <th>Status</th>
            <!--th>original_recipient</th-->
            <th>User</th>
            <!--th>Posisi User</th-->
            <th>Mulai</th>
            <!--th>Jam Mulai</th>
            <th>Selesai</th>
            <th>Durasi</th-->
            </thead>
            <tbody>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";

                            //echo "<td>" . $value->get_ou_name() . "</td>";
                            echo "<td>" . $value->get_invoice_num() . "</td>";
                            echo "<td class='ratakanan'>" . $value->get_invoice_amount() . "</td>";
                            echo "<td>" . $value->get_invoice_description() . "</td>";
                            echo "<td>" . $value->get_wfapproval_status() . "</td>";
                            echo "<td>" . $value->get_status() . "</td>";
                            //echo "<td>" . $value->get_original_recipient() . "</td>";
                            echo "<td>" . $value->get_to_user() . ' ' . $value->get_fu_description() . "</td>";
                            //echo "<td>" . $value->get_fu_description() . "</td>";
                            echo "<td>" . $value->get_begin_date() . ' ' . $value->get_time_begin_date() . "</td>";
                            //echo "<td>" . $value->get_time_begin_date() . "</td>";
                            //echo "<td>" . $value->get_end_date() . ' ' . $value->get_time_end_date() . "</td>";
                            //echo "<td>" . $value->get_time_end_date() . "</td>";
                            //echo "<td> &nbsp </td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
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