<?php

    $file = 'http://10.100.93.56/public/P'.$this->kppn_code.$this->ekstensi;
    $remote_file = 'public/P'.$this->kppn_code.date("dmY").$this->ekstensi;

    // set up basic connection
    $conn_id = ftp_connect("10.100.93.56");

    // login with username and password
    $login_result = ftp_login($conn_id, "spanint", "password123");

    // upload a file
    ftp_put($conn_id, $remote_file, $file, FTP_BINARY);

    
    // close the connection
    ftp_close($conn_id);
    $ftp_address2 ='http://10.100.93.56/public/P'.$this->kppn_code.date("dmY").$this->ekstensi;
	header('location:' . $ftp_address2);
    exit;
?>