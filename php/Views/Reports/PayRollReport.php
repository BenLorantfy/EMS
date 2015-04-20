<?php
//FILE			: PayRollReport.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: Pay Roll Report. generates a report in pdf format using FPDF library 
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
$pdf->SetFont('courier', '', 11);
$pdf->SetFillColor(255,255,102);
$pdf->SetY($y_axis_initial);
$max = 25;
$i = 0;

$pdf->SetX(20);
$pdf->SetFont('courier', '', 11);
$pdf->SetFont('','UB');
$pdf->Cell(32, 4, 'Payroll Report', 0, 0, 'C', 1);
$pdf->SetFont('','');
$pdf->SetFont('courier', '', 11);

/**************************************************************
***                                                         ***
***                      Full Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->SetX(37);
$pdf->MultiCell(138,5,'FullTime',1,'C', false);
$pdf->SetX(37);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
$pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
$pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, fulltimeemployee.dateOfHire, fulltimeemployee.salary,
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
        $pdf->SetX(37);
        $pdf->MultiCell(111,5,'FullTime',1,'C', false);
        $pdf->SetX(37);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
        $pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $hours = $row['(timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)'];
    $salary = $row['salary'];
    $gross = $salary / 52;
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(37);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(20, 5, " ".$hours, 1, 0, 'C', 0);
    $pdf->Cell(25, 5, $gross, 1, 0, 'R', 0);
    $pdf->Cell(55, 5, '', 1, 0, 'L', 0); //notes
    $pdf->SetX(37);
    
    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Part Time                         
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(37);
$pdf->MultiCell(138,5,'PartTime',1,'C', false);
$pdf->SetX(37);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
$pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
$pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);


 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, parttimeemployee.dateOfHire, parttimeemployee.hourlyRate, 
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
        $pdf->SetX(37);
        $pdf->MultiCell(111,5,'PartTime',1,'C', false);
        $pdf->SetX(37);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
        $pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $hours = $row['(timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)'];
    
    $hourlyRate = $row['hourlyRate'];
    
    if ($hours < 40)
    {
        $gross = $hours * $hourlyRate;
    }
    else
    {
        $gross = (40 * $hourlyRate) + (($hours - 40) * ($hour1yRate * 1.5));
    }
        
    // hours work(40) x hourly rate plus hours >40;
    $pdf->Ln($lineBreak);                
    $pdf->SetX(37);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(20, 5, " ".$hours, 1, 0, 'C', 0);
    $pdf->Cell(25, 5, $gross, 1, 0, 'R', 0);
    $pdf->Cell(55, 5, '', 1, 0, 'L', 0); // notes
    $pdf->SetX(37);

    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Seasonal                        
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(37);
$pdf->MultiCell(138,5,'Seasonal',1,'C', false);
$pdf->SetX(37);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
$pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
$pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);

 $result = mysqli_query( $db, "SELECT person.lastName, person.firstName, seasonalemployee.seasonYear, seasonalemployee.piecePay,
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
        $pdf->SetX(37);
        $pdf->MultiCell(111,5,'Seasonal',1,'C', false);
        $pdf->SetX(37);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
        $pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $hours = $row['(timecard.monday + timecard.tuesday + timecard.wednesday + timecard.thursday 
                                + timecard.friday + timecard.saturday + timecard.sunday)'];
    $piecePay = $row['piecePay'];
    
    $gross = $piecePay * $hours;
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(37);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(20, 5, " ".$hours, 1, 0, 'C', 0);
    $pdf->Cell(25, 5, $gross, 1, 0, 'R', 0);
    $pdf->Cell(55, 5, '', 1, 0, 'L', 0); // notes
    $pdf->SetX(37);

    $i = $i + 1;

}
/**************************************************************
***                                                         ***
***                      Contractor                        
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->Ln($lineBreak);
$pdf->SetX(37);
$pdf->MultiCell(138,5,'Contract',1,'C', false);
$pdf->SetX(37);
$pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
$pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
$pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);


$result = mysqli_query( $db, "SELECT company.companyName, contractor.contractStartDate, contractor.contractStopDate
                                FROM company
                                LEFT JOIN contractor
                                ON company.id=contractor.company_id
                                ORDER BY company.companyName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->Ln($lineBreak);
        $pdf->SetX(37);
        $pdf->MultiCell(111,5,'Seasonal',1,'C', false);
        $pdf->SetX(37);
        $pdf->Cell(38, 5, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(20, 5, 'Hours', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Gross', 1, 0, 'C', 0);
        $pdf->Cell(55, 5, 'Notes', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
   
    $StartDate = ['contractStartDate'];
    $StopDate = ['contractStopDate'];
    
    $fixexContractAmount = $row['fixexContractAmount'];
                    
    $gross = (($fixexContractAmount * 7)/($StopDate - $StartDate));
    $pdf->Ln($lineBreak);                
    $pdf->SetX(37);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(20, 5, "--", 1, 0, 'C', 0);
    $pdf->Cell(25, 5, $gross, 1, 0, 'R', 0);
    $pdf->Cell(55, 5, '', 1, 0, 'L', 0); // notes
    $pdf->SetX(37);

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

