<!DOCTYPE html>
<html>
<head>
<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php

$db = new mysqli('localhost', 'root', 'root', 'ems');
		if($db->connect_errno > 0){
			throw new Exception("Connect failed: " . $db->connect_error);
		}

mysqli_query($db,"Use EMS" );


 // $result = mysqli_query( $con, "SELECT * FROM customers ORDER by ".$column.";"); 
 $result = mysqli_query( $db, "SELECT * FROM person"); 
 
 
echo "<u><mark>Seniority Report</mark></u>";
echo "<table border='1'>
<tr>
<th>&nbsp; Employee Name &nbsp;</th>
<th>&nbsp; SIN &nbsp;</th>
<th>&nbsp; Type &nbsp;</th>
<th>&nbsp; Date of Hire &nbsp;</th>
<th>&nbsp; Years of Service &nbsp;</th>
</tr>";

    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>&nbsp;&nbsp;" . $row['lastName'] .", ".  $row['firstName'] . "</td>";
        echo "<td>&nbsp;&nbsp;" . $row['SIN'] . "</td>";
        echo "<td>&nbsp;&nbsp;" . $row['Type'] . "</td>";
        echo "<td>&nbsp;&nbsp;" . $row['dateOfHire'] . "</td>";
        echo "<td>&nbsp;&nbsp;" . $YearOfService . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    
    
    echo "Date Generated: " . date("Y-m-d") . "<br>";
    echo "<div style='text-indent: 4em;'> Run By :</div>"; 
mysqli_close($db);

?>

</body>
</html>