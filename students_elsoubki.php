<?php
include('conn.php');
session_start();
$sql = "SELECT phone , name , group_name FROM students INNER JOIN groups on id=sid  where group_name='elsoubki'";
$q = $conn->prepare($sql);
$q->execute();
$students = $q->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>students</title>
</head>

<body>
    <link rel="stylesheet" href="style.css">
    <table class="styled-table">
        <thead>
            <tr>
                <th>name</th>
                <th>group</th>
                <?php if (isset($_SESSION['admins'])) { ?>
                <th>phone</th>
                <?php
            } ?>
        </thead>

        </tr>
        <?php
        foreach ($students as $student) : ?>
        <tr>
            <td>
                <?php echo $student['name'] ?>
            </td>
            <td>
                <?php echo $student['group_name'] ?>
            </td>
            <?php 
                if (isset($_SESSION['admins'])) {
                
                     ?>
                    <td>
                    <?php   echo $student['phone']; }?>
            </td>
        </tr>
        <?php endforeach ?>




    </table>
</body>

</html>