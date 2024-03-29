<div id="top">
    <div id="header">
        <h2>MONITORING SP2D HARIAN
            <?php //echo Session::get('user'); ?>
        </h2>
    </div>

    <a href="#nModal" class="modal">FILTER DATA</a><br><br>
    <div id="nModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
            $_SERVER['PHP_SELF'];
            ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>

            <div id="top">
                <form method="POST" action="sp2dHarian" enctype="multipart/form-data">
                    <div id="wbank" class="error"></div>
                    <label class="isian">Nama Bank: </label>
                    <select type="text" name="bank" id="bank">
                        <option value=''>- pilih -</option>
                        <option value='MDRI' <?php if ($this->d_bank == MDRI) {
                   echo "selected";
               } ?>>Mandiri</option>
                        <option value='BRI' <?php if ($this->d_bank == BRI) {
                   echo "selected";
               } ?>>BRI</option>
                        <option value='BNI' <?php if ($this->d_bank == BNI) {
                   echo "selected";
               } ?>>BNI</option>
                        <option value='BTN' <?php if ($this->d_bank == BTN) {
                   echo "selected";
               } ?>>BTN</option>
                        <option value='5' <?php if ($this->d_bank == 5) {
                   echo "selected";
               } ?>>SEMUA BANK</option>
                    </select>

                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal: </label>
                    <ul class="inline">
                        <li><input type="text" class="tanggal" name="tgl_awal" id="datepicker" value="<?php if (isset($this->d_tgl_awal)) {
                   echo $this->d_tgl_awal;
               } ?>">
                        </li> <li>s/d</li>
                        <li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker1" value="<?php if (isset($this->d_tgl_akhir)) {
                   echo $this->d_tgl_akhir;
               } ?>">
                        </li>
                    </ul>

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>



    <div id="fitur">
        <table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th>Tanggal SP2D</th>
            <th>No. SP2D</th>
            <th>Status</th>
            <th>Tanggal Selesai SP2D</th>
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
                            echo "<td style='text-align: right;'>" . $value->get_check_amount() . "</td>";
                            echo "<td>" . $value->get_bank_account_name() . "</td>";
                            echo "<td>" . $value->get_vendor_name() . "</td>";
                            echo "<td>" . $value->get_vendor_ext_bank_account_num() . "</td>";
                            echo "<td>" . $value->get_invoice_description() . "</td>";
                            echo "<td>" . $value->get_ftp_file_name() . "</td>";
                            echo "<td>" . $value->get_return_desc() . '<br>' . $value->get_payment_method() . "</td>";
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
    $(function() {
        hideErrorId();
        hideWarning();

        $("#tgl_awal").datepicker({dateFormat: "yy-mm-dd"
        });

        $("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
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

        $('#datepicker').change(function() {
            if (document.getElementById('datepicker').value != '' && document.getElementById('datepicker1').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

        $('#datepicker1').change(function() {
            if (document.getElementById('datepicker').value != '' && document.getElementById('datepicker1').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_bank = document.getElementById('bank').value;
        var v_tglawal = document.getElementById('datepicker').value;
        var v_tglakhir = document.getElementById('datepicker1').value;

        var jml = 0;
        if (v_bank == '') {
            $('#wbank').html('Harap isi parameter');
            $('#wbank').fadeIn();
            jml++;
        }

        if (v_tglawal == '' || v_tglakhir == '') {
            $('#wtgl').html('Harap isi parameter');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (v_tglawal > v_tglakhir) {
            $('#wtgl').html('Tanggal awal tidak boleh melebihi tanggal akhir');
            $('#wtgl').fadeIn(200);
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>