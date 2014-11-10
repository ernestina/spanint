<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Cek Data Supplier</h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

            </div>
        </div>

        </div>

    </div>
</div>
<?php 
echo count($this->d_pmrt);
if (isset($this->d_pmrt)) {
    $no=1;
    $i=0;
    while (count($this->d_pmrt)>$no){
                    foreach ($this->d_pmrt[$no++] as $d_pmrt) {
                        echo "<br/>" . $d_pmrt."\n";
                    }
                }
}
?>
<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Upload PMRT</h4>

            </div>

            <form id="filter-form" method="POST" action="cekPMRT" enctype="multipart/form-data">

                <div class="modal-body">
                    <div id="wfile_pmrt" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">File PMRT : </label>
                    <input class='form-control' type="file" name="file_pmrt" id="file_pmrt" value="<?php if (isset($this->d_file_pmrt)) {
                            echo $this->d_file_pmrt;
                        } ?>">


                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
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

    function hideErrorId() {
        $('.alert-danger').fadeOut(0);
    }

    function hideWarning() {

        $('#file_pmrt').keyup(function() {
            if (document.getElementById('file_pmrt').value != '') {
                $('#wfile_pmrt').fadeOut(200);
            }
        })

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_file_pmrt = document.getElementById('file_pmrt').value;
        var v_filename = v_file_pmrt.replace(/^.*[\\\/]/, '').toUpperCase();
        var v_file_pmrt_depan = v_filename.substring(0, 4);
        var v_file_pmrt_extension = v_filename.substring(v_filename.length - 5);

        var jml = 0;
        
        if (v_file_pmrt_depan !== 'PMRT' || v_file_pmrt_extension !== '.XLSX') {
            var wfile_pmrt =  'file yang diupload bukan file pmrt';
            $('#wfile_pmrt').html(wfile_pmrt);
            $('#wfile_pmrt').fadeIn(200);
            jml++;
        }
        
        if (v_file_pmrt === '') {
            var wfile_pmrt = 'Harap pilih file yang akan diupload';
            $('#wfile_pmrt').html(wfile_pmrt);
            $('#wfile_pmrt').fadeIn(200);
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>