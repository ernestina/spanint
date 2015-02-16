<!-- A beautiful app starts with a beautiful code :) -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-9 col-md-6 col-sm-12">
                <h2><?php echo $this->page_title; ?></h2>
            </div>
            
            <div class="col-lg-1 col-md-2 col-sm-12 top-padded">
                <?php if (isset($this->xls_url)) { ?>
                <a href="<?php echo ($this->xls_url); ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> XLS</a>
                <?php } ?>
            </div>

            <div class="col-lg-1 col-md-2 col-sm-12 top-padded">
                <?php if (isset($this->pdf_url)) { ?>
                <a href="<?php echo ($this->pdf_url); ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                <?php } ?>
            </div>

            <div class="col-lg-1 col-md-2 col-sm-12 top-padded">
                <?php if (isset($this->filters)) { ?>
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <?php } ?>

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

<?php 

    if (isset($this->table_config)) {
        $table_configs = explode(' ', $this->table_config);
        
        foreach ($table_configs as $config) {
            if ($config == 'numbered') {
                $table_numbered = true;
            }
        }
    }

?>

<div id="table-container" class="wrapper">
    <table class="footable">

        <thead>
            
            <?php 

                if (isset($this->table_custom_header)) { 
                    
                    echo $this->table_custom_header;
                    
                    
                } else { 
            
            ?>
            
                <tr>
                    
                    <?php if (isset($table_numbered)) { echo '<th class="align-center">No.</th>'; } ?>                   
                    <?php foreach ($this->table_columns as $column) { ?>

                        <?php $configs = explode(" ", $column->config); ?>

                        <th <?php 

                                foreach ($configs as $config) {
                                    if ($config == 'align-center') { echo 'class="align-center" '; }
                                    else if ($config == 'align-right') { echo 'class="align-right" '; }
                                    else if ($config == 'align-left') { echo 'class="align-left" '; }
                                }

                            ?>>
                            <?php echo $column->title; ?>
                        </th>
                    <?php } ?>
                </tr>
            
            <?php } ?>
            
        </thead>

        <tbody>

            <?php $no = 1; ?>

            <?php if (isset($this->table_rows)) { ?>

                <?php if (empty($this->table_rows)) { ?>

                    <td class="align-center">Tidak ada data.</td>

                <?php } else { ?>
            
                    <?php $no = 1; ?>

                    <?php foreach ($this->table_rows as $row) { ?>

                        <tr>
                            <?php if (isset($table_numbered)) { echo '<td class="align-center">' . $no++ . '</td>'; } ?>  
                            
                            <?php $i = 0; ?>
                            
                            <?php foreach ($row as $cell) { ?>
                            
                                <?php $configs = explode(' ', $this->table_columns[$i++]->config); ?>
                            
                                <td <?php 
                                                                  
                                        foreach ($configs as $config) {

                                            if ($config == 'align-center') { echo 'class="align-center" '; }
                                            else if ($config == 'align-right') { echo 'class="align-right" '; }
                                            else if ($config == 'align-left') { echo 'class="align-left" '; }

                                        }
                        
                                    ?>>
                                    <?php
                                                           
                                        $displayed = false;
                    
                                        foreach ($configs as $config) {

                                            if ($config == 'number-format') { echo number_format($cell); $displayed = true; }

                                        }
                                                           
                                        if ($displayed == false) { echo($cell); }
                                    
                                    ?>
                                </td>
                            
                            <?php } ?>
                        </tr>

                    <?php } ?>

                <?php } ?>

            <?php } else { ?>

                <td class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>

            <?php } ?>

        </tbody>
        
        <tfoot>
            
                    
        
        </tfoot>

    </table>
</div>

<?php if (isset($this->filters)) { ?>

    <div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                    <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>
                </div>

                <form id="filter-form" method="POST" action="<?php echo $this->filter_direction; ?>" enctype="multipart/form-data">

                    <div class="modal-body">
                        
                        <?php $filterid = 0; ?>
                        
                        <?php foreach ($this->filters as $filter) { ?>
                        
                            <div id="<?php echo 'warning-filter'.$filterid; ?>" class="alert alert-danger" style="display:none;"></div>
                            <label class="isian"><?php echo $filter->label; ?>:</label>
                            
                            <?php if (($filter->type == "number") || ($filter->type == "text")) { ?>
                                <input class="form-control" type="<?php echo $filter->type; ?>" name="<?php echo $filter->name; ?>" id="<?php echo 'filter'.$filterid; ?>" value="<?php if (isset($this->{$filter->name})) { echo $this->{$filter->name}; } ?>">
                            <?php } else if ($filter->type == "select") { ?>
                                <select class="form-control" type="text" name="<?php echo $filter->name; ?>" id="<?php echo 'filter'.$filterid; ?>">
                                    <?php foreach ($filter->options as $option) { ?>
                                        <option value="<?php echo $option->value; ?>" <?php if ((isset($filter->selected)) && ($filter->selected == $option->value)) { echo 'selected'; } ?>><?php echo $option->text; ?></option>
                                    <?php } ?>   
                                </select>
                            <?php } ?>
                        
                            <br/>
                        
                        <?php } ?>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return submit_filter()">Kirim</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

<?php } ?>

<script type="text/javascript" charset="utf-8">
    
    function submit_filter() {
        
        
        
    }

</script>