<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/update_student.css">
    <title>Update Student Data</title>
</head>

<body>
    <?php
    require_once '../misc/teachercomp.php';
    $id = $_GET['id'];
    if (isset($_POST["submit"])) {
        $ids = $_POST['id_student'];
        $student_name = $_POST['student-name'];
        $student_pass = $_POST['student-pass'];
        $student_class = $_POST['class'];
        $student_id = $_POST['student-id'];
        $student_username = $_POST['username'];
        $usertype = $_POST['usertype'];
        $student_email = $_POST['emailUser'];
        $img_name = $_FILES['userfile']['name'];
        $img_type = $_FILES['userfile']['tmp_name'];
        $location = "../student_foto/";
        
        if ($_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
            // If there's already an image, delete it
            if (!empty($row['profile_picture'])) {
                $old_image_path = $location . $row['profile_picture'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
        
            // Move the new image
            $destination = $location . $img_name;
            move_uploaded_file($img_type, $destination);
        }
        
        $sql = "UPDATE user SET name = '$student_name', id_user = '$student_id', username = '$student_username', password = '$student_pass', email_user = '$student_email', class = '$student_class', profile_picture = '$img_name', usertype = '$usertype' WHERE id_user = '$id'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo
            '<script>
                if (confirm("Student Updated !")) {
                    window.location.href = "studentdata.php";
                }
            </script>';
        } else {
            echo "Update Fail";
        }
    }

    ?>
    <?php

    // show data related to GET

    $sql_chapter = "SELECT * FROM user WHERE id_user = '$id'";
    $result = mysqli_query($con, $sql_chapter);
    $row = mysqli_fetch_array($result);

    ?>
    <a href="../teacherpage/studentdata.php" class="back-link">Back</a>
    <div class="container">
        <h1>Update Student Data</h1>
        <form action="#" method="POST" class="update-form" id="update-form" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $row['usertype']; ?>" name="usertype" />
            <div class="form-group">
                <label for="student-id">Student ID:</label>
                <input type="number" id="student-id" name="student-id" placeholder="ID Siswa" value="<?php echo $id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="student-name">Nama:</label>
                <input type="text" id="student-name" name="student-name" placeholder="Nama lengkap" value="<?php echo $row['name']; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $row['username']; ?>">
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="text" id="Password" name="student-pass" placeholder="Password" value="<?php echo $row['password']; ?>">
            </div>
            <div class="form-group">
                <label for="student-email">Student Email:</label>
                <input type="text" id="student-email" name="emailUser" placeholder="Email Student" value="<?php echo $row['email_user']; ?>">
            </div>
            <div class="form-group">
                <label for="class">Class:</label>
                <input type="text" id="class" name="class" placeholder="Kelas" value="<?php echo $row['class']; ?>">
            </div>
            <div class="form-group">
                <label for="user-type">User Type:</label>
                <input type="text" id="user-type" name="usertype" placeholder="User Type" value="<?php echo $row['usertype']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="profile-image">Upload Image:</label>
                <input type="file" id="profile-image" name="userfile">
                <?php if (!empty($row['profile_picture'])) : ?>
                    <p>Current Image: <?php echo $row['profile_picture']; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Update Data</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('update-form').addEventListener('submit', function(event) {
            if (!confirm('Apakah Anda yakin sudah selesai?')) {
                event.preventDefault(); // Mencegah pengiriman formulir jika pengguna memilih "Batal"
            }
        });
    </script>
</body>

</html>