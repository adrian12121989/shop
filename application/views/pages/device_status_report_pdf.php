				<?php
		
		
    /**
    * Creates an example PDF TEST document using TCPDF
    * @package com.tecnick.tcpdf
    * @abstract TCPDF - Example: Default Header and Footer
    * @author Nicola Asuni
    * @since 2008-03-04
    */
 
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Adrian Mtemela');
    $pdf->SetTitle('4G Experience Report');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
 
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
 
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
 
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
 
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
 
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
 
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
 
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
 
    // ---------------------------------------------------------    
 
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
 
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('times', '', 12, '', true);   
 
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
 
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
	
	
    // Set some content to print
    $html = <<<EOD
    <h1>4G EXPERIENCE GENERAL REPORT.</h1>
EOD;
 
    // Print text using writeHTMLCell()
    //$pdf->writeHTMLCell(50, 0, 50, 50, $html, 0, 1, 0, true, 'C', true);  
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C', true);
    //$pdf->WriteHTMLCell(0, $html, '', 0, 'C', true, 0, false, false, 0, 'C');
    $pdf->Ln(8);
	
	
	$pdf->Ln(2);
	$pdf->writeHTML('Registered Devices.', true, false, true, false, 'L');
	//craeting the table
	$html = '<table style = "border:1px solid black">';
	$html .= '<tr style = "background-color:#8B6914; color:#000000">
			<th>Device Name</th>
			<th>Device Number</th>
			<th>Warranty</th>
			<th>Device Price</th>
			<th>Registered By</th>
			<th>Reg Date</th>
	</tr>';
	$sum = 0;
	$count = 1;
	foreach($devices_status as $record){
		$html .= '<tr>
			<td style = "border:1px solid black">'.ucwords($record->dev_name).'</td>
			<td style = "border:1px solid black">'.ucwords($record->dev_number).'</td>
			<td style = "border:1px solid black">'.$record->dev_warranty.'</td>
			<td style = "border:1px solid black">'.number_format($record->dev_price).'</td>
			<td style = "border:1px solid black">'.ucwords($record->registered_by).'</td>
			<td style = "border:1px solid black">'.$record->dev_date.'</td>
		</tr>';
		$value = $record->dev_price;
		$sum += $value;
		$total_count = $count++;
	}
	$html .= '</table>';
	echo $sum;
	$pdf->writeHTML($html, true, false, true, false, '');
	
	$pdf->Ln(4);
	$pdf->writeHTML('Total number of devices found ', true, false, true, false, 'R');
	$pdf->writeHTML(number_format($total_count).'/=', true, false, true, false, 'R');
	$pdf->writeHTML('Total amount of cash used to buy devices ', true, false, true, false, 'R');
	$pdf->writeHTML(number_format($sum).'/=', true, false, true, false, 'R');
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(2);
	$pdf->writeHTML('Sold Devices.', true, false, true, false, 'L');
	//craeting the table
	$html = '<table style = "border:1px solid black">';
	$html .= '<tr style = "background-color:#8B6914; color:#000000">
			<th>Device Name</th>
			<th>Device Number</th>
			<th>Warranty</th>
			<th>Device Price</th>
			<th>Sold Price</th>
			<th>Sold By</th>
			<th>Sold Date</th>
	</tr>';
	$sum1 = 0;
	$count = 1;
	foreach($devices_status as $record){
		if($record->sold == 1){
		$html .= '<tr>
			<td style = "border:1px solid black">'.ucwords($record->dev_name).'</td>
			<td style = "border:1px solid black">'.ucwords($record->dev_number).'</td>
			<td style = "border:1px solid black">'.$record->dev_warranty.'</td>
			<td style = "border:1px solid black">'.number_format($record->dev_price).'</td>
			<td style = "border:1px solid black">'.number_format($record->sold_amount).'</td>
			<td style = "border:1px solid black">'.ucwords($record->registered_by).'</td>
			<td style = "border:1px solid black">'.$record->dev_date.'</td>
		</tr>';
		$value = $record->sold_amount;
		$sum1 += $value;
		$total_count = $count++;
	}
}
	$html .= '</table>';
	echo $sum1;
	$pdf->writeHTML($html, true, false, true, false, '');
	
	$pdf->Ln(4);
	$pdf->writeHTML('Total number of devices found. ', true, false, true, false, 'R');
	$pdf->writeHTML(number_format($total_count).'/=', true, false, true, false, 'R');
	$pdf->writeHTML('Total amount of cash from sold devices. ', true, false, true, false, 'R');
	$pdf->writeHTML(number_format($sum1).'/=', true, false, true, false, 'R');
	
	$pdf->Ln(4);
	$minus = $sum1 - $sum;
	$pdf->writeHTML('Total Profit.', true, false, true, false, 'R');
	$line = $minus;
	$pdf->writeHTML(number_format($line).'/=', true, false, true, false, 'R');
	
	
	$pdf->Ln(2);
	$pdf->writeHTMLCell(0, 5, '', '', 'Printed On:', 0, 1, 0, true, 'C', true);
	$pdf->Cell(0, 5,date("d/m/Y h:i:s"), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	// Simple watermark
// This will set it to page one and lay over anything written before it on the first page
$pdf->setPage( 1 );

// Get the page width/height
$myPageWidth = $pdf->getPageWidth();
$myPageHeight = $pdf->getPageHeight();

// Find the middle of the page and adjust.
$myX = ( $myPageWidth / 2 ) - 75;
$myY = ( $myPageHeight / 2 ) + 25;

// Set the transparency of the text to really light
$pdf->SetAlpha(0.09);

// Rotate 45 degrees and write the watermarking text
$pdf->StartTransform();
$pdf->Rotate(45, $myX, $myY);
$pdf->SetFont("courier", "", 30);
$pdf->Text($myX, $myY,"4G EXPERIENCE DEVICE REPORT");
$pdf->StopTransform();

// Reset the transparency to default
$pdf->SetAlpha(1);//page number
	
    // ---------------------------------------------------------    
 
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    ob_clean();
    $pdf->Output('itcb.pdf', 'I');    
    end_ob_clean();
 //$pdf->AddPage(); 
    //============================================================+
    // END OF FILE
    //============================================================+
    

 
/* End of file c_test.php */
/* Location: ./application/controllers/c_test.php */
	





