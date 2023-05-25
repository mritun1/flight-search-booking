<?php 
include "../db/connect.php";

// business_class START
// Open CSV file
$csvFile = fopen('data.csv', 'r');
// Loop through CSV data
$i = 0;
while (($row = fgetcsv($csvFile)) !== false) {
    // Construct INSERT query
   $i++;
   if($i>1 && $i < 100){
    //echo $row[10] . '<br/>';
    //mysqli_query($conn,"INSERT INTO flight_prices(airline, source, destination, routes, dep_time, arr_time, duration, total_stops, additional_info, price) 
    //                                VALUES('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]')");
   }
}
// business_class END

//Close CSV file
fclose($csvFile);

?>