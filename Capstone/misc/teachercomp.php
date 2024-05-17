<!DOCTYPE html>
<html lang="en">

<?php
require("../connection/connection.php");

session_name('teacher_session');
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['teacher'])) {
    header("Location:../login/login.php");
}

if (isset($_POST['teacher_logout'])) {
    unset($_SESSION['teacher']);
    session_destroy();
    header("Location:../login/login.php");
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header_ADMIN_new.css">
    <title>Document</title>

</head>

<body>

</html>
<header >
    <div class="logo">
        <a href="javascript:location.reload(true)">
            <img src="../image_ku/logosekolah.jpg" alt="Logo Sekolah">
        </a>
    </div>
    <table class="menu-table">
    <tr>
        <td><a href="../teacherpage/studentdata.php">Student</a></td>
        <td><a href="../teacherpage/mainpage.php">Material</a></td>
        <td><a href="../teacherpage/learnpage.php">Learning Path</a></td>
        <td><a href="../signin/register.php">Register User  </a></td>
    </tr>
</table>
    <div class="profile" id="profile">
        <div class="logout">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="teacher_logout">Log Out</button>
            </form>
        </div>
    </div>
</header>






</body>