<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataLRAController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

    public function index() {
        
    }

    public function DataLRA() {
        $d_spm1 = new DataLRA($this->registry);
        $filter = array();
        $no = 0;
        //untuk mencatat log user
        $d_log = new DataLog($this->registry);
        $d_log->set_activity_time_start(date("d-m-Y h:i:s"));

		$this->view->data = $d_spm1->get_lra_apbn($filter);

        $this->view->render('baes1/LRA');
    }

    

    public function __destruct() {
        
    }

}
