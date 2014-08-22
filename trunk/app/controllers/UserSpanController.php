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
        $filter = array();
        if (isset($_POST['submit_file'])) {
            if ($_POST['kdkppn'] != '') {
                $filter[$no++] = " KDKPPN = '" . $_POST['kdkppn'] . "'";
                $d_kppn = new DataUser($this->registry);
                $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($_POST['kdkppn']);
                $this->view->d_kd_kppn = $_POST['kdkppn'];
            } else {
                $filter[$no++] = " KDKPPN = " . Session::get('id_user');
            }
            if ($_POST['nip'] != '') {
                $filter[] = " USER_NAME = '" . $_POST['nip'] . "'";
                $this->view->d_nip = $_POST['nip'];
            }
            $this->view->data = $d_user->get_user_filter($filter);
        }
        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KDKPPN = " . Session::get('id_user');
            $this->view->data = $d_user->get_user_filter($filter);
        }
        $this->view->render('kppn/monitoringUser');
    }

    public function monitoringUserSpan_PDF($kdkppn = null, $kdnip = null) {   //nama function
        $d_user = new DataUserSPAN($this->registry); //model
        $filter = array();
        if ($kdkppn != '') {
            $filter[$no++] = " KDKPPN = '" . $kdkppn . "'";
            $d_kppn = new DataUser($this->registry);
            $this->view->d_nama_kppn = $d_kppn->get_d_user_kppn($kdkppn);
        } else {
            $filter[$no++] = " KDKPPN = " . Session::get('id_user');
        }
        if ($kdnip != '') {
            $filter[] = " USER_NAME = '" . $kdnip . "'";
        }
        $this->view->data = $d_user->get_user_filter($filter);

        if (Session::get('role') == ADMIN) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil();
        }
        if (Session::get('role') == KANWIL) {
            $d_kppn_list = new DataUser($this->registry);
            $this->view->kppn_list = $d_kppn_list->get_kppn_kanwil(Session::get('id_user'));
        }
        if (Session::get('role') == KPPN) {
            $filter[$no++] = " KDKPPN = " . Session::get('id_user');
            $this->view->data = $d_user->get_user_filter($filter);
        }
        $this->view->load('kppn/monitoringUser_PDF');
    }

    public function __destruct() {
        
    }

}
