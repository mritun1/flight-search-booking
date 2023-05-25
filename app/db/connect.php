<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flight_search";

// $servername = "sql107.epizy.com";
// $username = "epiz_34168288";
// $password = "41oNbwLrT8s";
// $dbname = "epiz_34168288_flight_ticket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$user_loggedIn = 0;
$fullName = '';
if(isset($_COOKIE['user_id'])){

    $user_id = $_COOKIE['user_id'];
    $qlpass = "SELECT full_name FROM users WHERE id='$user_id' LIMIT 1";
    $sql = mysqli_query($conn,$qlpass);

    if(mysqli_num_rows($sql)>0){
        $user_loggedIn = 1;
        $sqlRow = mysqli_fetch_row($sql);
        $fullName = $sqlRow[0];
    }

}
?>