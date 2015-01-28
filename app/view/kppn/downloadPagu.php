<?php

    $ftp_address2 ='http://10.100.93.56/public/P'.$this->kppn_code.date('dmY').$this->ekstensi;
	header('location:' . $ftp_address2);
    exit;

?>