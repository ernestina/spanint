<div id="top">
    <div id="header">
        <h2>STATUS FILE LHP INTERFACE <?php //echo $nama_satker;  ?> <?php //echo $kode_satker;  ?>
            <?php //echo Session::get('user'); ?>
        </h2>
    </div>

    <a href="#xModal" class="modal">FILTER DATA</a><br><br>
    <div id="xModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
            $_SERVER['PHP_SELF'];
            ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
            <div id="top">
                <form method="POST" action="GRstatus" enctype="multipart/form-data">
                    <div id="winvoice" class="error"></div>

                    <div id="wbank" class="status"></div>
                    <label class="isian">Status: </label>
                    <select type="text" name="status" id="status">
                        <option value=''>- pilih -</option>
                        <option value='Validated' <?php if ($this->status == Validated) {
                   echo "selected";
               } ?>>Validated</option>
                        <option value='Error' <?php if ($this->status == Error) {
                   echo "selected";
               } ?>>Error</option>
                        <option value='Completed' <?php if ($this->status == Completed) {
                   echo "selected";
               } ?>>Completed</option>

                    </select>

                    <label class="isian">Nama File: </label>
                    <input type="text" name="nama_file" id="nama_file" value="<?php if (isset($this->nama_file)) {
                   echo $this->nama_file;
               } ?>">


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();"></li>
                        <!--onClick="konfirm(); return false;"-->
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
            <th>Status File</th>
            <th>Tanggal Penerimaan</th>
            <th>Kode Bank</th>
            <th>Nomor Rekening Persepsi</th>
            <th>Nama File</th>
            <th>Responsibilty User</th>
            <th>Keterangan</th>

            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($this->data as $value) {
                    echo "<tr>	";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $value->get_status() . "</td>";
                    echo "<td>" . $value->get_gl_date() . "</td>";
                    echo "<td>" . $value->get_bank_code() . "</td>";
                    echo "<td>" . $value->get_bank_account_num() . "</td>";
                    echo "<td>" . $value->get_file_name() . "</td>";
                    echo "<td>" . $value->get_resp_name() . "</td>";
                    echo "<td>" . $value->get_keterangan() . "</td>";
                    echo "</tr>	";
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