<!DOCTYPE html>
<html lang="en">

<?php 
session_name('teacher_session');
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['teacher'])) {
  header("Location:../login/login.php");
}

if(isset($_POST['teacher_logout'])){
    unset($_SESSION['teacher']);
    session_destroy();
    header("Location:../login/login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>