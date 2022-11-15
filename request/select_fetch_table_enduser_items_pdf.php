<?php
session_start();


include('../connections/db-connect.php');
require('../assets/fpdf182/mc_table.php');

header("Content-type: application/pdf; charset=utf-8");

class PDF extends PDF_MC_Table
{
	function Header()
	{
		if ($this->PageNo() == 1) {
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
		if ($this->PageNo() == 1) {
			$this->Image('../imgfpdf/uf_logo_seal2.png', 177 / 2, 75, 120, 120);
			$this->SetAlpha(1);
		} else {
			$this->Image('../imgfpdf/uf_logo_seal2.png', 177 / 2, 90 / 2, 120, 120);
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
	function SetAlpha($alpha, $bm = 'Normal')
	{
		// set alpha for stroking (CA) and non-stroking (ca) operations
		$gs = $this->AddExtGState(array('ca' => $alpha, 'CA' => $alpha, 'BM' => '/' . $bm));
		$this->SetExtGState($gs);
	}

	function AddExtGState($parms)
	{
		$n = count($this->extgstates) + 1;
		$this->extgstates[$n]['parms'] = $parms;
		return $n;
	}

	function SetExtGState($gs)
	{
		$this->_out(sprintf('/GS%d gs', $gs));
	}

	function _enddoc()
	{
		if (!empty($this->extgstates) && $this->PDFVersion < '1.4')
			$this->PDFVersion = '1.4';
		parent::_enddoc();
	}

	function _putextgstates()
	{
		for ($i = 1; $i <= count($this->extgstates); $i++) {
			$this->_newobj();
			$this->extgstates[$i]['n'] = $this->n;
			$this->_put('<</Type /ExtGState');
			$parms = $this->extgstates[$i]['parms'];
			$this->_put(sprintf('/ca %.3F', $parms['ca']));
			$this->_put(sprintf('/CA %.3F', $parms['CA']));
			$this->_put('/BM ' . $parms['BM']);
			$this->_put('>>');
			$this->_put('endobj');
		}
	}

	function _putresourcedict()
	{
		parent::_putresourcedict();
		$this->_put('/ExtGState <<');
		foreach ($this->extgstates as $k => $extgstate)
			$this->_put('/GS' . $k . ' ' . $extgstate['n'] . ' 0 R');
		$this->_put('>>');
	}

	function _putresources()
	{
		$this->_putextgstates();
		parent::_putresources();
	}
}


if (isset($_GET["itm1"])) {
	$sql = "
    SELECT
    " . $TBL_INVENTORY . ".item,
    " . $TBL_INVENTORY . ".item_description,
	" . $TBL_INVENTORY . ".received_by,
	" . $TBL_INVENTORY . ".supplier_warranty,
	" . $TBL_INVENTORY . ".date_acquired,
    " . $TBL_END_USER  . ".date_received,
    " . $TBL_END_USER  . ".serial_number,
    " . $TBL_END_USER  . ".end_user,
    " . $TBL_END_USER  . ".unit,
    " . $TBL_END_USER  . ".designation,
    " . $TBL_INVENTORY . ".unit_cost
    FROM
    " . $TBL_INVENTORY . "
    INNER JOIN " . $TBL_END_USER  . " ON " . $TBL_INVENTORY . ".id = " . $TBL_END_USER  . ".id
    WHERE
    " . $TBL_END_USER  . ".end_user = '" . $_GET["itm1"] . "'";

	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// $total += ($row['unit_cost']);


	//PREPARED BY:
	$session_designation = $_SESSION['session_designation'];
	$session_full_name = $_SESSION['session_full_name'];


	//REVIEWED BY:
	$reviewed_by = $row[0]['end_user'];
	$reviewed_by_designation = $row[0]['designation'];

	//NOTED BY ICT HEAD:
	$noted_by = "JASON A. BAHIL";
	$noted_by_designation = "PROJECT TECHNICAL STAFF III";

	//NOTED BY UNIT HEAD:
	$noted_by_unit_head = null ;
	$noted_by_unit_head_designation = null ;
	if($row[0]['unit'] == "ADFIN UNIT"){
		$noted_by_unit_head = "VIOLETA B. GALO";
		$noted_by_unit_head_designation = "SUPERVISING EDUCATION PROGRAM SPECIALIST";
	}
	
	elseif($row[0]['unit'] == "OED UNIT"){
		$noted_by_unit_head = "ATTY. RYAN L. ESTEVEZ, DPA";
		$noted_by_unit_head_designation = "UNIFAST EXECUTIVE DIRECTOR";
	}

	elseif($row[0]['unit'] == "BILLING UNIT"){
		$noted_by_unit_head = "FLORES, YUUKI";
		$noted_by_unit_head_designation = "PROJECT TECHNICAL STAFF III";
	}

	elseif($row[0]['unit'] == "ADVOC UNIT"){
		$noted_by_unit_head = "PRECILA A. CHAN";
		$noted_by_unit_head_designation = "SUPERVISING EDUCATION PROGRAM SPECIALIST";
	}

	elseif($row[0]['unit'] == "ICT UNIT"){
		$noted_by_unit_head = "JASON A. BAHIL";
		$noted_by_unit_head_designation = "PROJECT TECHNICAL STAFF III";
	}

	elseif($row[0]['unit'] == "PMED UNIT"){
		$noted_by_unit_head = "ANNALIZA A. GANDO";
		$noted_by_unit_head_designation = "SUPERVISING EDUCATION PROGRAM SPECIALIST";
	}
	
}


$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();

$currentdateasofnow =  date('M d, Y',);

$pdf->SetFont('Arial', 'IB', 13);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(277, 5, 'STAFF ITEMS REPORT', 0, 0, 'C', true);
$pdf->Ln();
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(277, 5, 'As of ' . $currentdateasofnow, 0, 0, 'C', true);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(27, 5, 'NAME:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(163, 5, $row[0]['end_user'], 0, 0, 'L', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'DESIGNATION:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(163, 5,  $row[0]['designation'], 0, 0, 'L', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'UNIT:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(163, 5,  $row[0]['unit'], 0, 0, 'L', true);
$pdf->Ln();


$total = 0;
foreach ($row as $key => $item) {
	// $total += ($item['unit_cost']);
	$total += ($item['unit_cost']);
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(27, 5, 'TOTAL ITEM:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(163, 5, $key + 1, 0, 0, 'L', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(27, 5, 'TOTAL COST:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(163, 5, 'P ' . number_format($total), 0, 0, 'L', true);
$pdf->Ln();
$pdf->Ln();


$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 128);
$pdf->Cell(6, 5, 'N0.', 0, 0, 'C', true);
$pdf->Cell(48, 5, 'ITEM', 0, 0, 'C', true);
$pdf->Cell(68, 5, 'ITEM DESCRIPTION', 0, 0, 'C', true);
$pdf->Cell(44, 5, 'MR TO', 0, 0, 'C', true);
$pdf->Cell(27, 5, 'DATE RECEIVED', 0, 0, 'C', true);
$pdf->Cell(27, 5, 'WARRANTY', 0, 0, 'C', true);
$pdf->Cell(35, 5, 'SERIAL NUMBER', 0, 0, 'C', true);
$pdf->Cell(20, 5, 'UNIT COST', 0, 0, 'C', true);

$pdf->Ln();




foreach ($row as $key => $item) {

	$warranty_date = date('Y-m-d', strtotime('+' . $item['supplier_warranty'] . ' years', strtotime($item['date_acquired'])));

	$currentdate =  date('Y-m-d');

	$warranty_value;

	if ($warranty_date >= $currentdate) {
		$new_date_value = date('M d, Y', strtotime($warranty_date));
		$warranty_value = "UNTIL " . $new_date_value;
	} else {
		$new_date_value = date('M d, Y', strtotime($warranty_date));
		$warranty_value = "ENDED " . $new_date_value;
	}


	$new_date = date('M d, Y', strtotime($item['date_received']));

	$pdf->SetFont('Arial', '', 7);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetWidths(array(6, 48, 68, 44, 27, 27, 35, 20));
	$pdf->SetAligns(array('C', 'L', 'L', 'L', 'C', 'C', 'C', 'C'));
	if ($key % 2 == 0) {
		$fillColor = array(255,255,255);
	} else {
		$fillColor = array(192,192,192);
	}
	$pdf->row(array(
	$key + 1, 
	$item['item'], 
	$item['item_description'], 
	$item['received_by'], 
	strtoupper($new_date), 
	strtoupper($warranty_value), 
	$item['serial_number'], 
	'P ' . number_format($item['unit_cost'])),
	array(
		$fillColor,
		$fillColor,
		$fillColor,
		$fillColor,
		$fillColor,
		$fillColor,
		$fillColor,
		$fillColor
	));




	// if($key % 2 == 0){
	// 			$pdf->SetFillColor(255,255,255);
	// 		} else{
	// 			$pdf->SetFillColor(192,192,192);
	// 		}


	// $pdf->Cell(6, 5, $key + 1, 0, 0, 'C', true);
	// $pdf->Cell(48, 5, $item['item'], 0, 0, 'L', true);
	// $pdf->Cell(80, 5, $item['item_description'], 0, 0, 'C', true);
	// $pdf->Cell(44, 5, $item['received_by'], 0, 0, 'L', true);
	// $pdf->Cell(27, 5, $item['date_received'], 0, 0, 'C', true);
	// $pdf->Cell(25, 5, $item['supplier_warranty'] . " YEAR/S", 0, 0, 'C', true);
	// $pdf->Cell(30, 5, $item['serial_number'], 0, 0, 'C', true);
	// $pdf->Cell(20, 5, 'P '.number_format($item['unit_cost']), 0, 0, 'C', true);
	// $pdf->Ln();
}

$pdf->Ln(5);
//Signatory
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(30, 5, 'PREPARED BY:', 0, 0, 'L', true);
$pdf->Cell(150, 5, '', 0, 0, 'L', true);
$pdf->Cell(97, 5, 'NOTED BY:', 0, 0, 'L', true);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 5, '', 0, 0, 'C', true);
$pdf->Cell(50, 5, strtoupper($session_full_name), 'T', 0, 'C', true);
$pdf->Cell(130, 5, '', 0, 0, 'L', true);
$pdf->Cell(50, 5, $noted_by, 'T', 0, 'C', true);
//SPACING
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 4, '', 0, 0, 'C', true);
$pdf->Ln();
//END
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(10, 5, '', 0, 0, 'C', true);
$pdf->Cell(50, 5, strtoupper($session_designation), 0, 0, 'C', true);
$pdf->Cell(130, 5, '', 0, 0, 'L', true);
$pdf->Cell(50, 5, $noted_by_designation, 0, 0, 'C', true);
$pdf->Ln();
//end.
$pdf->Ln();
$pdf->Ln();







//Signatory
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(30, 5, 'REVIEWED BY:', 0, 0, 'L', true);
$pdf->Cell(150, 5, '', 0, 0, 'L', true);
// $pdf->Cell(97, 5, 'NOTED BY:', 0, 0, 'L', true);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 5, '', 0, 0, 'C', true);
$pdf->Cell(50, 5, strtoupper($reviewed_by), 'T', 0, 'C', true);
$pdf->Cell(130, 5, '', 0, 0, 'L', true);
$pdf->Cell(50, 5, $noted_by_unit_head, 'T', 0, 'C', true);
//SPACING
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(190, 4, '', 0, 0, 'C', true);
$pdf->Ln();
//END
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(10, 5, '', 0, 0, 'C', true);
$pdf->Cell(50, 5, 'END USER', 0, 0, 'C', true);
$pdf->Cell(130, 5, '', 0, 0, 'L', true);
$pdf->Cell(50, 5, $noted_by_unit_head_designation, 0, 0, 'C', true);
$pdf->Ln();
//end


$filename = "Inventory.pdf";
$pdf->Output('I', $filename);
