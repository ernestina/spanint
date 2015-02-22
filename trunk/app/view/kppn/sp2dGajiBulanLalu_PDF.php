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
require_once("./././public/fpdf17/fpdf.php");require_once("./././public/fpdf17/rotation.php");

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
	private $kdtahun;
	
    /*
     * Konstruktor
     */

    function __construct($data = array(), $options = array(), $kdtgl_awal = array(), $kdtgl_akhir = array(), $nm_kppn,$kdtahun) {
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
        $this->kdtgl_awal = $kdtgl_awal;
        $this->kdtgl_akhir = $kdtgl_akhir;
        $this->nm_kppn = $nm_kppn;
		$this->kdtahun = $kdtahun;
		
		
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
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa = 80;
        $ukuran_kolom_jenis_belanja = 60;
		$kolom1=20;
		
		$totalheader=$ukuran_kolom_jenis_belanja*13;
		$kolom_grandtotal=$kolom1+$ukuran_kolom_pagu_total_sisa;
        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell($kolom1, $h, 'No', 1, 0, 'C', true);

        $this->SetX($left += $kolom1);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Bank', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $ukuran_kolom_pagu_total_sisa);
        $this->Cell($totalheader, $h / 2, 'Jumlah SP2D', 1, 0, 'C', true);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1 + 20;
        $this->SetXY($px2, $py2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Des '.$kdtahun, 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Jan', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Feb', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Mar', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Apr', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Mei', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Jun', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Jul', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Ags', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Sep', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Okt', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
		$this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Nov', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h / 2, 'Des', 1, 1, 'C', true);
        $py3 = $this->GetY();
        $this->SetX($left += 660);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array($kolom1,$ukuran_kolom_pagu_total_sisa,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja, 
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja,$ukuran_kolom_jenis_belanja));
        $this->SetAligns(array('C', 'L', 
		'R', 'R', 
		'R', 'R',
		'R', 'R',
		'R', 'R', 
		'R', 'R', 
		'R', 'R', 
		'R'));
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
                        ''
            ));
        } else {
			$jan = 0;
			$feb = 0;
			$mar = 0;
			$apr = 0;
			$mei = 0;
			$jun = 0;
			$jul = 0;
			$ags = 0;
			$sep = 0;
			$okt = 0;
			$nop = 0;
			$des = 0;
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
				//filter bank
				if(is_null($value->get_payment_date())){
					$fb='0';
				}else{
					$fb=$value->get_payment_date();
				}
				//filter 1
				if(is_null($value->get_return_desc())){
					$f1='0';
				}else{
					$f1=$value->get_return_desc();
				}
				//filter 2
				if(is_null($value->get_invoice_num())){
					$f2='0';
				}else{
					$f2=$value->get_invoice_num();
				}
				
				//filter 3
				if(is_null($value->get_check_date())){
					$f3='0';
				}else{
					$f3=$value->get_check_date();
				}
				
				//filter 4
				if(is_null($value->get_creation_date())){
					$f4='0';
				}else{
					$f4=$value->get_creation_date();
				}
				//filter 5
				if(is_null($value->get_check_number())){
					$f5='0';
				}else{
					$f5=$value->get_check_number();
				}
				
				//filter 6
				if(is_null($value->get_check_number_line_num())){
					$f6='0';
				}else{
					$f6=$value->get_check_number_line_num();
				}
				
				//filter 7
				if(is_null($value->get_check_amount())){
					$f7='0';
				}else{
					$f7=$value->get_check_amount();
				}
				//filter 8
				if(is_null($value->get_bank_account_name())){
					$f8='0';
				}else{
					$f8=$value->get_bank_account_name();
				}
				
				//filter 9
				if(is_null($value->get_bank_name())){
					$f9='0';
				}else{
					$f9=$value->get_bank_name();
				}
				
				//filter 10
				if(is_null($value->get_vendor_ext_bank_account_num())){
					$f10='0';
				}else{
					$f10=$value->get_vendor_ext_bank_account_num();
				}
				//filter 11
				if(is_null($value->get_vendor_name())){
					$f11='0';
				}else{
					$f11=$value->get_vendor_name();
				}
				
				//filter 12
				if(is_null($value->get_invoice_description())){
					$f12='0';
				}else{
					$f12=$value->get_invoice_description();
				}
				
				//filter 13
				if(is_null($value->get_ftp_file_name())){
					$f13='0';
				}else{
					$f13=$value->get_ftp_file_name();
				}
				
			
                $this->Row(
                        array($no++,
                            $fb,
							$f1,
                            $f2,
                            $f3,
							$f4,
                            $f5,
                            $f6,
							$f7,
                            $f8,
                            $f9,
							$f10,
                            $f11,
                            $f12,
							$f13
                ));
                //jumlah grand total
						$des1+=$value->get_return_desc();
						$jan+=$value->get_invoice_num();
                        $feb+=$value->get_check_date();
                        $mar+=$value->get_creation_date();
                        $apr+=$value->get_check_number();
                        $mei+=$value->get_check_number_line_num();
                        $jun+=$value->get_check_amount();
                        $jul+=$value->get_bank_account_name();
                        $ags+=$value->get_bank_name();
                        $sep+=$value->get_vendor_ext_bank_account_num();
                        $okt+=$value->get_vendor_name();
                        $nop+=$value->get_invoice_description();
                        $des+=$value->get_ftp_file_name();
            }
            $this->SetFont('Arial', 'B', 7);
            $h = 20;
            $this->SetFillColor(200, 200, 200);
            $left = $this->GetX();
            $this->Cell($kolom_grandtotal, $h, 'GRAND TOTAL', 1, 0, 'L', true);
            $this->SetX($left += $kolom_grandtotal);
            $px1 = $this->GetX();
            $py1 = $this->GetY();
            $px2 = $px1;
            $py2 = $py1;
            $this->SetXY($px2, $py2);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $des1, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $jan, 1, 0, 'R', true);
			 $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $feb, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $mar, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $apr, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $mei, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $jun, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $jul, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $ags, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $sep, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $okt, 1, 0, 'R', true);
            $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $nop, 1, 0, 'R', true);
			$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
            $this->Cell($ukuran_kolom_jenis_belanja, $h, $des, 1, 1, 'R', true);
            
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


$kdtahun= $this->kdtahun;
//echo 'kdtahun:'.$kdtahun;

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
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn,$kdtahun);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




