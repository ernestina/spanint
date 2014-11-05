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
                <?php
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                }
                ?>
            </div>

            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                // untuk menampilkan last_update
                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server)<br/>" . $last_update->get_last_update() . " WIB";
                    }
                }
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
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Arus Kas Tingkat KPPN</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Realisasi Anggaran Tingkat KPPN</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Konsolidasi Saldo Kas Tingkat KPPN</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Arus Kas BUN dan KPPN</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian Belanja Pemerintah Pusat</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Realisasi APBN</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian Penerimaan Perpajakan</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
            </ul>
        </div>
    
    <div class="col-lg-6 col-md-6 col-sm-12" style="padding-top: 20px;">
        <ul class="list-group">
              
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian Penerimaan Pembiayaan</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian PNBP</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian Transfer Daerah</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian Penerimaan Hibah</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Penerimaan dan Pengeluaran Non Anggaran</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Rincian Pengeluaran Pembiayaan</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
              <li class="list-group-item" style="padding-bottom: 40px;">
                <div class="col-md-6">    
                    <h4>Laporan Penerimaan dan Pengeluaran PFK</h4>
                  </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> LIST LAPORAN</button>
                    <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> 05-NOV-2014</button>
                </div>
              </li>
                
                
            </ul>
        </div>
    </div>
</div>