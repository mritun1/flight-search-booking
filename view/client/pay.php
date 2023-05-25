<?php
require "../../app/db/connect.php";
if($user_loggedIn==0){
    header("Location:login");
}
if(isset($_COOKIE['product_id']) && $_COOKIE['product_id'] == "no"){
    header("Location:/flight");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Flight Booking - Payment</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .payment-form {
      max-width: 500px;
      margin: 0 auto;
      margin-top: 50px;
    }
    
    .form-control.invalid {
      border-color: #dc3545;
      padding-right: calc(1.5em + .75rem);
      background-image: url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/icons/exclamation-circle-fill.svg');
      background-repeat: no-repeat;
      background-position: right calc(.375em + .1875rem) center;
      background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="payment-form">
      <h3 class="text-center">Proceed your Payment</h3>
      <div>
        <a href="/flight">
            <button type="button" class="btn btn-primary">Go Back</button>
        </a>
    </div>
    <br/>

      <form action="addcart.php" method="post">

        <div class="form-group">
          <label for="card-number">Customer Names (with comma separated)</label>
          <input type="text" class="form-control" name="customer_name" required>
        </div>

        <hr/>

        <div class="form-group">
          <label for="card-number">Card Number</label>
          <input type="text" class="form-control" name="card_number" required>
        </div>
        <div class="form-group">
          <label for="card-name">Cardholder Name</label>
          <input type="text" class="form-control" name="card_name" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="expiry-date">Expiry Date</label>
            <input type="text" class="form-control" name="expiry_date" required>
          </div>
          <div class="form-group col-md-6">
            <label for="cvv">CVV</label>
            <input type="text" class="form-control" name="cvv" required>
          </div>
        </div>
        <button type="submit" name="add-to-order" class="btn btn-primary btn-block">Pay Now</button>
      </form>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>