<?php 
include "app/db/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .search-container {
            margin-top: 20px;
        }

        .search-container .form-control {
            border-radius: 25px;
        }

        .search-container .btn-primary {
            border-radius: 25px;
        }

        .filters-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .filters-container .list-group-item {
            border-radius: 0;
        }

        .flight {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
        }

        .flight:hover {
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .flight .logo {
            width: 70px;
            height: 70px;
            margin-right: 20px;
        }

        .flight .details {
            flex: 1;
        }

        .flight .details h3 {
            font-size: 24px;
            margin-top: 0;
        }

        .flight .details p {
            margin: 5px 0;
        }

        .flight .price {
            font-size: 24px;
            font-weight: bold;
            color: #4285f4;
        }
        .price{
            margin-right:10px;
        }

        .flight .book-button {
            margin-top: 10px;
        }

        .not_found {
            text-align: center;
            padding: 20px;
            border:1px solid red;
            border-radius:6px;
            margin-top:40px;
        }
        .not_found > img {
            height: 60px;
            width:auto;
        }
    </style>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="row search-container" >
            <div class="col-12 col-md-3">
                <label for="departure">Departure:</label>
                <input type="text" id="departure" class="form-control" placeholder="City or airport">
            </div>
            <div class="col-12 col-md-3">
                <label for="destination">Destination:</label>
                <input type="text" id="destination" class="form-control" placeholder="City or airport">
            </div>
            <div class="col-12 col-md-3">
                <label for="depart-date">Departure date:</label>
                <input type="date" id="depart-date" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <label for="return-date">Return date:</label>
                <input type="date" id="return-date" class="form-control">
            </div>
        </div>
        <div style="padding: 10px;text-align: center;overflow:auto;">
            <button onclick="loadDoc('normal')" type="button" style="width: 180px;float: right;" class="btn btn-primary btn-block">Search flights</button>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 filters-container">
                <div class="log">

                    <?php 
                    if($user_loggedIn == 0){
                    ?>
                    <a href="login">
                        <button>Login</button>
                    </a>
                    <a href="register">
                        <button>Register</button>
                    </a>
                    <?Php 
                    }else{
                    ?>
                    <p>Hi, <?php echo $fullName; ?></p>
                    <a href="order_list">
                        <button>My Order</button>
                    </a>
                    <a href="logout.php?Logout=ok">
                        <button style="background-color:red;">Logout</button>
                    </a>
                    <?php } ?>

                </div>
                <h2>Filters</h2>
                <ul class="list-group">
                    <li class="list-group-item"><a onclick="loadDoc('price')" href="#">Sort by price</a></li>
                    <li class="list-group-item"><a onclick="loadDoc('dep_time')" href="#">Sort by departure time</a></li>
                    <li class="list-group-item"><a onclick="loadDoc('arr_time')" href="#">Sort by arrival time</a></li>
                    <li class="list-group-item"><a onclick="loadDoc('duration')" href="#">Sort by duration</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-9">
                <span id="list">

                    

                    <?php 
                    $flight_prices = "SELECT * FROM flight_prices LIMIT 10";
                    $sql = mysqli_query($conn,$flight_prices);
                    if(mysqli_num_rows($sql)>0){
                        while($row=mysqli_fetch_assoc($sql)){
                            echo '<div class="flight">
                                    <div class="d-flex align-items-center">
                                        <img src="app/icons/airplane.png" alt="Airline Logo" class="logo">
                                        <div class="details">
                                            <h3>'.$row['airline'].'</h3>
                                            <p><span class="badge badge-secondary">'.$row['total_stops'].'</span> <span
                                                    class="badge badge-secondary">'.$row['duration'].'</span></p>
                                            <p><strong>Departure:</strong> '.$row['source'].' - '.$row['dep_time'].'</p>
                                            <p><strong>Arrival:</strong> '.$row['destination'].' - '.substr($row['arr_time'],0,6).'</p>
                                            <p><strong>Info:</strong> ('.$row['routes'].'), '.$row['additional_info'].'</p>
                                        </div>
                                        <div class="price">Rs.'.$row['price'].'/-</div>
                                        <button onclick="book('.$row['id'].')" class="btn btn-primary book-button">Book now</button>
                                    </div>
                                </div>';
                        }
                    }
                    ?>
                </span>

            </div>
        </div>
    </div>

    <script>

        function book(e){
            let product_id = e;
            let depart_date = document.getElementById("depart-date").value;
            let return_date = document.getElementById("return-date").value;

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                const parse = JSON.parse(this.responseText);
                if(parse['Code'] == 1){
                    window.location.href = "login";
                }else{
                    window.location.href = "pay";
                }
            }
            xhttp.open("POST", "addcart.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("product_id=" + product_id + "&depart_date=" + depart_date + "&return_date=" + return_date);

        }
        
        function loadDoc(e) {
            let departure = document.getElementById("departure").value;
            let destination = document.getElementById("destination").value;

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                const parse = JSON.parse(this.responseText);
                if(parse[0]['Code'] == 1){
                    let cont = parse[0]['Data'];
                    let contList = '';
                    for(let i=0;i<cont.length;i++){
                        console.log(cont[i]);
                        contList += `<div class="flight">
                                    <div class="d-flex align-items-center">
                                        <img src="app/icons/airplane.png" alt="Airline Logo" class="logo">
                                        <div class="details">
                                            <h3>`+cont[i]['airline']+`</h3>
                                            <p><span class="badge badge-secondary">`+cont[i]['total_stops']+`</span> <span
                                                    class="badge badge-secondary">`+cont[i]['duration']+`</span></p>
                                            <p><strong>Departure:</strong> `+cont[i]['source']+` - `+cont[i]['dep_time']+`</p>
                                            <p><strong>Arrival:</strong> `+cont[i]['destination']+` - `+cont[i]['arr_time'].substr(0, 6)+`</p>
                                            <p><strong>Info:</strong> (`+cont[i]['routes']+`), `+cont[i]['additional_info']+`</p>
                                        </div>
                                        <div class="price">Rs. `+cont[i]['price']+`/-</div>
                                        <button onclick="book(`+cont[i]['id']+`)" class="btn btn-primary book-button">Book now</button>
                                    </div>
                                </div>`;
                    }
                    document.getElementById("list").innerHTML = contList;
                }else{
                    document.getElementById("list").innerHTML = `<div class="not_found">
                            <img src="https://www.ecommerce-nation.com/wp-content/uploads/2018/10/404-error.jpg" alt="">
                            <h1>Content not found.</h1>
                            <p>Sorry! no content is matching.</p>
                        </div>`;
                }
            }
            xhttp.open("POST", "app/api/flight_search/");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("soruce="+departure+"&destination="+destination+"&sort="+e);
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>