<?php

/* //----------------------------------------------------
  //Development history
  //Revisi : 0
  //Kegiatan :1.mencetak hasil filter ke dalam pdf
  //File yang ditambah : detail_fund_fail_kd_PDF.php
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
    

        
        //----------------------------------------------- 
        #pengaturan khusus
		 $border = 0;
        $h = 40;
        $this->SetFont('Arial', 'B', 9);
        $ukuran_kolom_pagu_total_sisa = 86;
        $ukuran_kolom_jenis_belanja = 65;
		$ukuran_kolom_jenis_belanja1 = 80;
		$kolom1=100;
		$kolom2=120;
		$jumlahkolom=20+$kolom1+$kolom2+$ukuran_kolom_jenis_belanja*2+$ukuran_kolom_jenis_belanja1;

        $this->SetFillColor(200, 200, 200);
        $left = $this->GetX();
        $this->Cell(20, $h, 'No', 1, 0, 'C', true);
        $this->SetX($left += 20);
        $this->Cell($kolom1, $h, 'Sumber Transaksi', 1, 0, 'C', true);
        $px1 = $this->GetX();
        $this->SetX($left += $kolom1);
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->Cell($kolom2, $h, 'Nama wajib Bayar setor', 1, 0, 'C', true);
        $this->SetX($px2 += $kolom2);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Tanggal Buku', 1, 0, 'C', true);
		$this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja, $h, 'Tanggal Bayar', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja);
        $this->Cell($ukuran_kolom_jenis_belanja1, $h, 'NTPN/SP2D', 1, 0, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_jenis_belanja1);
        $this->Cell($ukuran_kolom_pagu_total_sisa, $h, 'Rupiah', 1, 1, 'C', true);
        $this->SetX($px2 += $ukuran_kolom_pagu_total_sisa);
        $this->Ln(3);

        $this->SetFont('Arial', '', 7);
        $this->SetWidths(array(20, 
		$kolom1,$kolom2,
		$ukuran_kolom_jenis_belanja, $ukuran_kolom_jenis_belanja,
		$ukuran_kolom_jenis_belanja1,$ukuran_kolom_pagu_total_sisa));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'R'));
        if (count($this->data) == 0) {
            $this->Row(
                    array('',
                        'N I H I L',
                        '',
                        '',
                        '',
                        '',
                        ''
            ));
        } else {
            $no = 1;
            $this->SetFillColor(255);
            foreach ($this->data as $value) {
                $this->Row(
                        array($no++,
                            $value->get_keterangan(),
                            $value->get_nama_wajib_bayar_setor(),
                            $value->get_tanggal_buku(),
                            $value->get_tanggal_bayar(),
                            $value->get_ntpn(),
							number_format($value->get_rupiah())
                ));
                //jumlah grand total
				$tot_pot = $tot_pot + $value->get_rupiah();
            }
            $this->SetFont('Arial', 'B', 7);
            $h = 20;
            $this->SetFillColor(200, 200, 200);
            $left = $this->GetX();
            $this->Cell($jumlahkolom, $h, 'GRAND TOTAL', 1, 0, 'L', true);
            $this->SetX($left += $jumlahkolom);
			
            $px1 = $this->GetX();
            $py1 = $this->GetY();
            $px2 = $px1;
            $py2 = $py1;
            $this->SetXY($px2, $py2);
            $this->Cell($ukuran_kolom_pagu_total_sisa, $h, number_format($tot_pot), 1, 1, 'R', true);
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




//--------------------------
//pilihan
 $kd_akun = $this->kd_akun;
 $nm_bulan = $this->nm_bulan;
 //judul laporan
$judul1= $this->judul1;$nm_kppn = $this->nm_kppn;
$judul = 'Laporan '.$judul1.' '.$kd_akun.'_'.$nm_bulan; //judul file laporan

$tipefile = '.pdf';
$nmfile = $judul . $tipefile; //nama file penyimpanan, kosongkan jika output ke browser

$options = array(
    'judul' => $judul, //judul file laporan
    'filename' => $nmfile, //nama file penyimpanan, kosongkan jika output ke browser   
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size' => 'A4', //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation' => 'P' //orientation: P=portrait, L=landscape
);
$tabel = new FPDF_AutoWrapTable($data, $options, $kdtgl_awal, $kdtgl_akhir, $nm_kppn);
$tabel->printPDF();
//-------------------------------------
ob_flush();
?>




