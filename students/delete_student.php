<h1>delete student</h1>
<style>
h1{color: #3a6cf4;}</style>
<?php
include('../conn.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: index.php");
}
if(isset($_POST['delete'])) 
{
    $name =$_POST['username'];
    $sql = "SELECT name FROM students where name= '$name'";
    $res = $conn->prepare($sql);
    $res->execute();
    $data = $res->fetch();
    if($data)
     {
        $sql = "delete from students where name='$name'";
        $res = $conn->prepare($sql);
        $res->execute();
        $count = $res->rowcount();
        if($count==0)
        {
            echo "failed";
        }else {
            echo "success !";
        }

     }else {
        echo "unknown student ";
     }
}
?>
<form action="" method="post">
    <label for="username">username</label>
    <input type="text" name="username" id="" >
    <input type="submit" value="delete" name="delete">
</form>