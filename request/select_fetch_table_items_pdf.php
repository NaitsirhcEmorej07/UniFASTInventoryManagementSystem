<?php
session_start();
$session_designation = $_SESSION['session_designation'];
$session_full_name = $_SESSION['session_full_name'];

include('../connections/db-connect.php');
require('../assets/fpdf182/mc_table.php');


header("Content-type: application/pdf; charset=utf-8");

class PDF extends PDF_MC_Table
{
    function Header()
    {
        if ($this->PageNo()==1){
        //logo
		
        $this->Image('../imgfpdf/Header.png', 128.9 / 2, 2, -200);        
		        $this->Cell(277, 25, '', 0, 0);
        $this->Ln();
        }
    }
    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, 'Page ' . $this->PageNo(), 0, 0, 'C');
		$this->SetAlpha(0.5);
		if($this->PageNo()==1){
			$this->Image('../imgfpdf\uf_logo_seal2.png', 177 / 2 , 75, 120, 120);  
			$this->SetAlpha(1);
		}
		else{
			$this->Image('../imgfpdf\uf_logo_seal2.png', 177 / 2 , 90 / 2, 120, 120);  
			$this->SetAlpha(1);
		}
    }
    function cellMultiColor($stringParts)
    {
        $currentPointerPosition = 0;
        foreach ($stringParts as $part) {
            // Set the pointer to the end of the previous string part
            $this->_pdf->SetX($currentPointerPosition);

            // Get the color from the string part
            $this->_pdf->SetTextColor($part['color'][0], $part['color'][1], $part['color'][2]);

            $this->_pdf->Cell($this->_pdf->GetStringWidth($part['text']), 10, $part['text']);

            // Update the pointer to the end of the current string part
            $currentPointerPosition += $this->_pdf->GetStringWidth($part['text']);
        }
    }
    protected $extgstates = array();

	// alpha: real value from 0 (transparent) to 1 (opaque)
	// bm:    blend mode, one of the following:
	//          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
	//          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
	function SetAlpha($alpha, $bm='Normal')
	{
		// set alpha for stroking (CA) and non-stroking (ca) operations
		$gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
		$this->SetExtGState($gs);
	}

	function AddExtGState($parms)
	{
		$n = count($this->extgstates)+1;
		$this->extgstates[$n]['parms'] = $parms;
		return $n;
	}

	function SetExtGState($gs)
	{
		$this->_out(sprintf('/GS%d gs', $gs));
	}

	function _enddoc()
	{
		if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
			$this->PDFVersion='1.4';
		parent::_enddoc();
	}

	function _putextgstates()
	{
		for ($i = 1; $i <= count($this->extgstates); $i++)
		{
			$this->_newobj();
			$this->extgstates[$i]['n'] = $this->n;
			$this->_put('<</Type /ExtGState');
			$parms = $this->extgstates[$i]['parms'];
			$this->_put(sprintf('/ca %.3F', $parms['ca']));
			$this->_put(sprintf('/CA %.3F', $parms['CA']));
			$this->_put('/BM '.$parms['BM']);
			$this->_put('>>');
			$this->_put('endobj');
		}
	}

	function _putresourcedict()
	{
		parent::_putresourcedict();
		$this->_put('/ExtGState <<');
		foreach($this->extgstates as $k=>$extgstate)
			$this->_put('/GS'.$k.' '.$extgstate['n'].' 0 R');
		$this->_put('>>');
	}

	function _putresources()
	{
		$this->_putextgstates();
		parent::_putresources();
	}
}

if (isset($_GET["f1x"])) {
    $sql = "
    
    SELECT 
    inventory_tbl.item,
    inventory_tbl.item_description,
    inventory_tbl.supplier,
    inventory_tbl.quantity,
    inventory_tbl.unit,
	inventory_tbl.date_acquired,
	inventory_tbl.supplier_warranty,
	inventory_tbl.received_by,
    end_user_tbl.ics_number,
    end_user_tbl.status,
    end_user_tbl.serial_number,
    end_user_tbl.inventory_item_number,
    end_user_tbl.end_user,
    end_user_tbl.date_received

    FROM
    inventory_tbl

    INNER JOIN end_user_tbl ON inventory_tbl.id = end_user_tbl.id
    WHERE
    end_user_tbl.id='".$_GET["f1x"]."' 
    
        
    ";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $quantity = $row[0]['quantity'] . ' ' . $row[0]['unit'];
}


$pdf = new PDF('L','mm','A4');
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();

$pdf->SetFont('Arial', 'IB', 13);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(277, 5, 'ITEM INFORMATION REPORT', 0, 0, 'C', true);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(33, 5, 'ITEM:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(105.5, 5, $row[0]['item'], 0, 0, 'L', true);
$pdf->Cell(55, 5, '', 0, 0, 'L', true);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(26, 5, 'SUPPLIER:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(57.5, 5, $row[0]['supplier'], 0, 0, 'L', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(33, 5, 'DESCRIPTION:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(105.5, 5, $row[0]['item_description'], 0, 0, 'L', true);
$pdf->Cell(55, 5, '', 0, 0, 'L', true);
$pdf->SetFont('Arial', 'B', 10);

//hello
$warranty_value;
// $warranty_date = date ('M d, Y', strtotime('+'.$row[0]['supplier_warranty'].' years', strtotime($row[0]['date_acquired'])));
$warranty_date = date ('M d, Y');

$currentdate =  date('M d, Y');
$currentdate = date('Y-m-d', strtotime($currentdate));

if($warranty_date >= $currentdate)
{
	$warranty_value = "UNTIL " . $warranty_date;
}
else 
{
	$warranty_value = "ENDED SINCE " . $warranty_date;
}


$pdf->Cell(26, 5, 'WARRANTY:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(57.5, 5, strtoupper($currentdate), 0, 0, 'L', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(33, 5, 'DATE ACQUIRED:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$new_date_acquired = date('M d, Y', strtotime($row[0]['date_acquired']));
$pdf->Cell(105.5, 5, strtoupper($new_date_acquired), 0, 0, 'L', true);
$pdf->Cell(55, 5, '', 0, 0, 'L', true);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(26, 5, 'QUANTITY:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(57.5, 5, $quantity, 0, 0, 'L', true);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 128);
$pdf->Cell(6, 5, 'No.', 0, 0, 'C', true);
$pdf->Cell(38.71428571428571, 5, 'SERIAL NUMBER', 0, 0, 'C', true);
$pdf->Cell(41.71428571428571, 5, 'INVENTORY ITEM NUMBER', 0, 0, 'C', true);
$pdf->Cell(35.71428571428571, 5, 'ICS NUMBER', 0, 0, 'C', true);
$pdf->Cell(38.71428571428571, 5, 'STATUS', 0, 0, 'C', true);
$pdf->Cell(38.71428571428571, 5, 'MR TO', 0, 0, 'C', true);
$pdf->Cell(38.71428571428571, 5, 'END USER', 0, 0, 'C', true);
$pdf->Cell(38.71428571428571, 5, 'DATE RECEIVED', 0, 0, 'C', true);

$pdf->Ln();

foreach ($row as $key => $item) {
	$pdf->SetFont('Arial', '', 7);
	$pdf->SetTextColor(0, 0, 0);
	
	$new_date = date('M d, Y', strtotime($item['date_received']));

	if($key % 2 == 0){
				$pdf->SetFillColor(255,255,255);
			} else{
				$pdf->SetFillColor(192,192,192);
			}
	
	
	$pdf->Cell(6, 5, $key + 1, 0, 0, 'C', true);
	$pdf->Cell(38.71428571428571, 5, $item['serial_number'], 'L', 0, 'C', true);
	$pdf->Cell(41.71428571428571, 5, $item['inventory_item_number'], 'L', 0, 'C', true);
	$pdf->Cell(35.71428571428571, 5, $item['ics_number'], 'L', 0, 'C', true);
	$pdf->Cell(38.71428571428571, 5, $item['status'], 'L', 0, 'C', true);
	$pdf->Cell(38.71428571428571, 5, $item['received_by'], 'L', 0, 'C', true);
	$pdf->Cell(38.71428571428571, 5, $item['end_user'], 'L', 0, 'C', true);
	$pdf->Cell(38.71428571428571, 5, strtoupper($new_date), 'L', 0, 'C', true);
	$pdf->Ln();
	}


$pdf->Ln(15);
//Signatory
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(30, 5, 'Prepared By:', 0, 0, 'L', true);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 5, '', 0, 0, 'C', true);
$pdf->Cell(50, 5, $session_full_name, 'T', 0, 'C', true);
//SPACING
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 4, '', 0, 0, 'C', true);
$pdf->Ln();
//END
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(10, 5, '', 0, 0, 'C', true);
$pdf->Cell(50, 5, $session_designation, 0, 0, 'C', true);
$pdf->Ln();
//end


$filename = "Inventory.pdf";
$pdf->Output('I',$filename);

?>