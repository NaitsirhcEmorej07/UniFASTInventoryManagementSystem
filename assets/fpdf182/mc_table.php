<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
	var $widths;
	var $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data, $fillColor = array(array(255, 255, 255)), $textColor = array(array(0, 0, 0)))
	{
		// static $rownum = 0;
		//Calculate the height of the row
		$nb = 0;

		for ($i = 0; $i < count($data); $i++) {
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		}
		$h = 5 * $nb;

		// $rownum % 2 == 0 ? $this->SetFillColor(255, 255, 255) : $this->SetFillColor(192, 192, 192);
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			//define fill color if u use something besides default
			if (count($fillColor) == 1)
				$this->SetFillColor($fillColor[0][0], $fillColor[0][1], $fillColor[0][2]);
			else
				$this->SetFillColor($fillColor[$i][0], $fillColor[$i][1], $fillColor[$i][2]);
			//define text color if u use something besides default
			if (count($textColor) == 1)
				$this->SetTextColor($textColor[0][0], $textColor[0][1], $textColor[0][2]);
			else
				$this->SetTextColor($textColor[$i][0], $textColor[$i][1], $textColor[$i][2]);
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			// $this->Rect($x,$y,$w,$h);
			if ($this->NbLines($this->widths[$i], $data[$i]) == 1 && $nb > 1)
				$this->MultiCell($w, $nb * 5, $data[$i], 0, $a, TRUE);
			else
				$this->MultiCell($w, 5, $data[$i], 0, $a, TRUE);

			//Print the text
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}


		//Go to the next line
		$this->Ln($h);
		// $rownum++;
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
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
			$l += $cw[$c];
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
