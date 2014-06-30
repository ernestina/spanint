<?php


echo '{';
 
if ((Session::get('role') == KANWIL) and ($this->is_rekap)) {
    
    echo '"displayMode":"REKAP"'; echo ' , ';
    
    $total_gaji = 0;
    $total_non_gaji = 0;
    $total_lainnya = 0;
    $total_void = 0;

    $total_vol_gaji = 0;
    $total_vol_non_gaji = 0;

    $total_lhp_completed = 0;
    $total_lhp_validated = 0;
    $total_lhp_error = 0;
    $total_lhp_etc = 0;
    
    $total_retur_sudah_proses = 0;
    $total_retur_belum_proses = 0;
    
    $pos_count = 0;
    
    echo '"listKPPN": [';
    
    foreach ($this->kppn_list as $list) {
        
        if ($pos_count > 0) {
            echo ' , ';
        }
        echo '"'.$list->get_kd_d_kppn().' - '.$list->get_nama_user().'"';
        $pos_count++;
        
    }
    
    echo '] , ';
    
    $pos_count = 0;
    
    echo '"sp2dKPPN": [';
    
    foreach ($this->data_sp2d_rekap as $sp2d_rekap_kppn) {
        
        if ($pos_count > 0) {
            echo ' , ';
        }
        
        $total_gaji_kppn = 0;
        $total_non_gaji_kppn = 0;
        $total_void_kppn = 0;
        $total_lainnya_kppn = 0;

        $total_vol_gaji_kppn = 0;
        $total_vol_non_gaji_kppn = 0;
        
        foreach ($sp2d_rekap_kppn as $sp2d_rekap_harian) {
            
            $total_gaji += $sp2d_rekap_harian->get_gaji();
            $total_non_gaji += $sp2d_rekap_harian->get_non_gaji();
            $total_void += $sp2d_rekap_harian->get_void();
            $total_lainnya += $sp2d_rekap_harian->get_lainnya();

            $total_vol_gaji += $sp2d_rekap_harian->get_vol_gaji();
            $total_vol_non_gaji += $sp2d_rekap_harian->get_vol_non_gaji();
            
            //--
            
            $total_gaji_kppn += $sp2d_rekap_harian->get_gaji();
            $total_non_gaji_kppn += $sp2d_rekap_harian->get_non_gaji();
            $total_void_kppn += $sp2d_rekap_harian->get_void();
            $total_lainnya_kppn += $sp2d_rekap_harian->get_lainnya();

            $total_vol_gaji_kppn += $sp2d_rekap_harian->get_vol_gaji();
            $total_vol_non_gaji_kppn += $sp2d_rekap_harian->get_vol_non_gaji();
            
        }
        
        echo '{';
        echo '"gaji":"'.$total_gaji_kppn.'" , "nonGaji":"'.$total_non_gaji_kppn.'" , "void":"'.$total_void_kppn.'" , "lainnya":"'.$total_lainnya_kppn.'"';
        echo '}';
        
        $pos_count++;
    }
    
    echo '] , ';
    
    $pos_count = 0;
    
    echo '"lhpKPPN": [';
    
    foreach ($this->data_lhp_rekap as $lhp_rekap_kppn) {
        
        if ($pos_count > 0) {
            echo ' , ';
        }
        
        $total_lhp_completed_kppn = 0;
        $total_lhp_validated_kppn = 0;
        $total_lhp_error_kppn = 0;
        $total_lhp_etc_kppn = 0;
        
        foreach ($lhp_rekap_kppn as $lhp_rekap_harian) {
            
            $total_lhp_completed += $lhp_rekap_harian->get_lhp_completed();
            $total_lhp_validated += $lhp_rekap_harian->get_lhp_validated();
            $total_lhp_error += $lhp_rekap_harian->get_lhp_error();
            $total_lhp_etc += $lhp_rekap_harian->get_lhp_etc();
            
            $total_lhp_completed_kppn += $lhp_rekap_harian->get_lhp_completed();
            $total_lhp_validated_kppn += $lhp_rekap_harian->get_lhp_validated();
            $total_lhp_error_kppn += $lhp_rekap_harian->get_lhp_error();
            $total_lhp_etc_kppn += $lhp_rekap_harian->get_lhp_etc();
            
        }
        
        echo '{';
        echo '"completed":"'.$total_lhp_completed_kppn.'" , "validated":"'.$total_lhp_validated_kppn.'" , "error":"'.$total_lhp_error_kppn.'" , "etc":"'.$total_lhp_etc_kppn.'"';
        echo '}';
        
        $pos_count++;
        
    }
    
    echo '] , ';
    
    $pos_count = 0;
    
    echo '"returKPPN": [';
    
    foreach ($this->data_retur as $retur_kppn) {
        
        if ($pos_count > 0) {
            echo ' , ';
        }
        
        echo '{';
        echo '"sudahProses":"'.$retur_kppn->get_retur_sudah_proses().'" , "belumProses":"'.$retur_kppn->get_retur_belum_proses().'"';
        echo '}';
        
        $total_retur_sudah_proses += $retur_kppn->get_retur_sudah_proses();
        $total_retur_belum_proses += $retur_kppn->get_retur_belum_proses();
        
        $pos_count++;
    }
    
    echo '] , ';
    
    echo '"spmOngoingKPPN": [';
    
    $pos_count = 0;
    
    foreach ($this->data_pos_spm as $pos_spm_kppn) {
        
        $ongoing = 0;
        
        foreach ($pos_spm_kppn as $value) {
            $ongoing++;
        }
        
        if ($pos_count > 0) {
            echo ' , ';
        }
        
        echo '"'.$ongoing.'"';
        
        $pos_count++;
    }
    
    echo '] , ';
    
    echo '"jumlahSPMGaji":"'.$total_gaji.'"'; echo ' , ';
    echo '"jumlahSPMNonGaji":"'.$total_non_gaji.'"'; echo ' , ';
    echo '"jumlahSPMLainnya":"'.$total_lainnya.'"'; echo ' , ';
    echo '"jumlahSPMVoid":"'.$total_void.'"'; echo ' , ';

    echo '"volumeSPMGaji":"'.round($total_vol_gaji/1000000000).'"'; echo ' , ';
    echo '"volumeSPMNonGaji":"'.round($total_vol_non_gaji/1000000000).'"'; echo ' , ';

    echo '"jumlahLHPCompleted":"'.$total_lhp_completed.'"'; echo ' , ';
    echo '"jumlahLHPValidated":"'.$total_lhp_validated.'"'; echo ' , ';
    echo '"jumlahLHPError":"'.$total_lhp_error.'"'; echo ' , ';
    echo '"jumlahLHPLainnya":"'.$total_lhp_etc.'"'; echo ' , ';
    
    echo '"jumlahReturSudahProses":"'.$total_retur_sudah_proses.'"'; echo ' , ';
    echo '"jumlahReturBelumProses":"'.$total_retur_belum_proses.'"';
    
} else {
    
    $total_gaji = 0;
    $total_non_gaji = 0;
    $total_lainnya = 0;
    $total_void = 0;

    $total_vol_gaji = 0;
    $total_vol_non_gaji = 0;

    $total_lhp_completed = 0;
    $total_lhp_validated = 0;
    $total_lhp_error = 0;
    $total_lhp_etc = 0;

    foreach ($this->data_sp2d_rekap as $sp2d_rekap_harian) {
        $total_gaji += $sp2d_rekap_harian->get_gaji();
        $total_non_gaji += $sp2d_rekap_harian->get_non_gaji();
        $total_void += $sp2d_rekap_harian->get_void();
        $total_lainnya += $sp2d_rekap_harian->get_lainnya();

        $total_vol_gaji += $sp2d_rekap_harian->get_vol_gaji();
        $total_vol_non_gaji += $sp2d_rekap_harian->get_vol_non_gaji();
    }

    foreach ($this->data_lhp_rekap as $lhp_rekap_harian) {
        $total_lhp_completed += $lhp_rekap_harian->get_lhp_completed();
        $total_lhp_validated += $lhp_rekap_harian->get_lhp_validated();
        $total_lhp_error += $lhp_rekap_harian->get_lhp_error();
        $total_lhp_etc += $lhp_rekap_harian->get_lhp_etc();
    }
    
    echo '"jumlahSPMGaji":"'.$total_gaji.'"'; echo ' , ';
    echo '"jumlahSPMNonGaji":"'.$total_non_gaji.'"'; echo ' , ';
    echo '"jumlahSPMLainnya":"'.$total_lainnya.'"'; echo ' , ';
    echo '"jumlahSPMVoid":"'.$total_void.'"'; echo ' , ';

    echo '"volumeSPMGaji":"'.round($total_vol_gaji/1000000000).'"'; echo ' , ';
    echo '"volumeSPMNonGaji":"'.round($total_vol_non_gaji/1000000000).'"'; echo ' , ';

    echo '"jumlahLHPCompleted":"'.$total_lhp_completed.'"'; echo ' , ';
    echo '"jumlahLHPValidated":"'.$total_lhp_validated.'"'; echo ' , ';
    echo '"jumlahLHPError":"'.$total_lhp_error.'"'; echo ' , ';
    echo '"jumlahLHPLainnya":"'.$total_lhp_etc.'"'; echo ' , ';
    
    echo '"spmDalamProses": [';

    $pos_count = 0;

    foreach ($this->data_pos_spm as $value) {
        if ($pos_count > 0) {
            echo ' , ';
        }
        echo '{';
        echo '"nomorSPM":"'.$value->get_invoice_num().'" , "userSPM":"'.$value->get_to_user().' ('.$value->get_fu_description() .')" , "mulaiSPM":"'.$value->get_begin_date().' '.$value->get_time_begin_date().'"';
        echo '}';
        $pos_count++;
    }

    echo '] , ';

    echo '"sp2dSelesai": [';

    $pos_count_com = 0;

    foreach ($this->data_list_sp2d as $value) {
        if ($pos_count_com > 0) {
            echo ' , ';
        }
        echo '{';
        echo '"nomorSP2D":"'.$value->get_check_number().'" , "jenisSP2D":"'.$value->get_jenis_sp2d().'" , "nominalSP2D":"'.$value->get_nominal_sp2d().'"';
        echo '}';
        $pos_count_com++;
    }

    echo '] , ';
    
    echo '"jumlahReturSudahProses":"'.$this->data_retur->get_retur_sudah_proses().'"'; echo ' , ';
    echo '"jumlahReturBelumProses":"'.$this->data_retur->get_retur_belum_proses().'"'; echo ' , ';
    echo '"tanggalLHPTerakhir":"'.$this->data_lhp_rekap[0]->get_tgl_lhp().'"'; echo ' , ';

    echo '"jumlahSPMOngoing":"'.$pos_count.'"';
    
}

echo '}';

?>