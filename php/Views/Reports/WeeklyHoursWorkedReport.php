<?php
//FILE			: WeeklyHoursWorkedReport.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: Weekly Hours Worked Report. generates a report in pdf format using FPDF library 
//                and Mysql Query calls
namespace Reports;
use Helper\FPDF\FPDF;
use Helper\Connection;



// MySql setup
$db = Connection::connect();
if (!$db)
  {
  die('Could not connect: ' . mysqli_error($db));
  }

mysqli_query($db,"Use EMS" );

// fpdf Setup
$lineBreak = 5;
$y_axis_initial = 10;
$pdf = new FPDF();
$pdf->Open();
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Courier', '', 11);
$pdf->SetFillColor(255,255,102);
$pdf->SetY($y_axis_initial);
$max = 25;
$i = 0;

$pdf->SetX(20);
$pdf->SetFont('Courier', '', 11);
$pdf->SetFont('','UB');
$pdf->Cell(44, 4, 'Weekly Hours Worked', 1, 0, 'C', 1);
$pdf->SetFont('','');
$pdf->SetFont('Courier', '', 11);

/**************************************************************
***                                                         ***
***                      Full Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->SetX(62);
$pdf->MultiCell(98,5,'FullTime',1,'C', false);
$pdf->SetX(62);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(35, 5, ' SIN', 1, 0, 'L', 0);
$pdf->Cell(25, 5, 'Hours', 1, 0, 'C', 0);


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN,
                                (timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)
                                FROM person
                                LEFT JOIN fulltimeemployee
                                ON person.id=fulltimeemployee.employee_id
                                LEFT JOIN timecard
                                ON person.id=timecard.employee_id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(62);
        $pdf->MultiCell(98,5,'FullTime',1,'C', false);
        $pdf->SetX(62);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 5, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(25, 5, 'Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $hours = $row['(timecard.monday + timecard.tuesday 
                    + timecard.wednesday + timecard.thursday 
                    + timecard.friday + timecard.saturday 
                    + timecard.sunday)'];

    $pdf->Ln($lineBreak);                
    $pdf->SetX(62);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$SIN, 1, 0, 'L', 0);
    $pdf->Cell(25, 5, $hours, 1, 0, 'C', 0);
    $pdf->SetX(62);

    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Part Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(62);
$pdf->MultiCell(98,5,'PartTime',1,'C', false);
$pdf->SetX(62);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(35, 5, ' SIN', 1, 0, 'L', 0);
$pdf->Cell(25, 5, 'Hours', 1, 0, 'C', 0);


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN,
                                (timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)
                                FROM person
                                LEFT JOIN parttimeemployee
                                ON person.id=parttimeemployee.employee_id
                                LEFT JOIN timecard
                                ON person.id=timecard.employee_id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(62);
        $pdf->MultiCell(98,5,'PartTime',1,'C', false);
        $pdf->SetX(62);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 5, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(25, 5, 'Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $hours = $row['(timecard.monday + timecard.tuesday 
                    + timecard.wednesday + timecard.thursday 
                    + timecard.friday + timecard.saturday 
                    + timecard.sunday)'];

    $pdf->Ln($lineBreak);                
    $pdf->SetX(62);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$SIN, 1, 0, 'L', 0);
    $pdf->Cell(25, 5, $hours, 1, 0, 'C', 0);
    $pdf->SetX(62);

    $i = $i + 1;

}


/**************************************************************
***                                                         ***
***                      Seasonal Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(62);
$pdf->MultiCell(98,5,'Seasonal',1,'C', false);
$pdf->SetX(62);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(35, 5, ' SIN', 1, 0, 'L', 0);
$pdf->Cell(25, 5, 'Hours', 1, 0, 'C', 0);


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, person.SIN,
                                (timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)
                                FROM person
                                LEFT JOIN seasonalemployee
                                ON person.id=seasonalemployee.employee_id
                                LEFT JOIN timecard
                                ON person.id=timecard.employee_id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(62);
        $pdf->MultiCell(98,5,'FullTime',1,'C', false);
        $pdf->SetX(62);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 5, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(25, 5, 'Hours', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $hours = $row['(timecard.monday + timecard.tuesday 
                    + timecard.wednesday + timecard.thursday 
                    + timecard.friday + timecard.saturday 
                    + timecard.sunday)'];

    $pdf->Ln($lineBreak);                
    $pdf->SetX(62);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 5, " ".$SIN, 1, 0, 'L', 0);
    $pdf->Cell(25, 5, $hours, 1, 0, 'C', 0);
    $pdf->SetX(62);
    
    $i = $i + 1;

}

/**************************************************************
***                                                         ***
***                      End                          
***                                                         ***
**************************************************************/
mysqli_close($db);

$pdf->Ln($lineBreak);
$pdf->SetX(25);
$pdf->Cell(50, 5, 'Date Generated: ' . date("Y-m-d") , 0, 4, 'C', 0);
$pdf->Cell(50, 5, 'Run By : ' . $_SESSION["username"], 0, 4, 'C', 0);
$pdf->Output();

?>