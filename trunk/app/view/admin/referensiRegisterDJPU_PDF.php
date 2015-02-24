<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : monitoringSp2d_PDF.php
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
	 private $nm_kppn2;
	  private $nm_kppn3;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(),$nm_kppn,$nm_kppn2,$nm_kppn3) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		 $this->nm_kppn = $nm_kppn;
		 $this->nm_kppn2 = $nm_kppn2;
		  $this->nm_kppn3 = $nm_kppn3;
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
		 
        
		$this->HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1);
        //-----------------------------------
        //----------------------------------------------- 

        #pengaturan khusus
		$border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 6);
		$ukuran_kolom1 = 30;
        $ukuran_kolom2 = 50;
		$ukuran_kolom3 = 50;
        $ukuran_kolom4 = 60;
		$ukuran_kolom5 = 60;
		$ukuran_kolom6 = 40;
        $ukuran_kolom7 = 60;
        $ukuran_kolom8 = 60;
        $ukuran_kolom9 = 50;
		$ukuran_kolom10 = 60;
		$ukuran_kolom11 = 60;
		$ukuran_kolom12 = 60;
		$ukuran_kolom13 = 50;
        $ukuran_kolom14 = 50;
        $ukuran_kolom15 = 50;
        $ukuran_kolom16 = 50;
        $ukuran_kolom17 = 50;
		
		$kolom_grandtotal1=$ukuran_kolom1+ukuran_kolom2+
		$ukuran_kolom3+$ukuran_kolom4+
		$ukuran_kolom5+$ukuran_kolom6+
		$ukuran_kolom7+$ukuran_kolom8+
		$ukuran_kolom9;
		
		

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($ukuran_kolom1, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom1);
        $this->Cell($ukuran_kolom2, $h, 'Status di SPAN', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom2);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom3, $h, 'REG_NO', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom3);
        $this->Cell($ukuran_kolom4, $h, 'NAME', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom4);
        $this->Cell($ukuran_kolom5, $h, 'CRED_NAME', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom5);
        $this->Cell($ukuran_kolom6, $h, 'CURR', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom6);
        $this->Cell($ukuran_kolom7, $h, 'COUNTRY', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom7);
        $this->Cell($ukuran_kolom8, $h, 'CRED_TYPE', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom8);
		 $this->Cell($ukuran_kolom9, $h, 'CARA_TARIK', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom9);
        $this->Cell($ukuran_kolom10, $h, 'AMT_ORI', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom10);
        $this->Cell($ukuran_kolom11, $h, 'AMT_AMEND', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom11);
        $this->Cell($ukuran_kolom12, $h, 'AMT_NET', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom12);
        $this->Cell($ukuran_kolom13, $h, 'BENEF', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom13);
		$this->Cell($ukuran_kolom14, $h, 'STATUS', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom14);
        $this->Cell($ukuran_kolom15, $h, 'D_SIGNED', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom15);
        $this->Cell($ukuran_kolom16, $h, 'D_EFFECTIVE', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom16);
        $this->Cell($ukuran_kolom17, $h, 'D_DRAWLIM', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom17);
        $this->Ln(3);

        $this->SetFont('Arial', '', 5);
        $this->SetWidths(array(
            $ukuran_kolom1, $ukuran_kolom2,
            $ukuran_kolom3, $ukuran_kolom4,
            $ukuran_kolom5, $ukuran_kolom6,
            $ukuran_kolom7, $ukuran_kolom8,
			$ukuran_kolom9,$ukuran_kolom10, 
		   $ukuran_kolom11,
            $ukuran_kolom12, $ukuran_kolom13,
            $ukuran_kolom14, $ukuran_kolom15,
            $ukuran_kolom16, $ukuran_kolom17
        ));
        $this->SetAligns(array(
		'C', 'C',
		'C', 'C',
		'L', 'L',
		'C', 'L',
		'C', 'R',
		'R', 'R',
		'L', 'C',
		'C', 'C', 
		'C'
		));
        
		if (count($this->data) == 0) {
			$this->Row(
                    array(
					'','N I H I L',
					'','',
					'','',
					'','',
					'','',
					'','',
					'','',
					'','',
					''
                    )
            );
		}else{
			$no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
            $this->Row(
                    array($no++,
                        $value->get_status_span(),
						$value->get_reg_no(),
                        $value->get_name(),
						$value->get_cred_name(),
                        $value->get_curr(),
                        $value->get_country(),
                        $value->get_cred_type(),
                        $value->get_cara_tarik(),
						number_format($value->get_amt_ori()),
						number_format($value->get_amt_amend()),
						 number_format($value->get_amt_net()),
						 $value->get_benef(),
                        $value->get_status(),
						$value->get_d_signed(),
                        $value->get_d_effective(),
                        $value->get_d_drawlim()
                    )
            );
			$tot1 = $tot1 + $value->get_amt_ori();
			$tot2 = $tot2 + $value->get_amt_amend();
			$tot3 = $tot3 + $value->get_amt_net();			
        }
				$this->SetFont('Arial', 'B', 5);
				$h = 20;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$this->Cell($kolom_grandtotal1, $h, 'GRAND TOTAL', 1, 0, 'L', true);
				$this->SetX($left += $kolom_grandtotal1);
				$this->Cell($ukuran_kolom10, $h, number_format($tot1), 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom10);
				$this->Cell($ukuran_kolom11, $h, number_format($tot2), 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom11);
				$this->Cell($ukuran_kolom12, $h, number_format($tot3), 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom12);
				
				$this->Cell($ukuran_kolom13, $h, '', 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom13);
				$this->Cell($ukuran_kolom14, $h, '', 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom14);
				$this->Cell($ukuran_kolom15, $h, '', 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom15);
				$this->Cell($ukuran_kolom16, $h, '', 1, 0, 'L', true);
				$this->SetX($left += $ukuran_kolom16);
				
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom17, $h,'', 1, 1, 'R', true);
				$this->Ln(3);

		}
        $this->Ln(3);
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



$nm_kppn = $this->nm_kppn;
$nm_kppn2 = $this->nm_kppn2;
 $nm_kppn3 = $this->nm_kppn3;

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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir,$nm_kppn,$nm_kppn2,$nm_kppn3);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>







