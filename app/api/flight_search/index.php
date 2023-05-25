<?php 
include "../../db/connect.php";
$arr = array();
if(isset($_POST['source']) && $_POST['source'] != "" || isset($_POST['destination']) && $_POST['destination'] != ""){
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $sort = $_POST['sort'];
    $sort_code = '';
    if($sort != 'normal'){
        $sort_code = 'ORDER BY '.$sort;
    }

    $flight_prices = "SELECT * FROM flight_prices WHERE source LIKE '%".$source."%' AND destination LIKE '%".$destination."%' ".$sort_code;
    $sql = mysqli_query($conn,$flight_prices);
    if(mysqli_num_rows($sql)>0){
        $data= array();
        while($row=mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }

        $arr[] = array(
            'Code' => 1,
            'Status' => '',
            'Data' => $data,
        );
    }else{
        $arr[] = array(
            'Code' => 0,
            'Status' => 'Sorry! No Result Found',
        );
    }
}else{
    $arr[] = array(
        'Code' => 0,
        'Status' => 'Sorry! please send POST request only',
    );
}

$json = json_encode($arr);
echo $json;
?>