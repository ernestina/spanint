<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : GR_IJP_PDF.php
  //Dibuat oleh : Rifan Abdul Rachman
  //Tanggal dibuat : 18-07-2014
  //----------------------------------------------------
 */
ob_start();
//-------------------------------------
require_once("./././public/fpdf17/fpdf.php");
require_once("./././public/fpdf17/rotation.php");

class FPDF_AutoWrapTable extends PDF_Rotate {

    private $data = array();
    protected $options = array(
        'judul' => '',
        'filename' => '',
        'destinationfile' => '',
        'paper_size' => '',
        'orientation' => ''
    );
    private $kdtgl_awal = array();
    private $kdtgl_akhir = array();
    private $nm_kppn;
	private $nm_kppn4;
	private $kd_bulan;
		

    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn, $nm_kppn4,$kd_bulan) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
		$this->nm_kppn4 = $nm_kppn4;
        $this->nm_kppn = $nm_kppn;
		$this->kd_bulan= $kd_bulan;
    }

    /*
     * Index
     */

    public function rptDetailData() {
        //-----------------------------------
		//------------------------------
		$judul=$this->options['judul'];
		$nm_kppn = $this->nm_kppn;
		$nm_kppn2 = $this->nm_kppn2;
		$nm_kppn3 = $this->nm_kppn3;
		$kdtgl_awal1 = $this->kdtgl_awal;
		$kdtgl_akhir1 = $this->kdtgl_akhir;
		$kdbulan=$this->kd_bulan;
			if ($kdbulan == '01') {
				$bulan = 'Januari';
			}
			if ($kdbulan == '02') {
				$bulan = 'FebruarI';
			}
			if ($kdbulan == '03') {
				$bulan = 'Maret';
			}
			if ($kdbulan == '04') {
				$bulan = 'April';
			}
			if ($kdbulan == '05') {
				$bulan = 'Mei';
			}
			if ($kdbulan == '06') {
				$bulan = 'Juni';
			}
			if ($kdbulan == '07') {
				$bulan = 'Juli';
			}
			if ($kdbulan == '08') {
				$bulan = 'Agustus';
			}
			if ($kdbulan == '09') {
				$bulan = 'September';
			}
			if ($kdbulan == '10') {
				$bulan = 'Oktober';
			}
			if ($kdbulan == '11') {
				$bulan = 'November';
			}
			if ($kdbulan == '12') {
				$bulan = 'Desember';
			} 
			$judul=$judul.' '.$bulan;
        
		$this->HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1);
        //-----------------------------------
         
        
        //----------------------------------------------- 

        #pengaturan khusus
		   $border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa =0;
        $ukuran_kolom_hari = 24;
		$kolom1=40;
		$kolom2=60;
		$kolom3=100;
		$kolom_tgl_lhp=$ukuran_kolom_hari*31;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $kolom1);
        $this->Cell($kolom3, $h, 'KPPN', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom3);
        $this->Cell($kolom_tgl_lhp, $h / 2, 'Tanggal LHP', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_hari, $h / 2, '1', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '2', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '3', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '4', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '5', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '6', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '7', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '8', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '9', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '10', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '11', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '12', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '13', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '14', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '15', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '16', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '17', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '18', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '19', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '20', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '21', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '22', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '23', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '24', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '25', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '26', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '27', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '28', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '29', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '30', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_hari);
        $this->Cell($ukuran_kolom_hari, $h / 2, '31', 1, 0, 'C', true);
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $kolom_tgl_lhp);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h,'', 0, 1, 'C',false);
        
		 $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$kolom3,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari, $ukuran_kolom_hari,
            $ukuran_kolom_hari,$ukuran_kolom_pagu_total_sisa));
        $this->SetAligns(array('C', 'L','C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $no = 1;
        $j1 = 0;
        $j2 = 0;
        $j3 = 0;
        $j4 = 0;
        $j5 = 0;
        $j6 = 0;
        $j7 = 0;
        $j8 = 0;
        $j9 = 0;
        $j10 = 0;
        $j11 = 0;
        $j12 = 0;
        $j13 = 0;
        $j14 = 0;
        $j15 = 0;
        $j16 = 0;
        $j17 = 0;
        $j18 = 0;
        $j19 = 0;
        $j20 = 0;
        $j21 = 0;
        $j22 = 0;
        $j23 = 0;
        $j24 = 0;
        $j25 = 0;
        $j26 = 0;
        $j27 = 0;
        $j28 = 0;
        $j29 = 0;
        $j30 = 0;
        $j31 = 0;
        $jtotal = 0;

        $this->SetFillColor(255);
		if (count($this->data) == 0) {
			 $this->Row(
                    array('',
                        'N I H I L',
                        '',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
                        ''
                    )
            );
		
		}else{
		
		
        foreach ($this->data as $value) {
		 //------------------------------------
			$kdbulan=$value->get_bulan();
			if ($kdbulan == '01') {
				$bulan = 'Januari';
			}
			if ($kdbulan == '02') {
				$bulan = 'FebruarI';
			}
			if ($kdbulan == '03') {
				$bulan = 'Maret';
			}
			if ($kdbulan == '04') {
				$bulan = 'April';
			}
			if ($kdbulan == '05') {
				$bulan = 'Mei';
			}
			if ($kdbulan == '06') {
				$bulan = 'Juni';
			}
			if ($kdbulan == '07') {
				$bulan = 'Juli';
			}
			if ($kdbulan == '08') {
				$bulan = 'Agustus';
			}
			if ($kdbulan == '09') {
				$bulan = 'September';
			}
			if ($kdbulan == '10') {
				$bulan = 'Oktober';
			}
			if ($kdbulan == '11') {
				$bulan = 'November';
			}
			if ($kdbulan == '12') {
				$bulan = 'Desember';
			} 
			
			
							//------------------------------------------
				
				if (isset($this->nm_kppn4)) {
					foreach ($this->nm_kppn4 as $kppn1) {
						if ($value->get_kppn() == $kppn1->get_kd_d_kppn()){
							$nama_kppn = $kppn1->get_nama_user();
						}
						if ($value->get_kppn() == "PNR"){
							$nama_kppn = "PENERIMAAN";
						}
					}
                 }
		
            $this->Row(
                    array($no++,
						$nama_kppn.' ('.$value->get_kppn().')',
                        $value->get_r01(),
                        $value->get_r02(),
                        $value->get_r03(),
                        $value->get_r04(),
                        $value->get_r05(),
                        $value->get_r06(),
                        $value->get_r07(),
                        $value->get_r08(),
                        $value->get_r09(),
                        $value->get_r10(),
                        $value->get_r11(),
                        $value->get_r12(),
                        $value->get_r13(),
                        $value->get_r14(),
                        $value->get_r15(),
                        $value->get_r16(),
                        $value->get_r17(),
                        $value->get_r18(),
                        $value->get_r19(),
                        $value->get_r20(),
                        $value->get_r21(),
                        $value->get_r22(),
                        $value->get_r23(),
                        $value->get_r24(),
                        $value->get_r25(),
                        $value->get_r26(),
                        $value->get_r27(),
                        $value->get_r28(),
                        $value->get_r29(),
                        $value->get_r30(),
                        $value->get_r31()
            ));
            //jumlah grand total
            //-------------
            


            //------------------
        }
        $this->SetFont('Arial', 'B', 7);
        $h = 20;
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
		$this->Ln(3);
		}
    }

    

    

    

    

    

    



    

}

//end of class
//-----------------------
//mengambil array data dari controller
if (is_array($this->data)) {
    $data = $this->data;
} else {
    //echo 'bukan array';
}
//mengambil array tanggal awal dari controller
if (is_array($this->kdtgl_awal)) {
    foreach ($this->kdtgl_awal as $kdtgl_awal) {
        
    }
} else {
    //echo 'bukan array';
}

//mengambil array tanggal akhir dari controller
if (is_array($this->kdtgl_akhir)) {
    foreach ($this->kdtgl_akhir as $kdtgl_akhir) {
        
    }
} else {
    //echo 'bukan array';
}



 if (is_array($this->kppn_list)) {
	//echo 'ini array';
	$nm_kppn4= $this->kppn_list;
	
} else {
    echo 'bukan array';
    //$nm_kppn4 = $this->nm_kppn2;
}
$kd_bulan = $this->d_bulan;
//--------------------------
//pilihan
//judul laporan
$judul1= $this->judul1;$nm_kppn = $this->nm_kppn;
$judul = 'Laporan '.$judul1; //judul file laporan


$tipefile = '.pdf';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'F4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'L' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn4,$kd_bulan);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






