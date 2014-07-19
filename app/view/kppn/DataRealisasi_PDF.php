<?php
	//----------------------------------------------------
	//Development history
	//Revisi : 0
	//Kegiatan :1.mencetak hasil filter ke dalam pdf
	//File yang ditambah : \spanint\app\view\kppn\DataRealisasi_PDF.php
	//Dibuat oleh : Rifan Abdul Rachman
	//Tanggal dibuat : 18-07-2014
	//----------------------------------------------------

 ob_start();
//-------------------------------------
    require_once("./././public/fpdf17/fpdf.php");
     
    class FPDF_AutoWrapTable extends FPDF {
    private $data = array();
    private $options = array(
    'filename' => '',
    'destinationfile' => '',
    'paper_size'=>'F4',
    'orientation'=>'L'
    );
     
    function __construct($data = array(), $options = array()) {
    parent::__construct();
    $this->data = $data;
    $this->options = $options;
    }
     
    public function rptDetailData () {
    //
    $border = 0;
    $this->AddPage();
    $this->SetAutoPageBreak(true,30);
    $this->AliasNbPages();
    $left = 25;
     
    //header
    $this->SetFont("", "B", 12);
    $this->MultiCell(0, 12, 'Aplikasi Online Monitoring SPAN');
    $this->Cell(0, 1, " ", "B");
    $this->Ln(10);
    $this->SetFont("", "B", 8);
    $this->SetX($left); $this->Cell(0, 10, 'Laporan Detail Realisasi Belanja Per Satker', 0, 1,'C');
    $this->Ln(10);
     
    $h = 40;
    $left = 10;
    $top = 80;	
    #tableheader
    $this->SetFont('Arial','B',6);

    $this->SetFillColor(200,200,200);	
    $left = $this->GetX();
    $this->Cell(20,$h,'No',1,0,'L',true);
    $this->SetX($left += 20); $this->Cell(40, $h, 'Satker', 1, 0, 'C',true);
     $this->SetX($left += 40); $this->Cell(70, $h, 'Nama Satker', 1, 0, 'C',true);  
	$this->SetX($left += 70); $this->Cell(70, $h, 'Pagu', 1, 0, 'C',true);
	$px1 = $this->GetX();
	$this->SetX($left += 70); $this->Cell(630, $h/2, 'Jenis Belanja', 1, 0, 'C',true);
	$py1 = $this->GetY();
	$px2 = $px1;
	$py2 = $py1+20;
	$this->SetXY($px2,$py2);
	$this->Cell(70, $h/2, 'Pegawai', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Barang', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Modal', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Beban Bunga', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Subsidi', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Hibah', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Bansos', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Lain-lain', 1, 0, 'C',true);
	$this->SetX($px2 += 70);
	$this->Cell(70, $h/2, 'Total', 1, 0, 'C',true);
	$py3 = $this->GetY();
	$this->SetY($py3 -= 20);
    $this->SetX($left += 630); $this->Cell(70, $h, 'Sisa Pagu', 1, 1, 'C',true);
$this->Ln(3);  
    $this->SetFont('Arial','',7);
    $this->SetWidths(array(20,40,70,70,70,70,70,70,70,70,70,70,70,70));
    $this->SetAligns(array('C','c','L','R','R','R','R','R','R','R','R','R','R','R','R'));
    $no = 1; $this->SetFillColor(255);
    foreach ($this->data as $value) {
	$this->Row(
    array($no++,
	$value->get_satker(),
	$value->get_dipa(),
	number_format($value->get_Pagu()),
	number_format($value->get_belanja_51()),
	number_format($value->get_belanja_52()),
	number_format($value->get_belanja_53()),
	number_format($value->get_belanja_54()),
	number_format($value->get_belanja_55()),
	number_format($value->get_belanja_56()),
	number_format($value->get_belanja_57()),
	number_format($value->get_belanja_58()),
	number_format($value->get_belanja_51()+$value->get_belanja_52()+$value->get_belanja_53()+$value->get_belanja_54()
					+$value->get_belanja_55()+$value->get_belanja_56()+$value->get_belanja_57()+$value->get_belanja_58()),
	number_format($value->get_pagu()-($value->get_belanja_51()+$value->get_belanja_52()+$value->get_belanja_53()+$value->get_belanja_54()
					+$value->get_belanja_55()+$value->get_belanja_56()+$value->get_belanja_57()+$value->get_belanja_58()))
	
	));
	  
    }
     
    }
     
    public function printPDF () {
     
    if ($this->options['paper_size'] == "F4") {
    $a = 8.3 * 72; //1 inch = 72 pt
    $b = 13.0 * 72;
    $this->FPDF($this->options['orientation'], "pt", array($a,$b));
    } else {
    $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
    }
     
    $this->SetAutoPageBreak(true,30);
    $this->AliasNbPages();
    $this->SetFont("helvetica", "B", 10);
    //$this->AddPage(); //coba
     
    $this->rptDetailData();
     
    $this->Output($this->options['filename'],$this->options['destinationfile']);
    }
     
    private $widths;
    private $aligns;
     
    function SetWidths($w)
    {
    //Set the array of column widths
    $this->widths=$w;
    }
     
    function SetAligns($a)
    {
    //Set the array of column alignments
    $this->aligns=$a;
    }
     
    function Row($data)
    {
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
    $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=10*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
    $w=$this->widths[$i];
    $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
    //Save the current position
    $x=$this->GetX();
    $y=$this->GetY();
    //Draw the border
    $this->Rect($x,$y,$w,$h);
    //Print the text
    $this->MultiCell($w,10,$data[$i],0,$a);
    //Put the position to the right of the cell
    $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
    }
     
    function CheckPageBreak($h)
    {
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
    $this->AddPage($this->CurOrientation);
    }
     
    function NbLines($w,$txt)
    {
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
    $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
    $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
    $c=$s[$i];
    if($c=="\n")
    {
    $i++;
    $sep=-1;
    $j=$i;
    $l=0;
    $nl++;
    continue;
    }
    if($c==' ')
    $sep=$i;
    $l+=$cw[$c];
    if($l>$wmax)
    {
    if($sep==-1)
    {
    if($i==$j)
    $i++;
    }
    else
    $i=$sep+1;
    $sep=-1;
    $j=$i;
    $l=0;
    $nl++;
    }
    else
    $i++;
    }
    return $nl;
    }
    } //end of class
     /*
        #koneksi ke database (disederhanakan)
    mysql_connect ("localhost", "root", "");
    mysql_select_db ("demo");
 
    #ambil data dari DB dan masukkan ke array
      $data = array();
   $query = "SELECT nip, nama, alamat, email, website FROM pegawai ORDER BY nama";
    $sql = mysql_query ($query);
    while ($row = mysql_fetch_assoc($sql)) {
    array_push($data, $row);
    } */
//-----------------------

//echo $this->data;
if (is_array($this->data))
{
    
    $data=$this->data;

}else{
echo 'bukan array';
}
 

//--------------------------
 //Laporan_Detail_Realisasi_Belanja_Per_Satker
    //pilihan
    $options = array(
    'filename' => 'Laporan_Detail_Realisasi_Belanja_Per_Satker.PDF', //nama file penyimpanan, kosongkan jika output ke browser
    'destinationfile' => 'D', //I=inline browser (default), F=local file, D=download
    'paper_size'=>'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
    'orientation'=>'L' //orientation: P=portrait, L=landscape
    );
     
    $tabel = new FPDF_AutoWrapTable($data, $options);
   $tabel->printPDF();


//-------------------------------------


  ob_flush();

?>




