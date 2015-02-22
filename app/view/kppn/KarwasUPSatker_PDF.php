<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : DataRealisasiBA_PDF.php
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
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
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
		$ukuran_kolom0 = 20;
        $ukuran_kolom1 = 40;
		$ukuran_kolom2 = 100;
		$ukuran_kolom3 = 50;
		$ukuran_kolom4 = 70;
		$ukuran_kolom5 = 70;
		$ukuran_kolom6 = 70;
		$ukuran_kolom7 = 50;
		$ukuran_kolom8 = 60;
		
        $ukuran_kolom_pagu_total = 70;
        $ukuran_kolom_jenis_belanja = 70;
        $ukuran_kolom_1a = 70;
        $ukuran_kolom_2a = 70;
        $ukuran_kolom_a = $ukuran_kolom_1a + $ukuran_kolom_2a;
        $ukuran_kolom_1b = 70;
        $ukuran_kolom_2b = 70;
        $ukuran_kolom_b = $ukuran_kolom_1b + $ukuran_kolom_2b;
		$ukuran_kolom_1c = 70;
        $ukuran_kolom_2c = 70;
        $ukuran_kolom_c = $ukuran_kolom_1c + $ukuran_kolom_2c;
		
		$kolom_grandtotal1=$ukuran_kolom0+$ukuran_kolom1+$ukuran_kolom2+$ukuran_kolom3;
		
		$kolom_grandtotal2=$ukuran_kolom_2a;
		$kolom_grandtotal3=$ukuran_kolom_1b+$ukuran_kolom_2b;
		$kolom_grandtotal3a=$ukuran_kolom_1c+$ukuran_kolom_2c;
		$kolom_grandtotal4=$ukuran_kolom_pagu_total;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($ukuran_kolom0, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += $ukuran_kolom0);
        $this->Cell($ukuran_kolom1, $h, 'Kode Satker', 1, 0, 'C', true);
		        $this->SetX($left += $ukuran_kolom1);
        $this->Cell($ukuran_kolom2, $h, 'Nama Satker', 1, 0, 'C', true);
		        $this->SetX($left += $ukuran_kolom2);
        $this->Cell($ukuran_kolom3, $h, 'Sumber Dana', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom3);
        $this->Cell($ukuran_kolom_a, $h / 2, 'Total UP', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + $ukuran_kolom0;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_1a, $h / 2, 'Total UP', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1a);
        $this->Cell($ukuran_kolom_2a, $h / 2, 'Tgl UP Terakhir', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2a);
		
        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_a);
        $this->Cell($ukuran_kolom_b, $h / 2, 'Pengurang UP', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1 + $ukuran_kolom_a;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);

        $this->Cell($ukuran_kolom_1b, $h / 2, 'Total GU Nihil', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_1b);

        $this->Cell($ukuran_kolom_2b, $h / 2, 'Setoran UP', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_2b);


        $py3 = $this->GetY();
        $this->SetY($py3 -= 20);
        $this->SetX($left += $ukuran_kolom_b);
		$this->Cell($ukuran_kolom4, $h, 'Sisa UP', 1, 0, 'C', true);
		$this->SetX($left += $ukuran_kolom4);
		$this->Cell($ukuran_kolom5, $h, 'Tgl SP2D GUP Terakhir', 1, 0, 'C', true);
		$this->SetX($left += $ukuran_kolom5);
		
        $this->Cell($ukuran_kolom_c, $h / 2, 'Total SP2D GUP Terakhir', 1, 0, 'C', true);
        $py4 = $this->GetY();
        //$px5 = $px2 + $ukuran_kolom_b+$ukuran_kolom5;
        $px5 = $px2 + $ukuran_kolom_b;
        $py5 = $py4 + 20;
		
        $this->SetXY($px5, $py5);
		$this->SetY($py5);
		$this->SetX($px5);
        $this->Cell($ukuran_kolom_1c, $h / 2, 'Total GUP', 1, 0, 'C', true);
        $this->SetX($px5 += $ukuran_kolom_1c);
        $this->Cell($ukuran_kolom_2c, $h / 2, 'Persentase Dari UP', 1, 0, 'C', true);
        $this->SetX($px5 += $ukuran_kolom_2c);
        $py6 = $this->GetY();
        $this->SetY($py6 -= 20);
        $this->SetX($left += $ukuran_kolom_c);
		$this->Cell($ukuran_kolom7, $h, 'Batas Teguran', 1, 0, 'C', true);
		$this->SetX($left += $ukuran_kolom7);
		
        $this->Cell($ukuran_kolom8, $h, 'Keterangan', 1, 1, 'C', true);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($ukuran_kolom0,$ukuran_kolom1,
		$ukuran_kolom2,$ukuran_kolom3,
		$ukuran_kolom_1a,$ukuran_kolom_2a,
		$ukuran_kolom_1b,$ukuran_kolom_2b,
		$ukuran_kolom4,$ukuran_kolom5,
		$ukuran_kolom_1c,$ukuran_kolom_2c,
		$ukuran_kolom7,$ukuran_kolom8
        ));
        $this->SetAligns(array('C', 'C',
		'L', 'C',
		'R', 'C',
		'R', 'R',
		'R', 'C',
		'R', 'C',
		'R', 'C',
		 'C'));
        
		if (count($this->data) == 0) {
		 $this->Row(
             array('','N I H I L',
                        '','',
                        '','',
                        '','',
						'','',
						'','',
                        '','',
                        ''
            ));
		
		}else{
			$no = 1;
			$this->SetFillColor(255);
			foreach ($this->data as $value) {
			if	($value->get_output_code() == 0){
								$nil2='0.00%';
							}else{
								$nil2a=number_format($value->get_output_code()/$value->get_check_num()*100,2);
								$nil2=$nil2a.'%';
							}
				$this->Row(
						array($no++,
							$value->get_satker_code(),
							$value->get_nmsatker(),
							$value->get_jendok(),
							number_format($value->get_amount()),
							$value->get_invoice_date(),
							number_format($value->get_line_amount()*-1),
							number_format($value->get_ntpn()),
							number_format($value->get_check_num()),
							$value->get_tanggal_sp2d(),
							number_format($value->get_output_code()),
							$nil2,
							$value->get_tanggal(),
							strtoupper($value->get_description())
				));
				$tot1 = $tot1 + $value->get_amount();	
				$tot2 = $tot2 + $value->get_line_amount();
				$tot3 = $tot3 + $value->get_ntpn();
				$tot4 = $tot4 + $value->get_check_num();
				$tot5 = $tot5 + $value->get_output_code();
				
				
			}
			$this->SetFont('Arial', 'B', 7);
				$h = 20;
				$this->SetFillColor(200, 200, 200);
				$left = $this->GetX();
				$this->Cell($kolom_grandtotal1, $h, 'GRAND TOTAL', 1, 0, 'L', true);
				$this->SetX($left += $kolom_grandtotal1);
				$px1 = $this->GetX();
				$py1 = $this->GetY();
				$px2 = $px1;
				$py2 = $py1;
				$this->SetXY($px2, $py2);
				$py3 = $this->GetY();
				$this->Cell($ukuran_kolom_1a, $h, number_format($tot1), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1a);
				$this->Cell($kolom_grandtotal2, $h,'', 1, 0, 'L', true);
				$this->SetX($px2 += $kolom_grandtotal2);
				$this->Cell($ukuran_kolom_1b, $h, number_format($tot2), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1b);
				$this->Cell($ukuran_kolom_2b, $h, number_format($tot3), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2b);
				$this->Cell($ukuran_kolom4, $h, number_format($tot4), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom4);
				$this->Cell($ukuran_kolom5, $h, '', 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom5);
				$this->Cell($ukuran_kolom_1c, $h, number_format($tot5), 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_1c);
				$this->Cell($ukuran_kolom_2c, $h, '', 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom_2c);
				$this->Cell($ukuran_kolom7, $h, '', 1, 0, 'R', true);
				$this->SetX($px2 += $ukuran_kolom7);
				$this->Cell($ukuran_kolom8, $h,'', 1, 1, 'R', true);
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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>






