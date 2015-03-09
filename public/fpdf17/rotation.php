<?php

class PDF_Rotate extends FPDF
{
var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
	if($x==-1)
		$x=$this->x;
	if($y==-1)
		$y=$this->y;
	if($this->angle!=0)
		$this->_out('Q');
	$this->angle=$angle;
	if($angle!=0)
	{
		$angle*=M_PI/180;
		$c=cos($angle);
		$s=sin($angle);
		$cx=$x*$this->k;
		$cy=($this->h-$y)*$this->k;
		$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	}
}

function _endpage()
{
	if($this->angle!=0)
	{
		$this->angle=0;
		$this->_out('Q');
	}
	parent::_endpage();
}

	function Header()
	{
		//Put the watermark
		$this->SetFont('Arial','B',80);
		$this->SetTextColor(224,224,224);
		 if ($this->options['orientation'] == "L") {
			//$this->RotatedText(300,300,'OMSPAN',0);
        } else {
			//$this->RotatedText(150,400,'OMSPAN',0);
        }
	}

	function RotatedText($x, $y, $txt, $angle)
	{
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
	function HeaderAtas1($judul,$nm_kppn,$nm_kppn2,$nm_kppn3,$kdtgl_awal1,$kdtgl_akhir1){
 //-----------------------------------
       
		 
		
		$kemenkeu = 'Kementerian Keuangan Republik Indonesia';
		$left=20;
		$h1 = 35;
        $this->SetFont("", "B", 10);
        $this->SetX($left + 20);
        $this->Image("./././public/img/depkeu.png", 30, 30, 30, 30);
        $px1 = $this->GetX();
        $this->SetX($left + 50);
        $this->MultiCell(0, $h1 / 2, strtoupper($kemenkeu));
        $py1 = $this->GetY();
        $px2 = $px1;
        $py2 = $py1;
        $this->SetXY($px2, $py2);
        $this->SetX($left + 50);
 
        if (Session::get('role') == ADMIN  
		|| Session::get('role') == DJA  
		|| Session::get('role') == KANWIL
		|| Session::get('role') == KPPN
		|| Session::get('role') == SATKER
		|| Session::get('role') == BLU
		){
			
			
		
		if (substr(trim($nm_kppn), 0, 4) == 'KPPN') { //3
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 6) == 'KANWIL') { //5
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 3) == 'DIT') {  //1 & 4
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 3) == 'SET') {  //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'ADMIN') { //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'BADAN') { //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'Direktorat') { //6
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        }elseif (substr(trim($nm_kppn), 0, 4) == 'BANK') { //6
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        }elseif (substr(trim($nm_kppn), 0, 5) == 'null') { //6
            $this->MultiCell(0, $h1 / 2, '');
        }elseif (substr(trim($nm_kppn), 0, 5) == '') { //6
            $this->MultiCell(0, $h1 / 2, '');
        } else {
            $this->MultiCell(0, $h1 / 2, 'KPPN ' . $nm_kppn);
        }
			
			
		}elseif(Session::get('role') == KL || Session::get('role') == ES1){
			
			if (substr(trim($nm_kppn), 0, 4) == 'KPPN') { //3
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 6) == 'KANWIL') { //5
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 3) == 'DIT') {  //1 & 4
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 3) == 'SET') {  //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'ADMIN') { //1
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        } elseif (substr(trim($nm_kppn), 0, 5) == 'Direktorat') { //6
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        }elseif (substr(trim($nm_kppn), 0, 4) == 'BANK') { //6
            $this->MultiCell(0, $h1 / 2, $nm_kppn);
        }elseif (substr(trim($nm_kppn), 0, 5) == 'null') { //6
            $this->MultiCell(0, $h1 / 2, '');
        }elseif (substr(trim($nm_kppn), 0, 5) == '') { //6
            $this->MultiCell(0, $h1 / 2, 'DITJEN PERBENDAHARAAN');
        } else {
            $this->MultiCell(0, $h1 / 2, 'KPPN ' . $nm_kppn);
        }
		}
		
		
		


        $this->Cell(0, 1, " ", "B");
        $this->Ln(20);
        $this->Cell(0,0, strtoupper($judul), 0, 0, 'C', false);
        $this->Ln(5);
                //tanggal
		if (Session::get('role') == ADMIN  
		|| Session::get('role') == DJA  
		|| Session::get('role') == KANWIL
		|| Session::get('role') == KPPN
		|| Session::get('role') == SATKER
		|| Session::get('role') == BLU
		){
			if (isset($kdtgl_awal1) && isset($kdtgl_akhir1)) {
				$thn1 = substr($kdtgl_awal1, 6, 4);
				$bln1 = substr($kdtgl_awal1, 3, 2);
				$tgl1 = substr($kdtgl_awal1, 0, 2);
				$kdtgl_awal = $tgl1 . '-' . $bln1 . '-' . $thn1;
				$thn2 = substr($kdtgl_akhir1, 6, 4);
				$bln2 = substr($kdtgl_akhir1, 3, 2);
				$tgl2 = substr($kdtgl_akhir1, 0, 2);
				$kdtgl_akhir = $tgl2 . '-' . $bln2 . '-' . $thn2;
				$this->Cell(0, 20, 'Dari tanggal:' . $kdtgl_awal . ' s/d ' . $kdtgl_akhir, 0, 0, 'C', false);		
			} else {
					//$this->Cell(0, 20, 'Sampai Dengan  ' . date('d-m-Y'), 0, 0, 'C', false);
					$this->Cell(0, 20, '', 0, 0, 'C', false);					
			} 

			
			
		}elseif(Session::get('role') == KL || Session::get('role') == ES1){
			if (isset($kdtgl_awal1) && isset($kdtgl_akhir1)) {
				$thn1 = substr($kdtgl_awal1, 6, 4);
				$bln1 = substr($kdtgl_awal1, 3, 2);
				$tgl1 = substr($kdtgl_awal1, 0, 2);
				$kdtgl_awal = $tgl1 . '-' . $bln1 . '-' . $thn1;
				$thn2 = substr($kdtgl_akhir1, 6, 4);
				$bln2 = substr($kdtgl_akhir1, 3, 2);
				$tgl2 = substr($kdtgl_akhir1, 0, 2);
				$kdtgl_akhir = $tgl2 . '-' . $bln2 . '-' . $thn2;
				$this->Cell(0, 20, '', 0, 0, 'C', false);		
			} else {
					$this->Cell(0, 20, '', 0, 0, 'C', false);			 
			} 
			
		}
 	

		//--------------------

        $this->Ln(20);
         //----------------------------------------------- 
        $this->SetFont('Arial', 'B', 8);

        #pengaturan umum
		if (Session::get('role') == ADMIN  || Session::get('role') == DJA  || Session::get('role') == KANWIL){
			
		}elseif(Session::get('role') == KL){
			$this->Cell(0,0,'KL   : '.trim($nm_kppn2), 0, 0, 'L', false);
			$this->Ln(20);
			
		}elseif(Session::get('role') == ES1){
			$this->Cell(0,0,'KL   : '.trim($nm_kppn3), 0, 0, 'L', false);
			$this->Ln(12);
			$this->Cell(0,0,'ES1 : '.trim($nm_kppn2), 0, 0, 'L', false);
			$this->Ln(20);
			
		}

			
		//------------------------------------------------------------------
		
	}
	 //footer
    function Footer() {

        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Hal : ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $hari_ini =  Date("Y-m-d H:i:s");
        $this->Cell(0, 10, 'Dicetak : ' . $hari_ini, 0, 0, 'R');
    }
	  
	 public function printPDF() {

        if ($this->options['paper_size'] == "F4") {
            $a = 8.3 * 72; //1 inch = 72 pt
            $b = 13.0 * 72;
            $this->FPDF($this->options['orientation'], "pt", array($a, $b));
        } else {
            $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
        }

        $this->SetAutoPageBreak(false, 30);
        $this->AliasNbPages();
        $this->SetFont("helvetica", "B", 10);
        $this->AddPage();

        $this->rptDetailData();
        $this->Footer();
        $this->Output($this->options['filename'], $this->options['destinationfile']);
    }
	
    private $widths;
    private $aligns;

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }
	function Row1($data1) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data1); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data1[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data1); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data1[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }
	function Row2($data2) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data2); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data2[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data2); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data2[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }
	function Row3($data3) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data3); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data3[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data3); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data3[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }
	
	function Row4($data4) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data4); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data4[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data4); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data4[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

		function Row6($data6) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data6); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data6[$i]));
        $h = 10 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data6); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 10, $data6[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}
?>
