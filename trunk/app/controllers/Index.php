<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        
        if (Session::get('role') == ADMIN) {
			header('location:' . URL . 'dataKppn/monitoringSp2d');
        } elseif (Session::get('role') == SATKER) {
            header('location:' . URL . 'dataKppn/monitoringSp2d');
        } elseif (Session::get('role') == KPPN) {
            header('location:' . URL . 'home'); 
		} elseif (Session::get('role') == PKN) {
            header('location:' . URL . 'dataRetur/monitoringReturPKN');
        } elseif (Session::get('role') == KANWIL) {
            header('location:' . URL . 'dataKppn/monitoringSp2d');
        }else {
            header('location:' . URL . 'auth/login');
        }
    }

}
