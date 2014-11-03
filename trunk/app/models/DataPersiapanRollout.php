<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataPersiapanRollout {

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
