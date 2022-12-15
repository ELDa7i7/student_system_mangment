
<?php
session_start();


unset($_SESSION['admins']);
header('location:login_admins.php');