<?php 
require "app/db/connect.php"; 

if(isset($_POST['product_id']) && $_POST['product_id'] != ""){
    //SET COOKIE
    setcookie("product_id", $_POST['product_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("depart_date", $_POST['depart_date'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("return_date", $_POST['return_date'], time() + (86400 * 30), "/"); // 86400 = 1 day
    //CHECK IF LOGGED IN OR NOT
    $arr = array();
    if($user_loggedIn == 0){
        //header("Location:login");
        $arr['Code'] = 1;
    }else{
        //header("Location:pay");
        $arr['Code'] = 2;
    }
    echo json_encode($arr);
}

if(isset($_POST['add-to-order'])){
    $customer_name = $_POST['customer_name'];
    if($user_loggedIn != 0){

        $product_id = $_COOKIE['product_id'];
        $depart_date = $_COOKIE['depart_date'];
        $return_date = $_COOKIE['return_date'];
        $flight_prices = "SELECT airline,source,destination,dep_time,price FROM flight_prices WHERE id='$product_id' LIMIT 1";
        $flightData = mysqli_fetch_row(mysqli_query($conn,$flight_prices));

        //INSERT INTO ORDER
        mysqli_query($conn,"INSERT INTO orders(customer_id, customer_name, flight_no, departure, destination, departure_date, return_date, created) 
                                VALUES('$user_loggedIn','$customer_name','$flightData[0]','$flightData[1]','$flightData[2]','$depart_date','$return_date',NOW())");

        header("Location:order_list");
    }else{
        header("Location:/");
    }
}
?>