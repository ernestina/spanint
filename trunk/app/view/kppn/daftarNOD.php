<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar NOD</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_kd_satker)) {
                    echo "WA_NUMBER : " . $this->d_wa_number;
                }
                if (isset($this->d_invoice)) {
                    echo "<br>SP4HLN_NUMBER : " . $this->d_sp4hln_numbet;
                }
                if (isset($this->invoice)) {
                    echo "<br>APDPL_NUMBER : " . $this->d_apdpl_number;
                }
                if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                    echo "<br>Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                }
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


<div id="table-container" class="wrapper">
    <form method='POST' action='<?php echo URL;?>dataNOD/downloadNOD' enctype='multipart/form-data'>
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='mid'>No.</th>
                <th>WA_NUMBER<br>REF_NUMBER</th>
                <th>RM_NAME</th>
                <th>PAYMENT_DATE<br>BOOK_DATE</th>
                <th>NOD_NUMBER<br>NOD_DATE<br>TYPE</th>
                <th>SP4HLN_NUMBER</th>
                <th>CURR_LOAN<br>AMOUNT<br>RATE_TYPE</th>
                <th>CURR_EFF<br>AMOUNT_CURR_EFF<br>AMOUNT_CURR_LOCAL</th>
                <th>APDPL_NUMBER<br>REGISTER_NUMBER</th>
                <th>AKUN_CODE<br>OUTPUT_CODE<br>DANA_CODE</th>
                <th>AMOUNT_SERVICE</th>
                <th>MEDIUM_NAME<br>ONLENDING_DESC<br>DMFAS_ID</th>
                <th>REKSUS_TYPE<br>REKSUS_NUMBER</th>
                <th>Pilih <input type="checkbox" onClick="toggle(this)" /> </th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='mid'>" . $no++ . "</td>";
                        echo "<td>" . $value->get_wa_number() . "<br>".$value->get_ref_number()."</td>";
                        echo "<td>" . $value->get_rm_name() . "</td>";
                        echo "<td>" . $value->get_payment_date() ."<br>".$value->get_book_date(). "</td>";
                        echo "<td>" . $value->get_nod_number() . "<br>".$value->get_nod_date(). "<br>".$value->get_type(). "</td>";
                        echo "<td>" . $value->get_sp4hln_number() . "</td>";
                        echo "<td>" . $value->get_curr_loan(). "<br>".number_format($value->get_amount()). "<br>".$value->get_rate_type() . "</td>";
                        echo "<td>" . $value->get_curr_eff(). "<br>".number_format($value->get_amount_curr_eff()). "<br>".number_format($value->get_amount_curr_local()) . "</td>";
                        echo "<td>" . $value->get_apdpl_number(). "<br>".$value->get_register_number() . "</td>";
                        echo "<td>" . $value->get_akun_code(). "<br>".$value->get_output_code(). "<br>".$value->get_dana_code()."</td>";
                        echo "<td>" . $value->get_amount_service()."</td>";
                        echo "<td>" . $value->get_medium_name(). "<br>".$value->get_onlending_desc(). "<br>".$value->get_dmfas_id()."</td>";
                        echo "<td>" . $value->get_reksus_type(). "<br>".$value->get_reksus_number()."</td>";
                        echo "<td><input name='checkbox[]' type='checkbox' id='checkbox' value='" . $value->get_wa_number() . "'> </td>";

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
    
<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12" style="text-align: right">
                
                <input class='btn btn-default' style='width:100%' id='submit' class='sukses' type='submit' name='submit_file2' value='Unduh' onClick=''>
                
            </div>
            
        </div>
    </div>
</div>
    
    
</form>

<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="daftarNOD" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="wwanumber" class="alert alert-danger" style="display:none;"></div>

                    <label class="isian">WA_NUMBER: </label>
                    <input class="form-control" type="text" name="wa_number" id="wa_number" value="<?php if (isset($this->d_wa_number)) {
                   echo $this->d_wa_number;
               } ?>">
                    <br/>
                    <label class="isian">SP4HLN_NUMBER: </label>
                    <input class="form-control" type="text" name="sp4hln_number" id="sp4hln_number" value="<?php if (isset($this->d_sp4hln_number)) {
                   echo $this->d_sp4hln_number;
               } ?>">
                    <br/>
                    <label class="isian">APDPL_NUMBER: </label>
                    <input class="form-control" type="text" name="apdpl_number" id="apdpl_number" value="<?php if (isset($this->d_apdpl_number)) {
                   echo $this->d_apdpl_number;
               } ?>">
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal SP2D: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
    });
    function toggle(source) {
        checkboxes = document.getElementsByName('checkbox[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    function hideErrorId() {
        $('.alert').fadeOut(0);
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