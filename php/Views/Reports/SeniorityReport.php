<?php
//FILE			: SeniorityReport.php
//PROJECT		: INFO2030-15W - Software Quality II - Final Project EMS
//PROGRAMMER	: Dev Til Death: Grigoriy Kozyrev, Ben Lorantfy, Michael L. Da Silva, Kevin Li
//FIRST VERSION	: 4/04/2015
//DESCRIPTION	: Seniority Report. generates a report in pdf format using FPDF library
//                and Mysql Query calls
namespace Reports;
use Helper\FPDF\FPDF;

// MySql setup
$db = mysqli_connect("localhost","root","Conestoga1", "ems");
if (!$db)
  {
  die('Could not connect: ' . mysqli_error($db));
  }

mysqli_query($db,"Use EMS" );

// fpdf Setup
$y_axis_initial = 10;
$lineBreak = 5;
$pdf = new FPDF();
$pdf->Open();
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Courier', '', 10);
$pdf->SetFillColor(255,255,102);
$pdf->SetY($y_axis_initial);
$max = 25;
$i = 0;

$pdf->SetX(21);
$pdf->SetFont('Courier', '', 10);
$pdf->SetFont('','UB');
$pdf->Cell(34, 4, 'Seniority Report', 0, 0, 'C', 1);
$pdf->SetFont('','');
$pdf->SetFont('Courier', '', 10);

/**************************************************************
***                                                         ***
***                      Table
***                                                         ***
**************************************************************/
$pdf->Ln($lineBreak);
$pdf->SetX(15);
$pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
$pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
$pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
$pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
$pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);




 $result = mysqli_query( $db, "SELECT CONCAT(firstName, ', ', lastName) AS EmployeeName, SIN, 'FullTime' AS EmployeeType, dateOfHire FROM fulltimeemployee, person WHERE
(person.id = (SELECT employee.person_id FROM employee WHERE(employee.id = fulltimeemployee.employee_id)))
UNION ALL
SELECT CONCAT(firstName, ', ', lastName) AS EmployeeName, SIN, 'PartTime' AS EmployeeType, dateOfHire FROM parttimeemployee, person WHERE
(person.id = (SELECT employee.person_id FROM employee WHERE(employee.id = parttimeemployee.employee_id)))
UNION ALL
SELECT CONCAT(firstName, ', ', lastName) AS EmployeeName, SIN, 'Seasonal' AS EmployeeType, CONCAT(season, seasonYear) FROM seasonalemployee, person WHERE
(person.id = (SELECT employee.person_id FROM employee WHERE(employee.id = seasonalemployee.employee_id)))
UNION ALL
SELECT corporationName, buisnessNumber, 'Contract' AS EmployeeType, contractStartDate FROM contractor, company WHERE
(company.id = contractor.company_id)");

while($row = mysqli_fetch_array($result))
{


    if ($i == $max)
    {
        $pdf->AddPage();
        $pdf->Ln($lineBreak);
        $pdf->SetX(15);
        $pdf->Cell(38, 4, ' Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' SIN', 1, 0, 'L', 0);
        $pdf->Cell(26, 4, ' Type', 1, 0, 'L', 0);
        $pdf->Cell(35, 4, ' Date of Hire', 1, 0, 'L', 0);
        $pdf->Cell(55, 4, ' Years of Service', 1, 0, 'L', 0);

        $i = 0;
    }

    $name = $row['lastName'] .", ".  $row['firstName'];
    $SIN = $row['SIN'];
    $dateOfHire = $row['dateOfHire'];
	$employeeType = $row['EmployeeType'];

    $date1 = $dateOfHire;
    $date2 = date("Y-m-d");




    $diff = abs(strtotime($date2) - strtotime($date1));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    if ($years == 0)
    {
        if ($months == 0)
        {
            $YOS = $days." days";
        }

        else
        {
            $YOS = $months." month," .$days." days";
        }
    }

    else
    {
        $YOS = $years." years," .$months." month," .$days." days";
    }


    $pdf->Ln($lineBreak);
    $pdf->SetX(15);
    $pdf->Cell(38, 4, ' '.$name, 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$SIN, 1, 0, 'L', 0);
    $pdf->Cell(26, 4, ' '.$employeeType, 1, 0, 'L', 0);
    $pdf->Cell(35, 4, ' '.$dateOfHire, 1, 0, 'L', 0);
    $pdf->Cell(55, 4, ' '.$YOS, 1, 0, 'L', 0);
    $pdf->SetX(15);
    
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