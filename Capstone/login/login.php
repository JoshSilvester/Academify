<!DOCTYPE html>
<html lang="en">

<?php 
require("../connection/connection.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    // Prevent SQL Injection by using prepared statements
    $sql = "SELECT * FROM user WHERE BINARY username=? AND password=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if there's a match
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if($row["usertype"] == "teacher"){
            // Set session variables for admin user
            session_name('teacher_session');
            session_start();
            $_SESSION['teacher'] = $row['name'];
            header("location:../teacherpage/mainpage.php");
            exit();
        }
        elseif($row["usertype"] == "student"){
            session_name('student_session');
            session_start();
            $_SESSION['student']= $row['name'];
            header("location:../studentpage/mainpage.php");
            exit();
        }
    } else {
        echo "<script>alert('Username or password incorrect');</script>";
    }
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page </title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="left">
            <img src="../image_ku/sekolah.jpg" alt="Gambar Sekolah">
        </div>
        <div class="right">
            <div class="logo">
                <img src="../image_ku/logosekolah.jpg" alt="Logo 1">
            </div>
            <div class="login-box">
                <h2>Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="input-box">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="input-box">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <input type="submit" name="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>

</html>