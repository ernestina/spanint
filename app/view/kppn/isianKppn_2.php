<div id="top">
    <div id="header">
        <h2>MONITORING SP2D - BANK<br>
            <?php echo Session::get('user'); ?>
        </h2>
    </div>
</div>
<div id="top">
    <div id="kiri">
        <form method="POST" action="monitoringSp2d" enctype="multipart/form-data">
            <div id="wsp2d" class="error"></div>
            No SP2D: <br>
            <input type="number" name="nosp2d" id="nosp2d" size="15">

            <div id="wbarsp2d" class="error"></div>
            No Transaksi: <br>
            <input type="number" name="barsp2d" id="barsp2d">

            <div id="winvoice" class="error"></div>
            No Invoice: <br>
            <input type="text" name="invoice" id="invoice">

            <div id="wbank" class="error"></div>
            Nama Bank: <br>
            <select type="text" name="bank" id="bank">
                <option value=''>- pilih -</option>
                <option value='MDRI'>Mandiri</option>
                <option value='BRI'>BRI</option>
                <option value='BNI'>BNI</option>
                <option value='BTN'>BTN</option>
            </select>

            <div id="wtgl" class="error"></div>
            Tanggal: <br>
            <ul class="inline">
                <li style="margin-left: -40px"><input type="text" class="tanggal" name="tgl_awal" id="datepicker"> </li> <li>s/d</li>
                <li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker"></li>
            </ul>

            <div id="wfxml" class="error"></div>
            Nama file xml: <br>
            <input type="text" name="fxml" id="fxml">

            <ul class="inline">
                <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
            </ul>
        </form>
    </div>



    <div id="kanan">
        <table class="table-bordered zebra scroll" width="100%">
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th>Tanggal SP2D</th>
            <th>No. SP2D</th>
            <th>Status</th>
            <th>Tanggal Create</th>
            <th>No. Transaksi</th>
            <th>No. Invoice</th>
            <th>Jumlah Rp</th>
            <th>Nama Bank</th>
            <th>Nama Supplier</th>
            <th>No. Rekening Supplier</th>
            <th>Deskripsi</th>
            <th>File Transaksi</th>
            <th>Keterangan</th>

            </thead>
            <tbody>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "Tidak ada data";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_payment_date() . "</td>";
                            echo "<td>" . $value->get_check_number() . "</td>";
                            echo "<td>" . $value->get_return_code() . "</td>";
                            echo "<td>" . $value->get_creation_date() . "</td>";
                            echo "<td>" . $value->get_check_number_line_num() . "</td>";
                            echo "<td>" . $value->get_invoice_num() . "</td>";
                            echo "<td>" . $value->get_check_amount() . "</td>";
                            echo "<td>" . $value->get_bank_account_name() . "</td>";
                            echo "<td>" . $value->get_vendor_name() . "</td>";
                            echo "<td>" . $value->get_vendor_ext_bank_account_num() . "</td>";
                            echo "<td>" . $value->get_invoice_description() . "</td>";
                            echo "<td>" . $value->get_ftp_file_name() . "</td>";
                            echo "<td>" . $value->get_return_desc() . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "silahkan masukan filter";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
            $(function(){
            hideErrorId();
                    hideWarning();
                    $("#tgl_awal").datepicker({dateFormat: "yy-mm-dd"
            });
                    $("#tgl_akhir").datepicker({dateFormat: "yy-mm-dd"
            });
            });
            function hideErrorId(){
            $('.error').fadeOut(0);
            }

    function hideWarning(){
    $('#nosp2d').change(function(){
    if (document.getElementById('nosp2d').value != ''){
    $('#wsp2d').fadeOut(200);
    }
    });
            $('#barsp2d').change(function(){
    if (document.getElementById('barsp2d').value != ''){
    $('#wbarsp2d').fadeOut(200);
    }
    });
            $('#invoice').change(function(){
    if (document.getElementById('invoice').value != ''){
    $('#winvoice').fadeOut(200);
    }
    });
            $('#bank').change(function(){
    if (document.getElementById('bank').value != ''){
    $('#wbank').fadeOut(200);
    }
    });
            $('#fxml').change(function(){
    if (document.getElementById('fxml').value != ''){
    $('#wfxml').fadeOut(200);
    }
    });
    }

    function cek_upload(){
    var pattern = '^[0-9]+$';
            var v_nosp2d = document.getElementById('nosp2d').value;
            var v_barsp2d = document.getElementById('barsp2d').value;
            var v_invoice = document.getElementById('invoice').value;
            var v_bank = document.getElementById('bank').value;
            var v_tglawal = document.getElementById('tgl_awal').value;
            var v_tglakhir = document.getElementById('tgl_akhir').value;
            var v_fxml = document.getElementById('fxml').value;
            var jml = 0;
            if (v_nosp2d == '' && v_barsp2d == '' && v_invoice == '' && v_bank == '' && v_tglawal == '' && v_tglakhir == '' && v_fxml == ''){
    $('#wsp2d').html('Harap isi salah satu parameter');
            $('#wsp2d').fadeIn();
            $('#wbarsp2d').html('Harap isi salah satu parameter');
            $('#wbarsp2d').fadeIn();
            $('#winvoice').html('Harap isi salah satu parameter');
            $('#winvoice').fadeIn();
            $('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
            $('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
            $('#wfxml').html('Harap isi salah satu parameter');
            $('#wfxml').fadeIn();
            jml++;
    }

    if (v_nosp2d != '' && Math.floor(Math.log(v_nosp2d) / Math.LN10 + 1) != 15){
    $('#wsp2d').html('No. SP2D harus 15 digit');
            $('#wsp2d').fadeIn(200);
            jml++;
    }

    f(v_nosp2d != '' && !v_nosp2d.match(pattern)){
    var wsp2d = 'No SP2D harus dalam bentuk angka!';
            $('#wsp2d').html(wsp2d);
            $('#wsp2d').fadeIn(200);
            jml++;
    }

    if (v_barsp2d != '' && Math.floor(Math.log(v_barsp2d) / Math.LN10 + 1) != 21){
    $('#wbarsp2d').html('No. Transaksi harus 21 digit');
            $('#wbarsp2d').fadeIn(200);
            jml++;
    }

    f(v_barsp2d != '' && !v_barsp2d.match(pattern)){
    var wbarsp2d = 'No Transaksi harus dalam bentuk angka!';
            $('#wbarsp2d').html(wbarsp2d);
            $('#wbarsp2d').fadeIn(200);
            jml++;
    }

    if (v_invoice != '' && Math.floor(Math.log(v_invoice) / Math.LN10 + 1) != 18){
    $('#winvoice').html('No. invoice harus 18 digit');
            $('#winvoice').fadeIn(200);
            jml++;
    }

    if (v_tglawal > v_tglakhir){
    $('#wtgl').html('Tanggal awal tidak boleh melebihi tanggal akhir');
            $('#wtgl').fadeIn(200);
            jml++;
    }

    if (jml > 0){
    return false;
    }
    }
</script>