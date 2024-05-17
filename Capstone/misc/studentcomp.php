<!DOCTYPE html>
<html lang="en">

<?php 
require("../connection/connection.php");
 
session_name('student_session');
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['student'])) {
  header("Location:../login/login.php");
}

if(isset($_POST['student_logout'])){
    unset($_SESSION['student']);
    session_destroy();
    header("Location:../login/login.php");
}


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/student_MainPageNew.css">
</head>
<body>
        <header>
        <div class="logo">
            <a href="../studentpage/mainpage.php">
                <img src="../image_ku/logosekolah.jpg" alt="Logo Sekolah">
            </a>
        </div>

        <div class="profile" id="profile">
            <span class="username"><?php echo $_SESSION['student']; ?></span>
            <?php
            $name = $_SESSION['student'];

            $profile_query = "SELECT profile_picture FROM user WHERE name = '$name'";
            $profile_result = mysqli_query($con, $profile_query);

            if (mysqli_num_rows($profile_result) > 0) {
                $row = mysqli_fetch_assoc($profile_result);
                $profile_pic = $row['profile_picture'];
                if (!empty($profile_pic)) {
                    echo '<img src="../student_foto/' . $profile_pic . '" alt="Profile Picture" class="profile-pic">';
                } else {
                    echo '<img src="../student_foto/default_profile_pic.png" alt="Default Profile Picture" class="profile-pic">';
                }
            } else {
                echo '<img src="../student_foto/default_profile_pic.png" alt="Default Profile Picture" class="profile-pic">';
            }
            ?>
            <div class="dropdown-content">
                <a href="../studentpage/profile.php" >View Profile</a>
                <div class="logout_student">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="student_logout" class="log-out-StudentPage" >Log Out</button>
                </form>
                </div>
            </div>
        </div>

    </header>

</body>
</html>