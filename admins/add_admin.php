<h1>add admin</h1>
<style>
h1{color: #3a6cf4;}</style>

<?php 
include '../conn.php';
session_start();
$errors = [];
if(isset($_POST['submit'])) 
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    
    
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

    //password validate 
    if(empty($password)) 
    {
        $errors[] = "please write pass$password";
    }
    elseif(strlen($password)>20) 
    {
        $errors[] = "password must be less than 20 chars";
    }
   


    // email validate
    $s = "SELECT email FROM admins where email= '$email'" ;
    $q = $conn->prepare($s);
    $q->execute();
    $data= $q->fetch();


    if(empty($email)) 
    {
        $errors[] = "please write email";
    }
    elseif($data) 
    {
        $errors[] ="duplicate email please write another";
        $_POST['email'] = '';
    }
    elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $errors [] = "invalid email";
    }

   
    
    
   

  
    
    
    // insert or error
    if(empty($errors))
     {
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins (name,email,password)VALUES('$username','$email','$password')";
        $q = $conn->prepare($sql);
        $q->execute();

        $_POST['username'] = '';
        $_POST['email'] = '';
        $_POST['password'] = '';
        


     }
     


   

}




foreach ($errors as $error)
 {
    echo $error ."<br>";
 }

?>

<form action="add_admin.php" method="post">
<!-- username -->
<label for="username">username</label>
<input type="text" name="username" id="username" value=
"<?php
if(isset($_POST['username']))
{
    echo $_POST['username'];
}
?>">
<!-- email -->
<label for="email">email</label>
<input type="text" name="email" id="email" value=
"<?php
if(isset($_POST['email']))
{
    echo $_POST['email'];
}?>">

<!-- password -->
<label for="password">password</label>
<input type="text" name="password" id="password" value=
"<?php
if(isset($_POST['password']))
{
    echo $_POST['password'];
}

?>"
>



<!-- send -->
    <input type="submit" value="add admin" name="submit">
</form>