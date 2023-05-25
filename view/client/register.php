<?php
require "../../app/db/connect.php";
if($user_loggedIn==1){
    header("Location:/flight");
}
?>
<?php include "head.php"; ?>
    <h2>Register</h2>

      <span id="status"></span>
   
      <input type="email" id="email" placeholder="Email" required>
      <input type="password" id="password" placeholder="Password" required>
      <input type="password" id="confirm_password" placeholder="Confirm Password" required>
      <input type="text" id="full_name" placeholder="Full Name" required>
      <input type="submit" onclick="register()" value="Register">
    
    <div class="form-divider">or</div>
    <div class="log">
        <a href="login">
            <button>Login</button>
        </a>
    </div>

     <script>
        
        function register() {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let confirm_password = document.getElementById("confirm_password").value;
            let full_name = document.getElementById("full_name").value;

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                const parse = JSON.parse(this.responseText);
                console.log(parse);
                if(parse['code'] == 1){
                    window.location.href = "login?status=log";
                }
                document.getElementById("status").innerHTML = `<div style="color:red;">
                                                                <p ><strong>Note:</strong> `+parse['status']+`</p>
                                                            </div>`;
            }
            xhttp.open("POST", "functions.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("email="+email+"&password="+password+"&confirm_password="+confirm_password+"&full_name="+full_name);
        }
    </script>

<?php include "foot.php"; ?>