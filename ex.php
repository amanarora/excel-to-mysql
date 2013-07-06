<?php
function getDataFromExcel($file, $sheet, $rows, $cols)
{
    // COM CREATE
    // New Comment
    $excel = new COM("Excel.application") or die ("ERROR: Unable to instantaniate COM!\r\n");
    
 //check
    
    $Workbook = $excel->Workbooks->Open($file) or die("ERROR: Unable to open " . $file . "!\r\n");
    $Worksheet = $Workbook->Worksheets($sheet);
    $Worksheet->Activate;
    $i = 0;
    foreach ($rows as $row)
    {
        $i++; $j = 0;
        foreach ($cols as $col)
        {
            $j++;
            $cell = $Worksheet->Range($col . $row);
            $cell->activate();
            $matrix[$i][$j] = $cell->value;
        }
    }
 
    // COM DESTROY
    $Workbook->Close();
    unset($Worksheet);
    unset($Workbook);
    $excel->Workbooks->Close();
    $excel->Quit();
    unset($excel);
 
    return $matrix;
}
$xls_path = "http://localhost/excel_reader/coordinates.xls"; // input file
$xls_sheet = 1; // sheet #1 from file excel_data.xls
$xls_rows = range(2, 270, 1); // I want extract rows 2 - 270 from excel_data.xls with step 1 row
$xls_cols = array("A", "B", "C", "D", "E", "F"); // I want to extract columns A - F from excel_data.xls
 
 
// retrieve data from excel
$data = getDataFromExcel($xls_path, $xls_sheet, $xls_rows, $xls_cols);
 
// insert retrieved data into database
foreach ($data as $line)
{
    $i = 0;
	$string = "";
    foreach ($line as $col => $entry)
    {
        // create the SET string for INSERT query
        $i++;
        $string .= "`" . $col . "` = '" . $entry . "'";
        
    }
    echo $string;
	echo "<br/>";echo "<br/>";
}
?>