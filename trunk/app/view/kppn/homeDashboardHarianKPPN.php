<div id="top">
	<div id="header">
        <?php if (Session::get('role')==KPPN) {
            
            echo "<h2>Hari ini di ".Session::get('user')."</h2>";
    
        } else {
    
            echo "<h2>Hari ini di ".$this->namaunit."</h2>";
    
        } ?>
    </div>
    
    <div id="fitur">
        <div id="top-status-bar">
            <div>
                <div id="last-update" style="float: left; margin-right: 20px; padding: 6px 0px 6px 0px; display: none;"></div>
                <?php if (Session::get('role')==KANWIL) {
                    echo "<div id='nav-unit' style='float: left; padding: 4px 20px 3px 20px; border-left: 1px solid #e5e5e5;'>Kembali ke: ";
                    echo "<a href='".URL."home/harian/".$this->kodekanwil."'>".$this->namakanwil."</a>";
                    echo "</div>";
                } else if (Session::get('role')==ADMIN) {
                    echo "<div id='nav-container' style='float: left; padding: 3px 20px 3px 20px; border-left: 1px solid #e5e5e5;'>Kembali ke: ";
                    echo "<a href='".URL."home/harian/'>DJPB</a>";
                    echo "<a href='".URL."home/harian/".$this->kodekanwil."'>".$this->namakanwil."</a>";
                    echo "</div>";
                } ?>
                <div id="warning-container"></div>
                <div id="nav-period" style="float: right; padding-top: 3px;">Periode: <a href="<?php echo URL; ?>home/harian" class="active">Hari Ini</a><a href="<?php echo URL; ?>home/mingguan">7 Hari</a><a href="<?php echo URL; ?>home/bulanan">30 Hari</a></div>
            </div>
        </div>
        <div id="pie-container">
            <div>
                <div id="pie-jenis-sp2d" style="display: none;"></div>
            </div>
            <div>
                <div id="pie-nominal-sp2d" style="display: none;"></div>
            </div>
            <div>
                <div id="pie-retur-sp2d" style="display: none;"></div>
            </div>
            <div>
                <div id="pie-status-lhp" style="display: none;"></div>
            </div>
        </div>
        <div id="ticker-container">
            <div id="list-ongoing" style="display: none;"></div>
            <div id="list-completed" style="display: none;"></div>
        </div>
    </div>
</div>

<script src="<?php echo URL; ?>public/js/dashboard.js"></script>

<script type="text/javascript">
    
    var pieJenisSP2D;
    var pieNominalSP2D;
    var pieReturSP2D;
    var pieStatusLHP;
    
    var listSPMOngoing;
    var listSP2DFinished;
    
    var needRedraw = false;
    
    var totalData = 6;
    var loadedData = 0;
    
    function redraw() {
        
        resizeDisplay();
        renderPie(pieJenisSP2D,"pie-jenis-sp2d");
        renderPie(pieNominalSP2D,"pie-nominal-sp2d");
        renderPie(pieReturSP2D,"pie-retur-sp2d");
        renderPie(pieStatusLHP,"pie-status-lhp");
        
        resizeList("list-ongoing");
        resizeList("list-completed");
        
    }
    
    function init() {
        
        $("#loading-animation").css("opacity","1");
        
        resizeDisplay();
        
        //Pie
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/pieJenisSP2D/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function (data) {
                pieJenisSP2D = data;
                renderPie(data,"pie-jenis-sp2d");
            }
        });
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/pieNominalSP2D/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function (data) {
                pieNominalSP2D = data;
                renderPie(data,"pie-nominal-sp2d");
            }
        });
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/pieReturSP2D/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function (data) {
                pieReturSP2D = data;
                renderPie(data,"pie-retur-sp2d");
            }
        });
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/pieStatusLHP/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function (data) {
                pieStatusLHP = data;
                renderPie(data,"pie-status-lhp");
            }
        });
        
        //List
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/listSPMOngoing/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function (data) {
                listSPMOngoing = data;
                renderList(data,"list-ongoing");
            }
        });  
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/listSP2DFinished/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function (data) {
                listSP2DFinished = data;
                renderList(data,"list-completed");
            }
        });
        
        //Status
        $.ajax({
            'global': false,
            'url': '<?php echo URL; ?>dataJSON/lastUpdate',
            'dataType': 'json',
            'success': function (data) {
                $("#last-update").html("Data server diperbarui pada " + data.lastUpdate);
                $("#last-update").fadeIn();
            }
        });
    }
    
    $(document).ready(function() {
        addLoadingAnimation("body");
        window.setInterval(init(), 20*60*1000);
        window.setInterval(function() {
            
            if (needRedraw) {
            
                redraw();
                needRedraw = false;

            }
            
        }, 500);
    });
    
    $(window).resize(function() {
        needRedraw = true;
    });
    
</script>