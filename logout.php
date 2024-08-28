<?php
session_start();
session_destroy();  
header('location: login-critic.php');
?>