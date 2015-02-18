<?php

class OverviewPenerimaanController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index($mode = null, $unit = null) {
        
        //Count Persentase Realisasi
        
        //Count Jumlah Realisasi
        
        //Count Revisi DIPA Dalam Proses
        
        //Count Line Chart
        
        $this->view->render('Template-Overview');
        
    }

    public function __destruct() {
        
    }
    
}

?>