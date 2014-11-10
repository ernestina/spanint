<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>List Unduh Pelaporan SPAN</h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <!--a href="#" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a-->    
            
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <!--button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button-->

            </div>
        </div>

        <div class="row" style="padding-top: 10px">

            <div class="col-md-6 col-sm-12">
            </div>

            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                // untuk menampilkan last_update
                        echo "Update Data Terakhir (Waktu Server) :<br> Sesuai dengan yang ada di Cetakan PDF<br/>";
                ?>                
            </div>

        </div>

    </div>
</div>
<!--Isi-->
<div class="container-fluid wrapper">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12" style="padding-top: 20px;">
            <ul class="list-group">
                <?php
                  if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<li class='list-group-item' style='padding-bottom: 40px;'>";
                            echo "<div class='col-md-6'>";
                            echo "<h4>".$value->get_file_hash()."</h4>";
                            echo "</div>";
                            echo "<div class='col-md-6' style='text-align: right;'>";
                            echo "<button type='button' class='btn btn-primary'><a href=".$this->fileURLdepan.$value->get_program_short_name()."><span class='glyphicon glyphicon-list-alt'></span>LIST LAPORAN</a></button>";
                            echo "<button type='button' class='btn btn-warning'><a href=".$this->fileURL.$value->get_request_id().".PDF><span class='glyphicon glyphicon-download-alt'></span>".date("d-m-Y", strtotime(substr($value->get_argument_text(),21,10)))."</a></button>";
                            echo "</div>";
                            echo "</li>";
                        }
                    }
                  } else {
                    echo "tidak ada data";   
                  }
                ?>
            </ul>
        </div>
    </div>
</div>