<?php 
setcookie("user_id", "", time() + (86400 * 30), "/");
header("Location:/flight");
?>