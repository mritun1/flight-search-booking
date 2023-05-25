<?php 
require "app/db/connect.php"; 

$output = array(
    "code" => 0,
    "status" => "Please, Don't Leave empty field."
);

if(isset($_POST['email']) && $_POST['email'] != "" ||
    isset($_POST['password']) && $_POST['password'] != "" ||
    isset($_POST['confirm_password']) && $_POST['confirm_password'] != "" ||
    isset($_POST['full_name']) && $_POST['full_name'] != "" 
){
     
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = $_POST['full_name'];
    //CHECK IF THE TWO GIVEN PASSWORD MATCHES
    if($password != $confirm_password){
        //PASSWORD NOT MATCHING
        $output['status'] = "Your Password doesn't match!";
    }else{
        $output['code'] = 1;
        $output['status'] = "Your registration success.";
        //INSERTING VALUES
        mysqli_query($conn,"INSERT INTO users(email, password, full_name, created) 
                                VALUES('$email','$password','$full_name',NOW())");
    }
}

if(isset($_POST['log_email']) && $_POST['log_email'] != "" ||
    isset($_POST['log_password']) && $_POST['log_password'] != ""
){
    $email = $_POST['log_email'];
    $password = $_POST['log_password'];
    //CHECK IF THE TWO GIVEN PASSWORD MATCHES
    $qlpass = "SELECT id FROM users WHERE email='$email'  LIMIT 1";
    $sql = mysqli_query($conn,$qlpass);

    if(mysqli_num_rows($sql)>0){
        //SET COOKIE
        $output['status'] = "Logged in success";
        $sqRow = mysqli_fetch_row($sql);
        setcookie("user_id", $sqRow[0], time() + (86400 * 30), "/"); // 86400 = 1 day
        //GO FOR PAY
        if(isset($_COOKIE['product_id']) && $_COOKIE['product_id'] != "no"){
            //GO TO PAY
            $output['code'] = 2;
        }else{
            $output['code'] = 1;
        }
    }else{
        $output['status'] = "Sorry! Your details Not match.";
    }
}

$out = json_encode($output);
echo $out;

?>