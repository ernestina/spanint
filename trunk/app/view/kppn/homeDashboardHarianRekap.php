<div id="top">
    <div id="header">
        <?php
        if (!isset($this->kodeunit)) {
            if (Session::get('role') == KANWIL) {
                echo "<h2>Hari ini di " . Session::get('user') . "</h2>";
            } else {
                echo "<h2>Hari ini di DJPB</h2>";
            }
        } else {
            echo "<h2>Hari ini di " . $this->namaunit . "</h2>";
        }
        ?>
    </div>

    <div id="fitur">
        <div id="top-status-bar">
            <div>
                <div id="last-update" style="float: left; margin-right: 20px; padding: 6px 0px 6px 0px; display: none;"></div>
                <?php
                if ((Session::get('role') == ADMIN) and ( isset($this->kodeunit))) {
                    echo "<div id='nav-container' style='float: left; padding: 3px 20px 3px 20px; border-left: 1px solid #e5e5e5;'>Kembali ke: ";
                    echo "<a href='" . URL . "home/harian/'>DJPB</a>";
                    echo "</div>";
                }
                ?>
                <div id="warning-container"></div>
                <div style="float: right; padding-top: 3px;">Periode: <a href="<?php echo URL; ?>home/harian" class="active">Hari Ini</a><a href="<?php echo URL; ?>home/mingguan">7 Hari</a><a href="<?php echo URL; ?>home/bulanan">30 Hari</a></div>
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
        <div id="summary-container"></div>
    </div>
</div>

<script src="<?php echo URL; ?>public/js/dashboard.js"></script>

<script type="text/javascript">

    var pieJenisSP2D;
    var pieNominalSP2D;
    var pieReturSP2D;
    var pieStatusLHP;

    var needRedraw = false;

    var totalData = 5;
    var loadedData = 0;

    var summaryHeader;

    var serverUrl = '<?php echo URL; ?>';

    var unit_list = new Array();
    unit_list = [<?php
                $currCount = 0;
                foreach ($this->unit_list as $value) {
                    if ($currCount > 0) {
                        echo " , ";
                    }
                    if (!isset($this->namaunit)) {
                        if (Session::get('role') == KANWIL) {
                            echo "'" . $value->get_kd_d_kppn() . "'";
                        } else {
                            echo "'" . $value->get_kd_d_kanwil() . "'";
                        }
                    } else {
                        echo "'" . $value->get_kd_d_kppn() . "'";
                    }
                    $currCount++;
                }
                ?>];

    function redraw() {

        resizeDisplay();
        renderPie(pieJenisSP2D, "pie-jenis-sp2d");
        renderPie(pieNominalSP2D, "pie-nominal-sp2d");
        renderPie(pieReturSP2D, "pie-retur-sp2d");
        renderPie(pieStatusLHP, "pie-status-lhp");
        resizeSummary("summary-container");

    }

    function init() {

        $("#loading-animation").css("opacity", "1");

        resizeDisplay();

        //Pie
        $.ajax({
            'global': false,
            'url': serverUrl + 'dataJSON/pieJenisSP2D/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function(data) {
                pieJenisSP2D = data;
                renderPie(data, "pie-jenis-sp2d");
            }
        });
        $.ajax({
            'global': false,
            'url': serverUrl + 'dataJSON/pieNominalSP2D/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function(data) {
                pieNominalSP2D = data;
                renderPie(data, "pie-nominal-sp2d");
            }
        });
        $.ajax({
            'global': false,
            'url': serverUrl + 'dataJSON/pieReturSP2D/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function(data) {
                pieReturSP2D = data;
                renderPie(data, "pie-retur-sp2d");
            }
        });
        $.ajax({
            'global': false,
            'url': serverUrl + 'dataJSON/pieStatusLHP/1/<?php echo $this->kodeunit; ?>',
            'dataType': 'json',
            'success': function(data) {
                pieStatusLHP = data;
                renderPie(data, "pie-status-lhp");

                //Summary
                $.ajax({
                    'global': false,
                    'url': serverUrl + 'dataJSON/summaryUnit',
                    'dataType': 'json',
                    'success': function(data) {
                        summaryHeader = data;
                        renderSummary(data, "summary-container");
                    }
                });

            }
        });

        //Status
        $.ajax({
            'global': false,
            'url': serverUrl + 'dataJSON/lastUpdate',
            'dataType': 'json',
            'success': function(data) {
                $("#last-update").html("Data server diperbarui pada " + data.lastUpdate);
                $("#last-update").fadeIn();
            }
        });
    }

    $(document).ready(function() {
        addLoadingAnimation("body");
        window.setInterval(init(), 20 * 60 * 1000);
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