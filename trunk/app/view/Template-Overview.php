<!-- Template: Overview -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded" style="border: none">
    
    <div class="container-fluid">
        
        <div class="row">

            <div class="col-lg-8 col-md-6 col-sm-12">

                <h2><?php echo $this->content->title; ?></h2>

            </div>
            
            <div class="hidden-xs hidden-sm col-lg-4 col-md-6 col-sm-12 top-padded align-right">

                <?php if (isset($this->content->parameters)) { ?>

                    <?php foreach ($this->content->parameters as $parameter) { ?>

                        <div class="header-parameters">
                            
                            <div class="parameter-name"><?php if (!isset($parameter->name) || ($parameter->name == '')) { echo '&nbsp;'; } else { echo $parameter->name; } ?></div>
                            <div class="parameter-value"><?php echo $parameter->value; ?></div>

                        </div>

                    <?php } ?>

                <?php } else { ?>

                    <?php echo $this->content->subtitle; ?>

                <?php } ?>

            </div>
            
            <div class="hidden-md hidden-lg col-sm-12 top-padded">

                <?php if (isset($this->content->parameters)) { ?>

                    <?php foreach ($this->content->parameters as $parameter) { ?>

                        <div class="header-parameters">
                            
                            <div class="parameter-name"><?php if (!isset($parameter->name) || ($parameter->name == '')) { echo '&nbsp;'; } else { echo $parameter->name; } ?></div>
                            <div class="parameter-value"><?php echo $parameter->value; ?></div>

                        </div>

                    <?php } ?>

                <?php } else { ?>

                    <?php echo $this->content->subtitle; ?>

                <?php } ?>

            </div>
            
        </div>

    </div>
    
</div>

<?php if (isset($this->content->status_tiles)) { ?>

    <div class="main-window-segment sub-segment">

        <div class="container-fluid">

            <div class="row">

                <?php foreach ($this->content->status_tiles as $stid=>$status_tile) { ?>

                    <?php 

                    if (count($this->content->status_tiles) == 6) {

                        $stidclasses = 'col-lg-4 col-md-6 col-sm-12';

                    } else if (count($this->content->status_tiles) == 4) {

                        $stidclasses = 'col-lg-3 col-md-6 col-sm-12';

                    } else if (count($this->content->status_tiles) == 3) {

                        $stidclasses = 'col-lg-4 col-md-12 col-sm-12';

                    } else if (count($this->content->status_tiles) == 2) {

                        $stidclasses = 'col-lg-6 col-md-6 col-sm-12';

                    } else if (count($this->content->status_tiles) == 1) {

                        $stidclasses = 'col-lg-12 col-md-12 col-sm-12';

                    }

                    ?>

                    <div class="<?php echo $stidclasses; ?>">

                        <div class="status-tile">

                            <div class="container-fluid">

                                <div class="row">
                        
                                    <div class="col-sm-6 col-xs-12 status-tile-canvas-container">
                                        
                                        <div class="status-tile-canvas" id="status-tile-canvas-<?php echo $stid; ?>"></div>

                                    </div>

                                    <div class="col-sm-6 col-xs-12 status-tile-info-container">
                                        
                                        <h4><?php echo ($status_tile->title); ?></h4>

                                        <?php if (isset($status_tile->datasets)) { ?>

                                            <?php foreach ($status_tile->datasets as $stdid=>$stdataset) { ?>

                                                <p><span class="status-pie-bullet" style="background: <?php echo $status_tile->colors[$stdid]; ?>"></span>&nbsp;&nbsp;<?php echo $stdataset->name; ?></p>

                                            <?php } ?>

                                        <?php } else { ?>

                                            <p><?php echo $status_tile->subtitle; ?></p>

                                        <?php } ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

<?php } ?>

<?php if (isset($this->content->main_tile)) { ?>

    <div class="main-window-segment sub-segment" style="margin-bottom: 15px;">

        <div class="container-fluid">

            <div class="row segment-spacer hidden-sm hidden-xs">

            </div>

            <?php 

            if (count($this->content->status_tiles) == 6) {

                $stmainclasses = 'col-lg-8 col-md-6 col-sm-12';
                $stnotfclasses = 'col-lg-4 col-md-6 col-sm-12';

            } else if (count($this->content->status_tiles) == 4) {

                $stmainclasses = 'col-lg-9 col-md-6 col-sm-12';
                $stnotfclasses = 'col-lg-3 col-md-6 col-sm-12';

            } else if (count($this->content->status_tiles) == 3) {

                $stmainclasses = 'col-lg-8 col-md-6 col-sm-12';
                $stnotfclasses = 'col-lg-4 col-md-6 col-sm-12';

            } else {

                $stmainclasses = 'col-lg-9 col-md-6 col-sm-12';
                $stnotfclasses = 'col-lg-3 col-md-6 col-sm-12';

            }

            ?>

            <div class="row">

                <div class="<?php echo $stmainclasses; ?>">

                    <div id="main-tile">
                        
                        <div class="tile-header">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-lg-8 col-md-12">

                                        <h4><?php echo ($this->content->main_tile->title); ?></h4>

                                    </div>

                                    <div class="col-lg-4 col-md-12 align-right">

                                        <select>
                                            <option>Tampilkan data lainnya...</option>
                                            <option>Data 1</option>
                                            <option>Data 2</option>
                                        </select>

                                        <div class="hidden-lg" style="height: 10px;"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div id="main-tile-content">

                            <div class="container-fluid">

                                <div class="row top-padded-little">

                                    <div id="mainChart" class="col-md-12">

                                        <div id="main-chart" style="width: 100%; margin-top: 10px"> </div>

                                    </div>

                                </div>

                                <div class="row top-padded-little">

                                    <div class="col-md-12">

                                        <div id="main-tile-legend">
                                            
                                            <div class="legend-item">
                                                
                                                <div class="legend-label"></div>
                                                <div class="legend-info"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="<?php echo $stnotfclasses; ?>">

                    <div id="notification-tile">
                        
                        <div class="tile-header">
                                        
                            <h4>Notifikasi</h4>

                        </div>

                        <div class="tile-content">
                            

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

<script type="text/javascript">

rotateChart = false;

function generateChart() {

<?php if (isset($this->content->main_tile)) { ?>

    <?php if ($this->content->main_tile->type == 'bar') { ?>

        var chart = c3.generate({

            bindto: '#main-chart',

            data: {
                columns: [

                    <?php foreach ($this->content->main_tile->datasets as $mcid=>$mcdataset) { ?>

                        <?php if ($mcid > 0) { echo ','; } ?>

                        [

                            <?php if (isset($mcdataset->name)) { echo "'" . $mcdataset->name . "', "; } ?>

                            <?php foreach ($mcdataset->values as $mcdv=>$mcdatasetvalue) { ?>

                                <?php if ($mcdv > 0) { echo ','; } ?>

                                <?php echo $mcdatasetvalue; ?>

                            <?php } ?>

                        ]

                    <?php } ?>

                ],

                <?php if (isset($this->content->main_tile->stacked) && ($this->content->main_tile->stacked == true)) { ?>

                    groups: [

                        [ 

                            <?php foreach ($this->content->main_tile->datasets as $mcid=>$mcdataset) { ?>

                                <?php if ($mcid > 0) { echo ','; } ?>

                                <?php echo "'" . $mcdataset->name . "'"; ?>

                            <?php } ?>

                        ]
                    ],

                <?php } ?>

                type: 'bar'
            },

            axis: {

                rotated: rotateChart,

                <?php if (isset($this->content->main_tile->categories)) { ?>

                    x: {
                        type: 'category',
                        categories: [

                            <?php foreach ($this->content->main_tile->categories as $mcatid=>$mcategory) { ?>

                                <?php if ($mcatid > 0) { echo ','; } ?>

                                <?php echo "'" . $mcategory . "'" ?>

                            <?php } ?>

                        ]
                    }

                <?php } ?>
            },

            <?php if (isset($this->content->main_tile->colors)) { ?>

            color: {

                pattern: [

                    <?php foreach ($this->content->main_tile->colors as $mccol=>$mcolors) { ?>

                        <?php if ($mccol > 0) { echo ','; } ?>

                        <?php echo "'" . $mcolors . "'" ?>

                    <?php } ?>

                    ]

            },

            <?php } ?>

            bar: {
                width: {
                    ratio: 0.8
                }
            }

        });

    <?php } ?>

<?php } ?>

<?php if (isset($this->content->status_tiles)) { ?>
    
    <?php foreach ($this->content->status_tiles as $stid=>$status_tile) { ?>

        <?php if ($status_tile->type == 'gauge') { ?>

            var statchart<?php echo $stid; ?> = c3.generate({

                bindto: '#status-tile-canvas-<?php echo $stid; ?>',

                data: {
                    columns: [

                        [<?php echo "'" . $status_tile->title . "'"; ?>, <?php echo $status_tile->value; ?>]

                    ],
                    type: 'gauge'
                },

                gauge: {

                    <?php if (isset($status_tile->max_value)) { ?>

                        label: {
                            format: function(value, ratio) {
                                return value;
                            }
                        },

                    <?php } ?> 

                    min: 0,

                    <?php if (isset($status_tile->max_value)) { ?> max: <?php echo $status_tile->max_value; ?>, <?php } ?> 

                    thickness: 10
                },

                color: {
                    pattern: ['#FF6666', '#F6CE40', '#409ACA'],
                    threshold: {
                        unit: 'percentage',
                        <?php if (isset($status_tile->max_value)) { ?> max: <?php echo $status_tile->max_value; ?>, <?php } ?> 
                        values: [25, 50, 75]
                    }
                },

                size: {

                    height: $('#status-tile-canvas-<?php echo $stid; ?>').attr('height')

                }

            });

        <?php } else if ($status_tile->type == 'pie') { ?>

            var statchart<?php echo $stid; ?> = c3.generate({

                bindto: '#status-tile-canvas-<?php echo $stid; ?>',

                data: {
                    columns: [

                        <?php foreach ($status_tile->datasets as $stdid=>$stdataset) { ?>

                            <?php if ($stdid > 0) { echo ','; } ?>

                            [

                                <?php if (isset($stdataset->name)) { echo "'" . $stdataset->name . "', "; } ?>
                                <?php echo $stdataset->value; ?>

                            ]

                        <?php } ?>

                    ],
                    type: 'pie'
                },

                legend: {
                    show: false
                },

                <?php if (isset($this->content->main_tile->colors)) { ?>

                    color: {

                        pattern: [

                            <?php foreach ($this->content->main_tile->colors as $mccol=>$mcolors) { ?>

                                <?php if ($mccol > 0) { echo ','; } ?>

                                <?php echo "'" . $mcolors . "'" ?>

                            <?php } ?>

                            ]

                    },

                <?php } ?>

                pie: {
                    label: {
                        format: function (value, ratio, id) {
                            return;
                        }
                    }
                },

                size: {

                    height: $('#status-tile-canvas-<?php echo $stid; ?>').attr('height')

                }

            });

        <?php } ?>

    <?php } ?>

<?php } ?>

}

function arrangePage() {

    $('.status-tile').each(function() {

        $(this).css('height', 'auto');

    });

    $('.status-tile-canvas').each(function() {

        $(this).removeAttr('height');
        $(this).removeAttr('width');
        $(this).removeAttr('style');

        $(this).attr('width', $(this).parent().innerWidth());

    });

    $('#notification-tile').css('height', 'auto');

    max_status_tile_info_height = 0;

    $('.status-tile-info-container').each(function() {

        if (max_status_tile_info_height < $(this).innerHeight()) {

            max_status_tile_info_height = $(this).innerHeight();

        }

    });

    $('.status-tile-canvas').each(function() {

        $(this).attr('height', max_status_tile_info_height);

    });

    if ($('#notification-tile').innerWidth() < $('#main-tile').innerWidth()) {

        rotateChart = false;

        $('#main-chart').css('min-height', '250px');

        max_status_tile_height = 0;

        $('.status-tile').each(function() {

            if (max_status_tile_height < $(this).innerHeight()) {

                max_status_tile_height = $(this).innerHeight();

            }

        });

        $('.status-tile').each(function() {

            $(this).css('height', max_status_tile_height);

        });

        $('#notification-tile').css('height', $('#main-tile').innerHeight());

    } else {

        rotateChart = true;

        $('#main-chart').css('min-height', '400px');

        $('.status-tile-canvas').each(function() {

            $(this).attr('height', '100');

        });

    }

    generateChart();

}    

$(document).ready(function() {


    window.setTimeout(function() {

        arrangePage();

    }, 1000);

});

$(window).resize(function() {

    window.setTimeout(function() {

        arrangePage();

    }, 1000);

});

</script>