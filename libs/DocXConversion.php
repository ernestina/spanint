 <?php
 class DocxConversion{
    private $filename;

    public function __construct($filePath) {
        $this->filename = $filePath;
    }
     
    public function set_filename($filename) {
        $this->filename = $filename;
    }

    private function read_doc() {
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));   
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
          {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
              {
              } else {
                $outtext .= $thisline." ";
              }
          }
         $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    private function read_docx(){

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

 /************************excel sheet************************************/

function xlsx_to_text($input_file){
    $xml_filename = "xl/worksheets/sheet1.xml"; //content file name
    $zip_handle = new ZipArchive;
    $dom = new DOMDocument();
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = $dom->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            // $output_text = strip_tags($xml_handle->saveXML());

  if($xml = simplexml_load_string($xml_handle->saveXML())){
    // Keep up to 12MB in memory, if becomes bigger write to temp file
	file_put_contents($input_file.'.txt','');
	$i=0;
	foreach ($xml->sheetData->row as $row) {
		$i++;
		$output = '';
		foreach ($row->c as $cell) {
			// $output .= '|'.$cell->v->__toString().'|'.',';
			$output .= $cell->v->__toString()."\t";
		}
		$output .= $output."\n";
		file_put_contents($input_file.'.txt',$output, FILE_APPEND);
	}
	return $output;
	
    if($row = get_object_vars($xml->sheetData)){ // First record
      // First row contains column header values
      foreach($row as $key => $value){
        $header[] = $key;
      }
      fputcsv($file, $header,',','"');
      foreach ($xml->record as $record) {
        fputcsv($file, get_object_vars($record),',','"');
      }
      rewind($file);
      $output = stream_get_contents($file);
      fclose($file);
      return $output;
    }else{
      return '';
    }
}

			
			 //var_dump($xml_handle->saveXML()); die();

             $output_text = strip_tags($xml_handle->saveXML());
            // $output_text = $xml_handle->saveXML();
        }else{
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}
     
function xlsx_to_array($input_file){
    $xml_filename = "xl/worksheets/sheet1.xml"; //content file name
    $zip_handle = new ZipArchive;
    $dom = new DOMDocument();
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = $dom->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            // $output_text = strip_tags($xml_handle->saveXML());

            if($xml = simplexml_load_string($dom->saveXML())){
                // Keep up to 12MB in memory, if becomes bigger write to temp file
                file_put_contents($input_file.'.txt','');
                $i=0;
                $output=array();
                foreach ($xml->sheetData->row as $row) {
                    $output1 = array();
                    $no=0;
                    foreach ($row->c as $cell) {
                        // $output .= '|'.$cell->v->__toString().'|'.',';
                        $output1[$no++] = $cell->v->__toString();
                    }
                    $output[$i++] = $output1;
                    //file_put_contents($input_file.'.txt',$output, FILE_APPEND);
                }
	           return $output;
            }
        }else{
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}

/*************************power point files*****************************/
function pptx_to_text($input_file){
    $zip_handle = new ZipArchive;
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        $slide_number = 1; //loop through slide files
        while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text .= strip_tags($xml_handle->saveXML());
            $slide_number++;
        }
        if($slide_number == 1){
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}


    public function convertToText() {

        if(isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];
        if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx")
        {
            if($file_ext == "doc") {
                return $this->read_doc();
            } elseif($file_ext == "docx") {
                return $this->read_docx();
            } elseif($file_ext == "xlsx") {
                return $this->xlsx_to_array($this->filename);
            }elseif($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }

}
?>