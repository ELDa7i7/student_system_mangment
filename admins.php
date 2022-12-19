<style>
   a{
    text-decoration: none;
    color: #3a6cf4;
   } 
</style>
<link rel="stylesheet" href="style.css">

<?php 

session_start();
if (!isset($_SESSION['admins'])) {
    header("location: index.php");
    exit ;
}
?>
<h2><a href="students/add_student.php">add_student</a><br>
<a href="students/delete_student.php">delete_student</a> </h2>
<br> <br> <br>
<h2><a href="admins/add_admin.php">add_admin</a><br>
<a href="admins/delete_admin.php">delete_admin</a> </h2>
<br>
<br>

<h2>

    <a href="admins/logout_admins.php">logout</a>
</h2>
        