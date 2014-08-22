<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DataGR_STATUS_LHP {

    private $db;
    private $_kppn;
    private $_bulan;
    /*
      private $_satu;
      private $_02;
      private $_03;
      private $_04;
      private $_05;
      private $_06;
      private $_07;
      private $_08;
      private $_09;
      private $_10;
      private $_11;
      private $_12;
      private $_13;
      private $_14;
      private $_15;
      private $_16;
      private $_17;
      private $_18;
      private $_19;
      private $_20;
      private $_21;
      private $_22;
      private $_23;
      private $_24;
      private $_25;
      private $_26;
      private $_27;
      private $_28;
      private $_29;
      private $_30;
      private $_31;
     */
    private $_table1 = 'spgr_mpn_receipts_all_level1';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel Data Tetap
     * @param limit batas default null
     * return array objek Data Tetap */

    public function get_gr_status_lhp_filter($filter) {
        Session::get('id_user');
        $sql = "SELECT *
				FROM "
                . $this->_table1 . " 
				WHERE 
				KPPN = '" . Session::get('id_user')

        ;
        $no = 0;
        foreach ($filter as $filter) {
            $sql .= " AND " . $filter;
        }
        ///$sql .= " ORDER BY GL_DATE DESC ";
        //var_dump ($sql);
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $d_data = new $this($this->registry);
            $d_data->set_kppn($val['KPPN']);
            $d_data->set_bulan($val['BULAN']);
            /*
              $d_data->set_satu($val['01']);
              $d_data->set_02($val['02']);
              $d_data->set_03($val['03']);
              $d_data->set_04($val['04']);
              $d_data->set_05($val['05']);
              $d_data->set_06($val['06']);
              $d_data->set_07($val['07']);
              $d_data->set_08($val['08']);
              $d_data->set_09($val['09']);
              $d_data->set_10($val['10']);
              $d_data->set_11($val['12']);
              $d_data->set_13($val['13']);
              $d_data->set_14($val['14']);
              $d_data->set_15($val['15']);
              $d_data->set_16($val['16']);
              $d_data->set_17($val['17']);
              $d_data->set_18($val['18']);
              $d_data->set_19($val['19']);
              $d_data->set_20($val['20']);
              $d_data->set_21($val['21']);
              $d_data->set_22($val['22']);
              $d_data->set_23($val['23']);
              $d_data->set_24($val['24']);
              $d_data->set_25($val['25']);
              $d_data->set_26($val['26']);
              $d_data->set_27($val['27']);
              $d_data->set_28($val['28']);
              $d_data->set_29($val['29']);
              $d_data->set_30($val['30']);
              $d_data->set_31($val['31']);
             */
            $data[] = $d_data;
        }
        return $data;
    }

    /*
     * setter
     */

    public function set_kppn($kppn) {
        $this->_kppn = $kppn;
    }

    public function set_bulan($bulan) {
        $this->_bulan = $bulan;
    }

    /*
      public function set_satu($satu) {
      $this->_satu = $satu;
      }

      public function set_02($dua) {
      $this->_02 = $dua;
      }

      public function set_03($tiga) {
      $this->_03 = $tiga;
      }

      public function set_04($empat) {
      $this->_04 = $empat;
      }
      public function set_05($lima) {
      $this->_05 = $lima;
      }
      public function set_06($enam) {
      $this->_06 = $enam;
      }
      public function set_07($tujuh) {
      $this->_07 = $tujuh;
      }
      public function set_08($delapan) {
      $this->_08 = $delapan;
      }
      public function set_09($sembilan) {
      $this->_09 = $semblan;
      }
      public function set_10($sepuluh) {
      $this->_10 = $sepuluh;
      }
      public function set_11($sebelas) {
      $this->_11 = $sebelas;
      }
      public function set_12($duabelas) {
      $this->_12 = $duabelas;
      }
      public function set_13($tigabelas) {
      $this->_13 = $tigabelas;
      }
      public function set_14($empatbelas) {
      $this->_14 = $empatbelas;
      }
      public function set_15($limabelas) {
      $this->_15 = $limabelas;
      }
      public function set_16($enambelas) {
      $this->_16 = $enambelas;
      }
      public function set_17($tujuhbelas) {
      $this->_17 = $tujuhbelas;
      }
      public function set_18($delapanbelas) {
      $this->_18 = $delapanbelas;
      }
      public function set_19($sembilanbelas) {
      $this->_19 = $sembilanbelas;
      }
      public function set_20($duapuluh) {
      $this->_20 = $duapuluh;
      }
      public function set_21($duapuluhsatu) {
      $this->_21 = $duapuluhsatu;
      }
      public function set_22($duapuluhdua) {
      $this->_22 = $duapuluhdua;
      }
      public function set_23($duapuluhtiga) {
      $this->_23 = $duapuluhtiga;
      }
      public function set_24($duapuluhempat) {
      $this->_24 = $duapuluhempat;
      }
      public function set_25($duapuluhlima) {
      $this->_25 = $duapuluhlima;
      }
      public function set_26($duapuluhenam) {
      $this->_26 = $duapuluhenam;
      }
      public function set_27($duapuluhtujuh) {
      $this->_27 = $duapuluhtujuh;
      }
      public function set_28($duapuluhdelapan) {
      $this->_28 = $duapuluhdelapan;
      }
      public function set_29($duapuluhsembilan) {
      $this->_29 = $duapuluhsembilan;
      }
      public function set_30($tigapuluh) {
      $this->_30 = $tigapuluh;
      }
      public function set_31($tigapuluhsatu) {
      $this->_31 = $tigapuluhsatu;
      }
      /*
     * getter
     */

    public function get_kppn() {
        return $this->_kppn;
    }

    public function get_bulan() {
        return $this->_bulan;
    }

    /*
      public function get_satu() {
      return $this->_satu;
      }

      public function get_02() {
      return $this->_02;
      }
      public function get_03() {
      return $this->_03;
      }
      public function get_04() {
      return $this->_04;
      }
      public function get_05() {
      return $this->_05;
      }
      public function get_06() {
      return $this->_06;
      }
      public function get_07() {
      return $this->_07;
      }
      public function get_08() {
      return $this->_08;
      }
      public function get_09() {
      return $this->_09;
      }
      public function get_10() {
      return $this->_10;
      }
      public function get_11() {
      return $this->_11;
      }
      public function get_12() {
      return $this->_12;
      }
      public function get_13() {
      return $this->_13;
      }
      public function get_14() {
      return $this->_14;
      }
      public function get_15() {
      return $this->_15;
      }
      public function get_16() {
      return $this->_16;
      }
      public function get_17() {
      return $this->_17;
      }
      public function get_18() {
      return $this->_18;
      }
      public function get_19() {
      return $this->_19;
      }
      public function get_20() {
      return $this->_20;
      }
      public function get_21() {
      return $this->_21;
      }
      public function get_22() {
      return $this->_22;
      }
      public function get_23() {
      return $this->_23;
      }
      public function get_24() {
      return $this->_24;
      }
      public function get_25() {
      return $this->_25;
      }
      public function get_26() {
      return $this->_26;
      }
      public function get_27() {
      return $this->_27;
      }
      public function get_28() {
      return $this->_28;
      }
      public function get_29() {
      return $this->_29;
      }
      public function get_30() {
      return $this->_30;
      }
      public function get_31() {
      return $this->_31;
      }



      /*
     * destruktor
     */

    public function __destruct() {
        
    }

}
