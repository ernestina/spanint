<div id="top">
    <div id="header">
        <h2>Karwas PNBP
        <br/>
		<?php
            if (isset($this->nmsatker)) {

                foreach ($this->nmsatker as $value1) {
                    $satker = $value1->get_nmsatker();
                }
            }
            echo $satker . " ";
            
                ?>
		
		</h2>
		
  </div>
	
	<ul class="inline" style="float: right">
	<li><a href="#xModal" class="modal">FILTER DATA</a></li></ul>
    <div id="xModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
        $_SERVER['PHP_SELF'];
?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>
            <div id="top">

                <form method="POST" action="KarwasPNBP" enctype="multipart/form-data">
                    <div id="winvoice" class="error"></div>


	<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="error"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>- Semua KPPN -</option>
    <?php
			foreach ($this->kppn_list as $value1) {
					if ($kode_kppn == $value1->get_kd_d_kppn()) {
					echo "<option value='" . $value1->get_kd_d_kppn() . "' selected>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
			} else {
					echo "<option value='" . $value1->get_kd_d_kppn() . "'>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
			}
			}
			?>
                        </select>
			<?php } ?>



                   <?php if (isset($this->kdsatker)) {
					echo $this->kdsatker;
					} ?>


                    <div id="wkdkppn" class="error"></div>
                    <label class="isian">Satker PNBP: </label>
                    <select type="text" name="kdsatker" id="kdsatker">
                        <!--option value='' selected>- pilih -</option-->
                        <?php
                        foreach ($this->data5 as $value1) {
                            echo "<option value = '" . $value1->get_satker_code() . "'>" . $value1->get_satker_code() . " | " . $value1->get_nmsatker() . "</option>";
						}
                       
                        ?>
                    </select>
					
					<label class="isian">PPP (DALAM PERSENTASE): </label>
                    <input type="text" name="ppp" id="ppp" value="<?php if (isset($this->ppp)) {
					echo $this->ppp;
					} ?>">


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return ();"></li>
                        <!--onClick="konfirm(); return false;"-->
                    </ul>
                </form>
            </div></div>
    </div>
	
    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader'>
            <tbody>
                <tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">DIPA PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
					<td>Kode Satker</td>
					<td>Kode KPPN</td>
                    <td>No. DIPA</td>
                    <td>Jenis Belanja</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php
					
                    $no = 1;
					$total_dipa = 0;
                    //var_dump ($this->data);
                    if (isset($this->data1)) {
                        if (empty($this->data1)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data1 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
                                echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td>" . $value->get_dipa_no() . "</td>";
                                echo "<td>" . $value->get_jenis_belanja() . "</td>";
                                echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailDipaPNBP/". $value->get_jenis_belanja(). "/"
								. $_POST['kdsatker'] . " target='_blank' '>" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_dipa = $total_dipa + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_dipa)."</td>";
                        }
                    } 
					// else {
                        // echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    // }
                ?>
                
                <tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">Penerimaan PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
					<td>Kode Satker</td>
                    <td>Kode KPPN</td>
                    <td colspan=2>Kode Akun</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_penerimaan = 0;
                    //var_dump ($this->data);
                    if (isset($this->data2)) {
                        if (empty($this->data2)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data2 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
								echo "<td>" . $value->get_satker_code() . "</td>";
                                echo "<td >" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_account_code() . "</td>";
                                
                                echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailGRPNBP/". $value->get_account_code(). "/"
								. $_POST['kdsatker'] . " target='_blank' '>" . number_format($value->get_line_amount()) ."</td>";
								$total_penerimaan = $total_penerimaan + $value->get_line_amount();
								//echo "</tr>	";
								
                                //echo "</tr>	";
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_penerimaan)."</td>";
                        }
                    } 
					// else {
                        // echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    // }
                ?>
				
                <tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">UP PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
					<td>Kode Satker</td>
                    <td>Kode KPPN</td>
                    <td colspan=2>Jenis SPM</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_up = 0;
                    //var_dump ($this->data);
                    if (isset($this->data4)) {
                        if (empty($this->data4)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data4 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
                                echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_jenis_spm() . "</td>";
								echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailUPPNBP/". $value->get_jenis_spm(). "/"
								. $_POST['kdsatker'] . " target='_blank' '>" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_up = $total_up + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_up)."</td>";
							
							
                        }
                    } 
					// else {
                        // echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    // }
                ?>
				
				<tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">BELANJA PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>Kode Satker</td>
					<td>Kode KPPN</td>
                    <td colspan=2>Akun</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_belanja =0;
                    //var_dump ($this->data);
                    if (isset($this->data3)) {
                        if (empty($this->data3)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data3 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
								echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_account_code() . "</td>";
                                //echo "<td>" . $value->get_line_amount() . "</td>";
								echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailBelanjaPNBP/". $value->get_account_code(). "/"
								. $_POST['kdsatker'] . " target='_blank' '>" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_belanja = $total_belanja + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_belanja)."</td>";
							
							
                        }
                    } 
					else {
                        echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    }
                ?>
				
				<tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">SETORAN UP/TUP PNBP</td>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>Kode Satker</td>
					<td>Kode KPPN</td>
                    <td colspan=2>Akun</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_setoran_up =0;
                    //var_dump ($this->data);
                    if (isset($this->data6)) {
                        if (empty($this->data6)) {
                            echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                        } else {
                            foreach ($this->data6 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
								echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_account_code() . "</td>";
                                //echo "<td>" . $value->get_line_amount() . "</td>";
								echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailBelanjaPNBP/". $value->get_account_code(). "/"
								. $_POST['kdsatker'] . " target='_blank' '>" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_setoran_up = $total_setoran_up + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_setoran_up)."</td>";
							
							
                        }
                    } 
					else {
                        echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    }
					$pendapatan_hitung = $this->ppp/100;
					$maksimum_pencairan = ($pendapatan_hitung * $total_penerimaan) - $total_belanja;
					?>
					<tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">MAKSIMUM PENCAIRAN</td>
					</tr>"
					<?php
					echo "<tr> " ;	
					echo "<td colspan='5'>MAKSIMUM PENCAIRAN (MP)</td> ";
					echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($maksimum_pencairan)."</td>";
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