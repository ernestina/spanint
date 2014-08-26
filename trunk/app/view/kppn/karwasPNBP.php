<div id="top">
    <div id="header">
        <h2>Karwas PNBP
        </h2>
    </div>

    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader'>
            <tbody>
                <tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">DIPA PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>No. DIPA</td>
                    <td>Kode Satker</td>
                    <td>Kode KPPN</td>
                    <td>Jenis Belanja</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
                    //var_dump ($this->data);
                    if (isset($this->data1)) {
                        if (empty($this->data1)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                
                                echo "<td>" . $d_data->get_dipa_no() . "</td>";
                                echo "<td>" . $d_data->get_satker_code() . "</td>";
                                echo "<td>" . $d_data->get_kppn_code() . "</td>";
                                echo "<td>" . $d_data->get_jenis_belanja() . "</td>";
                                echo "<td>" . $d_data->get_line_amount() . "</td>";

                                echo "</tr>	";
                            }
                        }
                    } else {
                        echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    }
                ?>
                
                <tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">Penerimaan PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>Kode Akun</td>
                    <td>Kode Satker</td>
                    <td colspan=2>Kode KPPN</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
                    //var_dump ($this->data);
                    if (isset($this->data2)) {
                        if (empty($this->data2)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                
                                echo "<td>" . $d_data->set_account_code() . "</td>";
                                echo "<td>" . $d_data->set_satker_code() . "</td>";
                                echo "<td colspan=2>" . $d_data->set_kppn_code() . "</td>";
                                echo "<td>" . $d_data->set_line_amount() . "</td>";

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