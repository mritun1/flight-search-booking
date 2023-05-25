<?php
require "../../app/db/connect.php";
if($user_loggedIn==1){
    header("Location:/flight");
}
?>
<?php include "head.php"; ?>

<h2>Login</h2>

    <?php if(isset($_GET['status']) && $_GET['status'] == 'log' ){ ?>

        <div style="color:green;">
            <p ><strong>Note:</strong> You are Registered Success, Please Login</p>
        </div>

    <?php } ?>

        <span id="status"></span>
    
      <input type="text" id="log_email" placeholder="Email" required>
      <input type="password" id="log_password" placeholder="Password" required>
      <input type="submit" onclick="login()" value="Login">
    
    <div class="form-divider">or</div>
    <div class="log">
        <a href="register">
            <button>Register</button>
        </a>
    </div>

    <script>
        
        function login() {
            let log_email = document.getElementById("log_email").value;
            let log_password = document.getElementById("log_password").value;

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                const parse = JSON.parse(this.responseText);
                console.log(parse);
                if(parse['code'] == 1){
                    window.location.href = "order_list";
                }
                if(parse['code'] == 2){
                    window.location.href = "pay";
                }
                document.getElementById("status").innerHTML = `<div style="color:red;">
                                                                <p ><strong>Note:</strong> `+parse['status']+`</p>
                                                            </div>`;
            }
            xhttp.open("POST", "functions.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("log_email="+log_email+"&log_password="+log_password);
        }
    </script>

<?php include "foot.php"; ?>
