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

$db = mysqli_connect("localhost","root","root", "EMS");
if (!$db)
  {
  die('Could not connect: ' . mysqli_error($db));
  }

mysqli_query($db,"Use EMS" );

 $result = mysqli_query( $db, "SELECT * FROM person"); 
 
// full time
echo "<u><mark>Active Employment Report</mark></u>";
echo "<table border='1'>
<th colspan='3'>FullTime</th>
<tr>
<th>&nbsp; Employee Name &nbsp;</th>
<th>&nbsp; Date of Hire &nbsp;</th>
<th>&nbsp; Avg. Hours &nbsp;</th>
</tr>";

    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>&nbsp;&nbsp;" . $row['lastName'] .", ".  $row['firstName'] . "</td>";
        echo "<td>&nbsp;&nbsp;" . $row['dateOfHire'] . "</td>";
        echo "<td>&nbsp;&nbsp;" . $row[''] . "</td>";
        echo "</tr>";
    }
    echo "</table>";


    
    
    echo "Date Generated: " . date("Y-m-d") . "<br>";
    echo "<div style='text-indent: 4em;'> Run By :</div>"; 
mysqli_close($db);

?>

</body>
</html>