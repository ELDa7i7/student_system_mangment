<h1>login for admins</h1>
<style>
h1{color: #3a6cf4;}</style>


<?php 
include '../conn.php';
session_start();
if(isset($_SESSION['admins']))
{
    header("location:../admins.php");
}
$errors = [];
if(isset($_POST['submit'])) 
{
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    
    
    // username validate
   
    

    

    //password validate 
    if(empty($password)) 
    {
        $errors[] = "please write pass$password";
    }
    
   

    // email  validate
    if(empty($email)) 
    {
        $errors[] = "please write email";
    }
    if (empty($errors)) {

        $s = "SELECT * FROM admins where email= '$email'";
        $q = $conn->prepare($s);
        $q->execute();
        $data = $q->fetch();


        if (!$data) {
            $errors[] = "error in login";

        } else {
            $password_hash = $data['password'];
            if (!password_verify($password, $password_hash)) {
                $errors[] = "error in login";
            } else {
                $_SESSION['admins'] =
                    [
                        'name' => $data['name'],
                        'email' => $email
                    ];
                $_POST['email'] = "";
                $_POST['password'] = "";
                header("location:../admins.php");
            }

        }
    }
    

   
    
    
   

  
    
    
  
   
     


   

}




foreach ($errors as $error)
 {
    echo $error ."<br>";
 }

?>

<form action="" method="post">

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
    <input type="submit" value="login" name="submit">
</form>