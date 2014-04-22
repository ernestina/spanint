<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserSpanController extends BaseController {
    /*
     * Konstruktor
     */

    public function __construct($registry) {
        parent::__construct($registry);
    }

    /*
     * Index
     */

	
	public function monitoringUserSpan() {   //nama function
		$d_user = new DataUserSPAN($this->registry); //model
		$filter = array ();
			if (isset($_POST['submit_file'])) {
				if (isset($_POST['nip'])){
					$filter[]=" USER_NAME = '".$_POST['nip']."'";
				}
			}	
		$this->view->data = $d_user->get_user_filter($filter);
		//var_dump($d_sppm->get_user_filter($filter));
		$this->view->render('kppn/monitoringUser');
	}
	
    public function __destruct() {
        
    }

}

