<?php
session_start();
//PREPARED BY:
$session_designation = $_SESSION['session_designation'];
$session_full_name = $_SESSION['session_full_name'];


//NOTED BY:
$noted_by = "JASON A. BAHIL";
$noted_by_designation = "PROJECT TECHNICAL STAFF III";

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

// $row;
if (isset($_GET["f1x"])) {
	$sql1 = "SELECT * FROM " . $TBL_INVENTORY . " WHERE id='" . $_GET["f1x"] . "' ";
	$result = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$sql =

		"SELECT *, tbl_ims_end_user.status FROM tbl_ims_end_user
    left JOIN tbl_unifast_staff ON tbl_unifast_staff.enduser_list_id = tbl_ims_end_user.enduser_list_id
    WHERE
    tbl_ims_end_user.id = " . $_GET["f1x"];

	$result = mysqli_query($conn, $sql);
	$row['end_users'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// echo json_encode($row);
}



$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();



$pdf->SetFont('Arial', 'IB', 13);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(277, 5, 'ITEM INFORMATION REPORT', 0, 0, 'C', true);
$pdf->Ln();
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255);
$currentdateasofnow =  date('M d, Y',);
$pdf->Cell(277, 5, 'AS OF ' . strtoupper($currentdateasofnow), 0, 0, 'C', true);


$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(33, 5, 'ITEM:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(105.5, 5, $row['item'], 0, 0, 'L', true);
$pdf->Cell(55, 5, '', 0, 0, 'L', true);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(26, 5, 'SUPPLIER:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(57.5, 5, $row['supplier'], 0, 0, 'L', true);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(33, 5, 'DESCRIPTION:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 9.5);
$pdf->Cell(150.5, 5, $row['item_description'], 0, 0, 'L', true);
$pdf->Cell(10, 5, '', 0, 0, 'L', true);
$pdf->SetFont('Arial', 'B', 10);


$warranty_date = date('Y-m-d', strtotime('+' . $row['supplier_warranty'] . ' years', strtotime($row['date_acquired'])));

$currentdate =  date('Y-m-d');



$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(26, 5, 'WARRANTY:', 0, 0, 'L', true);
if ($warranty_date >= $currentdate) {
	$warranty_value = "UNTIL " . date('M d, Y', strtotime($warranty_date));
	$pdf->SetTextColor(0, 128, 0);
} else {
	$warranty_value = "ENDED SINCE " . date('M d, Y', strtotime($warranty_date));
	$pdf->SetTextColor(255, 0, 0);
}

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(57.5, 5, strtoupper($warranty_value), 0, 0, 'L', true);
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(33, 5, 'DATE ACQUIRED:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$new_date_acquired = date('M d, Y', strtotime($row['date_acquired']));
$pdf->Cell(105.5, 5, strtoupper($new_date_acquired), 0, 0, 'L', true);
$pdf->Cell(55, 5, '', 0, 0, 'L', true);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(26, 5, 'QUANTITY:', 0, 0, 'L', true);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(57.5, 5, $row['quantity'] . " " . $row['unit'], 0, 0, 'L', true);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 128);
$pdf->Cell(6, 5, 'NO.', 0, 0, 'C', true);
$pdf->Cell(40, 5, 'SERIAL NUMBER', 0, 0, 'C', true);
$pdf->Cell(41, 5, 'INVENTORY ITEM NUMBER', 0, 0, 'C', true);
$pdf->Cell(23, 5, 'ICS NUMBER', 0, 0, 'C', true);
$pdf->Cell(30, 5, 'STATUS', 0, 0, 'C', true);
$pdf->Cell(58, 5, 'MR TO', 0, 0, 'C', true);
$pdf->Cell(51, 5, 'END USER', 0, 0, 'C', true);
$pdf->Cell(28, 5, 'DATE RECEIVED', 0, 0, 'C', true);

$currentpage = $pdf->PageNo();
$oldpage = $currentpage;


$pdf->Ln();
foreach ($row['end_users'] as $key => $item) {
	if ($pdf->PageNo() > $oldpage) {
		$oldpage = $pdf->PageNo();
		//header
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->SetFillColor(0, 0, 128);
		$pdf->Cell(6, 5, 'No.', 0, 0, 'C', true);
		$pdf->Cell(40, 5, 'SERIAL NUMBER', 0, 0, 'C', true);
		$pdf->Cell(41, 5, 'INVENTORY ITEM NUMBER', 0, 0, 'C', true);
		$pdf->Cell(23, 5, 'ICS NUMBER', 0, 0, 'C', true);
		$pdf->Cell(30, 5, 'STATUS', 0, 0, 'C', true);
		$pdf->Cell(58, 5, 'MR TO', 0, 0, 'C', true);
		$pdf->Cell(51, 5, 'END USER', 0, 0, 'L', true);
		$pdf->Cell(28, 5, 'DATE RECEIVED', 0, 0, 'C', true);
		$pdf->Ln();
	}

	$pdf->SetFont('Arial', '', 7);
	$pdf->SetTextColor(0, 0, 0);

	if ($item['date_received'] == null) {
		$new_date = "";
	} else {
		$new_date = date('M d, Y', strtotime($item['date_received']));
	}

	if ($key % 2 == 0) {
		$pdf->SetFillColor(255, 255, 255);
	} else {
		$pdf->SetFillColor(192, 192, 192);
	}

	if (strlen($item['last_name']) > 0) {
		# code...
		if ($item['prefix'] == "N/A" || $item['prefix'] == "") {
			$item['prefix'] = "";
		} else {
			$item['prefix'] = $item['prefix'] . " ";
		}

		if ($item['middle_name'] == "N/A" || $item['middle_name'] == "") {
			$item['middle_name'] = "";
		} else {
			$item['middle_name'] = " " . $item['middle_name'];
		}

		if ($item['suffix'] == "N/A" || $item['suffix'] == "") {
			$item['suffix'] = "";
		} else {
			$item['suffix'] = ", " . $item['suffix'];
		}

		if ($item['title'] == "N/A" || $item['title'] == "") {
			$item['title'] = "";
		} else {
			$item['title'] = ", " . $item['title'];
		}

		$show_full_name = $item['prefix'] . $item['last_name'] . ", " . $item['first_name'] . $item['middle_name'] . $item['suffix'] . $item['title'];
	} else {
		$show_full_name = "";
	}



	$pdf->Cell(6, 5, $key + 1, 0, 0, 'C', true);
	$pdf->Cell(40, 5, $item['serial_number'], 0, 0, 'C', true);
	$pdf->Cell(41, 5, $item['inventory_item_number'], 0, 0, 'C', true);
	$pdf->Cell(23, 5, $item['ics_number'], 0, 0, 'C', true);
	$pdf->Cell(30, 5, $item['status'], 0, 0, 'C', true);
	$pdf->Cell(58, 5, $row['received_by'], 0, 0, 'C', true);
	$pdf->Cell(51, 5, $show_full_name, 0, 0, 'L', true);
	$pdf->Cell(28, 5, strtoupper($new_date), 0, 0, 'C', true);
	$pdf->Ln();
	// $pdf->Text(0,0,'');
}




$pdf->Ln(8);
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
//end



$filename = "Inventory.pdf";
$pdf->Output('I', $filename);
