<h1>add student</h1> 
<link rel="stylesheet" href="../style.css"> 
<style>
h1{color: #3a6cf4;}</style>
<?php 
include '../conn.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: index.php");
}
$errors = [];
if(isset($_POST['submit'])) 
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $group = $_POST['groups'];
    
    // username validate
    if(empty($username)) 
    {
        $errors[] = "please write username";
    }
    elseif(strlen($username)>20) 
    {
        $errors[] = "name must be less than 20 chars";
    }
    elseif (preg_match("![0-9/.,;'\\\[\]]!", $username))  {
        $errors = "name must not contain numbers or weird stuff";
    }

    // phone validate
    $s = "SELECT phone FROM students where phone= $phone" ;
    $q = $conn->prepare($s);
    $q->execute();
    $data= $q->fetch();

    if(empty($phone)) 
    {
        $errors[] = "please write phone number";
    }
    elseif($data) 
    {
        $errors[] ="duplicate phone number please write another";
        $_POST['phone'] = '';
    }

   
    
    
   

  
    
    
    // insert or error
    if(empty($errors))
     {
        
        $sql = "INSERT INTO students (name,phone)VALUES('$username','$phone')";
        $q = $conn->prepare($sql);
        $res=$q->execute();
        if($res) {
            $s = "SELECT id FROM students WHERE phone = $phone ";
            $q = $conn->prepare($s);
            $q->execute();
            $id = $q->fetch();
            $id=  $id['id'] ; // why ?
            $sql = "INSERT INTO groups (group_name,sid) VALUES ('$group','$id')";
            $q = $conn->prepare($sql);
            $q->execute();

        }
        $_POST['username'] = '';
        $_POST['phone'] = '';
        


     }
     


   

}




foreach ($errors as $error)
 {
    echo $error ."<br>";
 }

?>

<form action="add_student.php" method="post">
<!-- username -->
<label for="username">username</label>
<input type="text" name="username" id="username" value=
"<?php
if(isset($_POST['username']))
{
    echo $_POST['username'];
}
?>">
<!-- phone -->
<label for="phone">phone</label>
<input type="tel" pattern="^01[0-2,5]{1}[0-9]{8}$" name="phone" id="phone"
value=
"<?php
if(isset($_POST['phone']))
{
    echo $_POST['phone'];
}
?>">

<!-- group -->
<label for="groups">Choose a group:</label>
<select name="groups" id="groups" >
  <option value="elsoubki">elsoubki</option>
  <option value="abd_elgfar">abd elgfar</option>
  <option value="infinity">infinity</option>
</select>

<!-- send -->
    <input type="submit" value="add student" name="submit">
</form>