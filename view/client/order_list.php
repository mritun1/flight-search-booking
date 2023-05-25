<?php
require "../../app/db/connect.php";
if($user_loggedIn==0){
    header("Location:login");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Flight Ticket Order List</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="text-center mt-5">Flight Ticket Order List</h1>

    <div>
        <a href="/flight">
            <button type="button" class="btn btn-primary">Go Back</button>
        </a>
    </div>
  
    <table class="table mt-4">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer Name</th>
          <th>Flight Number</th>
          <th>Departure</th>
          <th>Destination</th>
          <th>Departure time</th>
          <th>Return time</th>
        </tr>
      </thead>
      <tbody>

        <?php 
        $flight_prices = "SELECT * FROM orders WHERE customer_id='$user_loggedIn' ORDER BY id DESC";
        $sql = mysqli_query($conn,$flight_prices);
        if(mysqli_num_rows($sql)>0){
            while($row=mysqli_fetch_assoc($sql)){
                echo '<tr>
                      <td>0A23Z'.$row['id'].'</td>
                      <td>'.$row['customer_name'].'</td>
                      <td>'.$row['flight_no'].'</td>
                      <td>'.$row['departure'].'</td>
                      <td>'.$row['destination'].'</td>
                      <td>'.$row['departure_date'].'</td>
                      <td>'.$row['return_date'].'</td>
                    </tr>';
            }
        }
        ?>

        <!-- Add more rows for additional ticket orders -->
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>