<div id="top">
    <div id="header">
        <h2>STATUS FILE LHP INTERFACE <?php echo $this->d_tgl; ?> <?php //echo $kode_satker;  ?>
            <?php //echo Session::get('user'); ?>
        </h2>
    </div>

    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th>Status File</th>
            <th>Tanggal Penerimaan</th>
            <th>Kode Bank</th>
            <th>Nomor Rekening Persepsi</th>
            <th>Jumlah Rupiah</th>
            <th>Nomor Batch</th>
            <th>Nama File</th>
            <th>Tindakan</th>

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                foreach ($this->data as $value) {
                    echo "<tr>	";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $value->get_status() . "</td>";
                    echo "<td>" . $value->get_gl_date() . "</td>";
                    echo "<td>" . $value->get_bank_code() . "</td>";
                    echo "<td>" . $value->get_bank_account_num() . "</td>";
                    echo "<td class='ratakanan'>" . $value->get_keterangan() . "</td>";
                    echo "<td>" . $value->get_gr_batch_num() . "</td>";
                    echo "<td class='ratakiri'><a href=" . URL . "dataGR/detailPenerimaan/" . $value->get_file_name() . " target='_blank' >" . $value->get_file_name() . "</a></td>";
                    if ($value->get_status() == 'Validated') {
                        echo "<td>Lakukan interface ulang</td>";
                    } else if ($value->get_status() == 'Error') {
                        echo "<td>Cek File dan Upload Ulang</td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "</tr>	";
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