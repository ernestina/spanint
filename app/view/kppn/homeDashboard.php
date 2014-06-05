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
            $volumeSP2D = array();
            for ($i=0; $i<7; $i++) {
                $volumeSP2D[$i] = 0;
            }
            if (isset($this->dataStatusSP2D)){
                foreach ($this->dataStatusSP2D as $value){
                    for ($i=0; $i<7; $i++) {
                        if($value->get_payment_date() == date('d-m-Y',(time()-($i*24*60*60)))) {
                            $volumeSP2D[$i]++;
                        }
                    }
                }
            }
            $openSP2D = 0;
            if (isset($this->dataHistSPM)){
                foreach ($this->dataHistSPM as $value){
                    $openSP2D++;
                }
            }
            $jenisSP2D_gaji=0;
			$jenisSP2D_non_gaji=0;
			$jenisSP2D_retur=0;
            $jenisSP2D_void=0;
            $jenisSP2D_nil_gaji=0;
            $jenisSP2D_nil_non_gaji=0;
			if (isset($this->dataJenisSP2D)){
                foreach ($this->dataJenisSP2D as $value){
					$jenisSP2D_gaji+=$value->get_invoice_num();
					$jenisSP2D_non_gaji+=$value->get_check_date();
					$jenisSP2D_retur+=$value->get_check_number();
					$jenisSP2D_void+=$value->get_check_number_line_num();
                    
				    $jenisSP2D_nil_gaji+=$value->get_check_amount();
					$jenisSP2D_nil_non_gaji+=$value->get_bank_account_name();
				}
            }
            $statusLHP_completed = 0;
            $statusLHP_validated = 0;
            $statusLHP_error = 0;
            $statusLHP_lainnya = 0;
            if (isset($this->dataLHP)){
                foreach ($this->dataLHP as $value){
					if ($value->get_status()=='Validated'){
						$statusLHP_validated++;
					} else if ($value->get_status()=='Error'){
						$statusLHP_error++;
					} else if ($value->get_status()=='Completed'){
						$statusLHP_completed++;
					} else {
                        $statusLHP_lainnya++;
                    }
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
        <div id="invoice-volume-container" class="dashboard-block">
            <div class="graph-title">Volume SP2D per Hari</div>
            <div id="invoice-volume" style="width: 300px; height: 250px;"></div>
        </div>
        <div id="invoice-value-container" class="dashboard-block">
            <div class="graph-title">Nilai SP2D</div>
            <div id="invoice-value" style="width: 300px; height: 250px;"></div>
        </div>
        <div id="reporting-status-container" class="dashboard-block">
            <div class="graph-title">Status LHP</div>
            <div id="reporting-status" style="width: 300px; height: 250px;"></div>
        </div>
        <!--
        <div id="notification-container" class="dashboard-block">
            <div id="open-invoice" class="notification">
                <span class="notification-title">Jumlah SP2D dalam Proses</span>
                <span class="notification-number"><?php //echo $openSP2D; ?></span>
            </div>
            <div id="open-invoice" class="notification">
                <span class="notification-title">Jumlah Revisi DIPA</span>
                <span class="notification-number">26</span>
            </div>
        </div>
        -->
    </div>
</div>

<script type="text/javascript">
    function calculateGraphWidth() {
        $("#invoice-volume").width($("#fitur").innerWidth()-$("#invoice-status-container").outerWidth()-$("#invoice-type-container").outerWidth()-40);
        $("#notification-container").width($("#fitur").innerWidth()-$("#invoice-status-container").outerWidth()-$("#invoice-type-container").outerWidth()-40);
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
        //Jenis SP2D
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
        //Nilai SP2D
        var valueofSP2Dchart = new CanvasJS.Chart("invoice-value", {
            data: [{
                type: "pie",
                dataPoints: [
                    { label: "Gaji", y: <?php echo $jenisSP2D_nil_gaji; ?> },
                    { label: "Non Gaji", y: <?php echo $jenisSP2D_nil_non_gaji; ?> }
                ]
            }]
        });
        valueofSP2Dchart.render();
        //Volume SP2D
        var volumeSP2Dchart = new CanvasJS.Chart("invoice-volume", {
            data: [{
                type: "line",
                dataPoints: [
                    { label: "<?php echo date('d-m-Y',(time()-(6*24*60*60))); ?>", y: <?php echo $volumeSP2D[6]; ?> },
                    { label: "<?php echo date('d-m-Y',(time()-(5*24*60*60))); ?>", y: <?php echo $volumeSP2D[5]; ?> },
                    { label: "<?php echo date('d-m-Y',(time()-(4*24*60*60))); ?>", y: <?php echo $volumeSP2D[4]; ?> },
                    { label: "<?php echo date('d-m-Y',(time()-(3*24*60*60))); ?>", y: <?php echo $volumeSP2D[3]; ?> },
                    { label: "<?php echo date('d-m-Y',(time()-(2*24*60*60))); ?>", y: <?php echo $volumeSP2D[2]; ?> },
                    { label: "<?php echo date('d-m-Y',(time()-(1*24*60*60))); ?>", y: <?php echo $volumeSP2D[1]; ?> },
                    { label: "<?php echo date('d-m-Y',(time()-(0*24*60*60))); ?>", y: <?php echo $volumeSP2D[0]; ?> }
                ]
            }]
        });
        volumeSP2Dchart.render();
        //Status LHP
        var statusLHPchart = new CanvasJS.Chart("reporting-status", {
            data: [{
                type: "pie",
                dataPoints: [
                    { label: "Completed", y: <?php echo $statusLHP_completed; ?> },
                    { label: "Belum Interface", y: <?php echo $statusLHP_validated; ?> },
                    { label: "Error", y: <?php echo $statusLHP_error; ?> },
                    { label: "Lainnya", y: <?php echo $statusLHP_lainnya; ?> }
                ]
            }]
        });
        statusLHPchart.render();
    });
    $(window).resize(function() {
        calculateGraphWidth();
    });
</script>