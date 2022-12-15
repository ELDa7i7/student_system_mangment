<?php
$db = "students_system_management";
$user = "root";
$pass = "";


try {
    $conn = new PDO("mysql:host=localhost;dbname=$db", $user, $pass);
   


}
catch (Exception $e) 
{
    echo $e->getMessage();

}