<div id="top">
	<div id="header">
        <h2>7 Hari Terakhir di KPPN <?php echo Session::get('user') ?></h2>
        <?php
            $statusSP2D_berhasil = 0;
            $statusSP2D_gagal = 0;
            if (isset($this->dataStatusSP2D)){
                foreach ($this->dataStatusSP2D as $value){
                    if($value->get_return_desc()=='SUKSES') {
                        $statusSP2D_berhasil++;
                    } else {
                        $statusSP2D_gagal++;
                    }
                }
            }
            $jenisSP2D_gaji=0;
			$jenisSP2D_non_gaji=0;
			$jenisSP2D_retur=0;
            $jenisSP2D_void=0;
			if (isset($this->dataJenisSP2D)){
                foreach ($this->dataJenisSP2D as $value){
					$jenisSP2D_gaji+=$value->get_invoice_num();
					$jenisSP2D_non_gaji+=$value->get_check_date();
					$jenisSP2D_retur+=$value->get_check_number();
					$jenisSP2D_void+=$value->get_check_number_line_num();
				}
            }
        ?>
    </div>
    
    <div id="fitur" class="dashboard-container">
        <div id="invoice-status-container" class="dashboard-block">
            <div class="graph-title">Status SP2D</div>
            <div id="invoice-status" style="width: 300px; height: 250px;"></div>
        </div>
        <div id="invoice-type-container" class="dashboard-block">
            <div class="graph-title">Jenis SP2D</div>
            <div id="invoice-type" style="width: 300px; height: 250px;"></div>
        </div>
        <div id="invoice-time-container" class="dashboard-block">
            <div class="graph-title">Rata-rata Waktu Penyelesaian SP2D</div>
            <div id="invoice-time" style="width: 300px; height: 250px;"></div>
        </div>
        <div id="reporting-status-container" class="dashboard-block">
            <div class="graph-title">Status LHP</div>
            <div id="reporting-status" style="width: 300px; height: 250px;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function calculateGraphWidth() {
        $("#invoice-time").width($("#fitur").innerWidth()-$("#invoice-status-container").outerWidth()-$("#invoice-type-container").outerWidth()-40);
    }
    $(document).ready(function() {
        calculateGraphWidth();
        //Status SP2D
        var statusSP2Dchart = new CanvasJS.Chart("invoice-status", {
            data: [{
                type: "pie",
                dataPoints: [
                    { label: "Berhasil", y: <?php echo $statusSP2D_berhasil; ?> },
                    { label: "Gagal", y: <?php echo $statusSP2D_gagal; ?> }
                ]
            }]
        });
        statusSP2Dchart.render();
        //Status SP2D
        var typeSP2Dchart = new CanvasJS.Chart("invoice-type", {
            data: [{
                type: "pie",
                dataPoints: [
                    { label: "Gaji", y: <?php echo $jenisSP2D_gaji; ?> },
                    { label: "Non Gaji", y: <?php echo $jenisSP2D_non_gaji; ?> },
                    { label: "Retur", y: <?php echo $jenisSP2D_retur; ?> },
                    { label: "Void", y: <?php echo $jenisSP2D_void; ?> }
                ]
            }]
        });
        typeSP2Dchart.render();
        //Waktu Penyelesaian SP2D
        var typeSP2Dchart = new CanvasJS.Chart("invoice-time", {
            data: [{
                type: "line",
                dataPoints: [
                    { label: "Senin", y: 20 },
                    { label: "Selasa", y: 15 },
                    { label: "Rabu", y: 10 },
                    { label: "Kamis", y: 5 },
                    { label: "Jum'at", y: 5 },
                    { label: "Sabtu", y: 5 },
                    { label: "Minggu", y: 5 }
                ]
            }]
        });
        typeSP2Dchart.render();
    });
    $(window).resize(function() {
        calculateGraphWidth();
    });
</script>