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
            header('location:' . URL . 'home');
        }  elseif (Session::get('role') == SATKER) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == KPPN) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == PKN) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == KANWIL) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == DJA) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == BLU) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == BANK) {
            header('location:' . URL . 'dataDroping/monitoringDroping');
        } elseif (Session::get('role') == KL) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == ES1) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == UMADMIN) {
            header('location:' . URL . 'home');
        } elseif (Session::get('role') == MENKEU) {
            header('location:' . URL . 'dashboard/overviewMenkeu');
        } else {
            header('location:' . URL . 'auth/login');
        }
    }

}
