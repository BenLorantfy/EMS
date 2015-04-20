<?php
//FILE			: InactiveEmployementReport.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: inactive Employment Report. generates a report in pdf format using FPDF library 
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
$pdf->Cell(60, 4, 'Inactive Employment Report', 0, 0, 'C', 1);
$pdf->SetFont('','');
$pdf->SetFont('Courier', '', 11);

/**************************************************************
***                                                         ***
***                      Full Time                        
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->SetX(30);
$pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
$pdf->Cell(30, 5, 'Hired', 1, 0, 'C', 0);
$pdf->Cell(30, 5, 'Terminated', 1, 0, 'C', 0);
$pdf->Cell(25, 5, 'Type', 1, 0, 'C', 0);
$pdf->Cell(52, 5, 'Reason for leaving', 1, 0, 'C', 0);


$result = mysqli_query( $db, "SELECT person.lastName, person.firstName, fulltimeemployee.dateOfHire, fulltimeemployee.dateOfTermination,
                                employee.reasonForLeaving
                                FROM person
                                LEFT JOIN fulltimeemployee
                                ON person.id=fulltimeemployee.employee_id
                                LEFT JOIN employee
                                ON person.id=employee.person_id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->SetX(30);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(30, 5, 'Hired', 1, 0, 'C', 0);
        $pdf->Cell(30, 5, 'Terminated', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(52, 5, 'Reason for leaving', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $dateOfHire = $row['dateOfHire'];
    $dateOfTerm = $row['dateOfTermination'];
    $reasonForLeaving = $row['reasonForLeaving'];
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(30);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(30, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(30, 5, " ".$dateOfTerm, 1, 0, 'L', 0);
    $pdf->Cell(25, 5, 'FullTime', 1, 0, 'R', 0);
    $pdf->Cell(52, 5, $reasonForLeaving, 1, 0, 'R', 0);
    $pdf->SetX(30);

    $i = $i + 1;

}

/**************************************************************
 ***                                                         ***
 ***                      Part Time                        
 ***                                                         ***
 **************************************************************/

$result = mysqli_query( $db, "SELECT person.lastName, person.firstName, parttimeemployee.dateOfHire, parttimeemployee.dateOfTermination,
                                employee.reasonForLeaving
                                FROM person
                                LEFT JOIN parttimeemployee
                                ON person.id=parttimeemployee.employee_id
                                LEFT JOIN employee
                                ON person.id=employee.person_id
                                ORDER BY person.lastName;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->SetX(30);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(30, 5, 'Hired', 1, 0, 'C', 0);
        $pdf->Cell(30, 5, 'Terminated', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(52, 5, 'Reason for leaving', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['lastName'] .", ".  $row['firstName'];
    $dateOfHire = $row['dateOfHire'];
    $dateOfTerm = $row['dateOfTermination'];
    $reasonForLeaving = $row['reasonForLeaving'];
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(30);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(30, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(30, 5, " ".$dateOfTerm, 1, 0, 'L', 0);
    $pdf->Cell(25, 5, 'PartTime', 1, 0, 'R', 0);
    $pdf->Cell(52, 5, $reasonForLeaving, 1, 0, 'R', 0);
    $pdf->SetX(30);

    $i = $i + 1;

}

/**************************************************************
 ***                                                         ***
 ***                      Contract                        
 ***                                                         ***
 **************************************************************/

$result = mysqli_query( $db, "SELECT company.companyName, contractor.contractStartDate, contractor.contractStopDate,
                                employee.reasonForLeaving
                                FROM company
                                LEFT JOIN contractor
                                ON company.id=contractor.company_id
                                LEFT JOIN employee
                                ON company.id=employee.company_id;"); 

while($row = mysqli_fetch_array($result))
{
    
    
    if ($i == $max)
    {
        $pdf->AddPage(); 
        $pdf->SetX(30);
        $pdf->Cell(38, 5, 'Employee Name', 1, 0, 'C', 0);
        $pdf->Cell(30, 5, 'Hired', 1, 0, 'C', 0);
        $pdf->Cell(30, 5, 'Terminated', 1, 0, 'C', 0);
        $pdf->Cell(25, 5, 'Type', 1, 0, 'C', 0);
        $pdf->Cell(52, 5, 'Reason for leaving', 1, 0, 'C', 0);
        $i = 0;
    }
    
    $name = $row['companyName'];
    $dateOfHire = $row['contractStartDate'];
    $dateOfTerm = $row['contractStopDate'];
    $reasonForLeaving = $row['reasonForLeaving'];
    
    $pdf->Ln($lineBreak);                
    $pdf->SetX(30);
    $pdf->Cell(38, 5, " ".$name, 1, 0, 'L', 0);
    $pdf->Cell(30, 5, " ".$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(30, 5, " ".$dateOfTerm, 1, 0, 'L', 0);
    $pdf->Cell(25, 5, 'Contract', 1, 0, 'R', 0);
    $pdf->Cell(52, 5, $reasonForLeaving, 1, 0, 'R', 0);
    $pdf->SetX(30);

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