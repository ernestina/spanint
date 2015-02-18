<!-- Template: Overview -->
<!-- Derived from Dashboard -->

<script type="text/javascript" charset="utf-8">
    
    dashMode = true;
    
    Chart.defaults.global.responsive = true;
    Chart.defaults.global.showTooltips = false;
    Chart.defaults.global.maintainAspectRatio = false;
    
    <?php if (isset($this->tiles)) { ?>
    
        <?php foreach ($this->tiles as $tileid=>$tile) { ?>
    
            <?php if ($tile->type == 'pie') { ?>
    
                var tilePieData<?php echo $tileid; ?> = [
                    
                    <?php $i = 0; ?>
                    
                    <?php foreach ($tile->values as $value) { ?>
                    
                        <?php if ($i > 0) {  echo ','; } ?>

                        {
                            "value" : <?php echo $value->value; ?>,
                            "color" : "<?php echo $value->color; ?>"
                        }
                    
                        <?php $i++; ?>
                    
                    <?php } ?>

                ]
            
            <?php } ?>
    
        <?php } ?>
    
    <?php } ?>
                
    <?php if (isset($this->main_chart)) { ?>
    
        var mainChartData = {
            
            labels: [
                
                        <?php $i = 0; ?>

                        <?php foreach ($this->main_chart->labels as $label) { ?>

                            <?php if ($i > 0) { echo ','; } ?>
                            <?php echo '"' . $label . '"'; $i++; ?>

                        <?php } ?>
                    
                    ],
            
            datasets: [
                
                        <?php $i = 0; ?>
                
                        <?php foreach ($this->main_chart->datasets as $dataset) { ?>

                            <?php if ($i > 0) { echo ','; } ?>

                            {
                                label: "<?php echo $dataset->label; ?>",
                                fillColor: "rgba(<?php echo $dataset->color; ?>,0.2)",
                                strokeColor: "rgba(<?php echo $dataset->color; ?>,1)",
                                pointColor: "rgba(<?php echo $dataset->color; ?>,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(<?php echo $dataset->color; ?>,1)",
                                data: [
                                    
                                        <?php $j = 0; ?>
                                    
                                        <?php foreach ($dataset->values as $value) { ?>

                                            <?php if ($j > 0) { echo ','; } ?>
                                            <?php echo $value; $j++; ?>

                                        <?php } ?>                                      
                                      
                                      ]
                            }

                        <?php } ?>
                
                    ]
        };
                
    <?php } ?>
    
</script>

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    
    <div class="container-fluid">
        
        <div class="row">

            <div class="col-lg-8 col-md-6 col-sm-12">
                <h2><?php echo $this->page_title; ?></h2>
            </div>
            
            <div class="col-lg-4 col-md-6 col-sm-12 top-padded">
                
            </div>
            
        </div>
        
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <?php echo $this->page_subtitle; ?>
            </div>

            <div class="col-md-6 col-sm-12 align-right">
                <?php
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

<!-- Contents -->

<?php if (isset($this->tiles)) { ?>

    <div class="main-window-segment sub-segment">
        <div class="container-fluid">

            <div class="row">
                
                <?php if (isset($this->tiles)) { ?>
    
                    <?php foreach ($this->tiles as $tileid=>$tile) { ?>
    
                        <?php if ($tile->type == 'pie') { ?>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                                <div class="pie-segment">
                                    <div class="pie-canvas"><canvas id="pieCanvas<?php echo $tileid; ?>"></canvas></div>
                                    <div class="pie-legend">
                                        <h4><?php echo $tile->title; ?></h4>
                                        
                                        <?php foreach ($tile->values as $value) { ?>
                                        
                                            <div style="width: 50%; float: left; border-left: 4px solid <?php echo $value->color; ?>">
                                                <p><?php echo number_format($value->value); if (isset($value->unit)) { echo ' ' . $value->unit; } ?></p>
                                                <p class="sub"><?php echo $value->name; ?></p>
                                            </div>
                                        
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                    
                        <?php } else if ($tile->type == 'notification') { ?>
                
                            <div class="col-lg-3 col-md-6 col-sm-12 pie-segment-container">
                                <div class="pie-segment">
                                    <div class="pie-canvas" style="text-align: center; font-size: 32px;"><?php echo $tile->value; ?> <?php echo $tile->unit; ?></div>
                                    <div class="pie-legend">
                                        <h4><?php echo $tile->title; ?></h4>
                                        <p style="margin-left:0; padding-left:0" class="sub"><?php echo $tile->subtitle; ?></p>
                                    </div>
                                </div>
                            </div>
                        
                        <?php } ?>
                
                    <?php } ?>
                
                <?php } ?>

            </div>

        </div>
    </div>

<?php } ?>

<?php if (isset($this->main_chart)) { ?>

    <div class="sub-segment plain">
        <div class="container-fluid">

            <div class="row top-padded">

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h4><?php echo $this->main_chart->title; ?></h4>
                </div>
                
                <div class="col-sm-12 col-md-6 col-lg-6 align-right">
                    
                    <?php if (isset($this->switchers)) { ?>
                    
                        <h4>Tampilkan: &nbsp;
                            <select id="switchers">
                                <option value="0">Pilih salah satu...</option>
                                <?php foreach ($this->switchers as $sid=>$switcher) { ?>
                                    <option value="<?php echo $sid; ?>"><?php echo $switcher->description; ?></option>
                                <?php } ?>
                            </select>
                        </h4>
                    
                    <?php } ?>
                    
                    
                </div>

            </div>

            <div class="row" style="border-top: 1px solid #e5e5e5;">
                <div class="col-sm-12 col-md-6 col-lg-9">
                    <div id="dashboard-line" class="top-padded">
                        <canvas id="overviewMainChartCanvas"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="top-padded">
                        <?php if (isset($this->main_chart->legends)) { ?>
                        
                            <?php foreach($this->main_chart->legends as $lid=>$legend) { ?>
                            <div style="border: none; padding-bottom: 5px; display: table;">
                                <div style="border: none; display: table-row;">
                                    <div style="padding: 3px 5px; background: #999; color: #fff; border: none; display: table-cell;"><?php echo ($this->main_chart->labels[$lid]); ?></div>
                                    <div style="padding: 3px 5px; border: none; display: table-cell;"><?php echo ($legend); ?></div>
                                </div>
                            </div>
                            <?php } ?>
                        
                        <?php } ?>
                    </div>  
                </div>
            </div>

        </div>
    </div>

<?php } ?>

<script type="text/javascript" charset="utf-8">
    
    $('#switchers').change(function() {
       
        <?php foreach($this->switchers as $id=>$switcher) { ?>
        
        if ($(this).val() == <?php echo $id; ?>) {
            window.location.assign('<?php echo $switcher->link; ?>');
        }
                    
        <?php } ?>
        
    });
    
    $(document).ready(function() {
        
        $(".pie-canvas").each(function() {
            $(this).css("height", $(this).parent().children(".pie-legend").height());
        });
        
        window.setTimeout(function() {
            
            <?php if (isset($this->tiles)) { ?>
    
                <?php foreach ($this->tiles as $tileid=>$tile) { ?>

                    <?php if ($tile->type == 'pie') { ?>
            
                        var tilePieChart<?php echo $tileid; ?>Canvas = document.getElementById("pieCanvas<?php echo $tileid; ?>").getContext("2d");
                        var tilePieChart<?php echo $tileid; ?> = new Chart(tilePieChart<?php echo $tileid; ?>Canvas).Doughnut(tilePieData<?php echo $tileid; ?>);
            
                    <?php } ?>
            
                <?php } ?>
            
            <?php } ?>
            
            <?php if (isset($this->main_chart)) { ?>
            
                Chart.defaults.global.showTooltips = true;
                var mainChartCanvas = document.getElementById("overviewMainChartCanvas").getContext("2d");
            
                <?php if ($this->main_chart->type == 'line') { ?>
                    var mainChart = new Chart(mainChartCanvas).Line(mainChartData);
                <?php } else { ?>
                    var mainChart = new Chart(mainChartCanvas).Bar(mainChartData);
                <?php } ?>
            
            <?php } ?>
            
        }, 1000);
        
    });

</script>