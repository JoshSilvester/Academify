<!DOCTYPE html>
<html lang="en">

<?php 
require("../connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $idstudent = $_POST['id_student'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $usertype = $_POST['usertype'];

    $targetDirectory = "../student_foto/";
    $profile_pic = $_FILES['profile_pic']['name'];
    $temp_profile_pic = $_FILES['profile_pic']['tmp_name'];
    $target_path = $targetDirectory . $profile_pic;

    if (empty($name) || empty($idstudent) || empty($username) || empty($email) || empty($class) || empty($profile_pic || empty($usertype))) {
        echo "<script>alert('Please fill in all fields');</script>";
    } else {
        $check_query = "SELECT * FROM user WHERE username = '$username'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $insert_query = "INSERT INTO user (name, id_user, username, password, email_user, class, profile_picture, usertype) VALUES ('$name', '$idstudent', '$username', '$password', '$email', '$class', '$profile_pic', '$usertype')";
            if (mysqli_query($con, $insert_query)) {
                if (move_uploaded_file($temp_profile_pic, $target_path)) {
                    echo "<script>alert('Registration successful');</script>";
                    header("");
                } else {
                    echo "<script>alert('Error uploading profile picture');</script>";
                }
            } else {
                echo "<script>alert('Error registering user');</script>";
            }
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        
        <div class="left">
            <a href="../teacherpage/mainpage.php" class="registerback-to-mainpage">Back to Menu</a>
            <img src="../image_ku/sekolah.jpg" alt="Gambar Sekolah">
        </div>
        <div class="right">
            <div class="logo">
                <img src="../image_ku/logosekolah.jpg" alt="Logo 1">
            </div>
            <div class="login-box">
                <h2>Register</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <div class="input-box">
                        <label for="name">Student Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="input-box">
                        <label for="name">Student id:</label>
                        <input type="number" id="id" name="id_student" required>
                    </div>
                    <div class="input-box">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-box">
                        <label for="password">password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-box">
                        <label for="email">Student Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-box select-box">
                        <label for="class">Class:</label>
                        <select id="class" name="class" required>
                            <option value="">Pilih Kelas</option>
                            <option value="ipa1">IPA 1</option>
                            <option value="ipa2">IPA 2</option>
                            <option value="ipa3">IPA 3</option>
                            <option value="ipa4">IPA 4</option>
                        </select>
                    </div>
                    <div class="input-box select-box">
                        <label for="class">Usertype:</label>
                        <select id="class" name="usertype" required>
                            <option value="">Type User</option>
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="profile_pic">Profile Picture:</label>
                        <input type="file" id="profile_pic" name="profile_pic" accept="image/*" required>
                    </div>
                    <input type="submit" name="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
