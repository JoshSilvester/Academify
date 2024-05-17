<?php
require_once '../misc/teachercomp.php';
// include 'result.php';

// Check if the form is submitted
if (isset($_POST["submit"])) {

    $course_title = $_POST['course_title'];
    $course_desc = $_POST['course_description'];
    $course_img = $_POST['course_image'];
    $img_name = $_FILES['course_image']['name'];
    $img_type = $_FILES['course_image']['tmp_name'];
    $location = "../foto_pelajaran/$img_name";
   
    // Convert the input course title to lowercase
    $course_title_lower = strtolower($course_title);

    // Check if the course name already exists (case-insensitive)
    $check_course_query = "SELECT * FROM course WHERE LOWER(course_name) = '$course_title_lower'";
    $check_course_result = mysqli_query($con, $check_course_query);
    if (mysqli_num_rows($check_course_result) > 0) {
        echo '<script>alert("Course with this name already exists. Please choose a different name.");</script>';
    } else {

        move_uploaded_file($img_type, $location);
        $query = "INSERT INTO course (course_name, description, course_img) VALUES ('$course_title', '$course_desc', '$img_name')";
        mysqli_query($con, $query);
        echo '<script>
                 if (confirm("Add Course Success!")) {
                     window.location.href = "mainpage.php";
                 }
               </script>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../css/course_add_new.css">
</head>

<body>


    <div class="container">
        <h2>Add Course</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="course_title">Course Title:</label>
                <input type="text" id="course_title" name="course_title" required>
            </div>
            <div class="form-group">
                <label for="course_description">Course Description:</label>
                <textarea id="course_description" name="course_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="course_image">Upload Course Image:</label>
                <input type="file" id="course_image" name="course_image"  onchange="previewImage(this)" required>
                <small>(Accepted formats: JPEG, PNG, JPG)</small>
            </div>
            <div class="preview" id="imagePreview"></div>
            <div class="form-group">
                <button type="button" onclick="window.history.back()" class="create-return-back"><- Return Back</button>
                <button type="submit" name="submit" class="create-return-back-courseADD">Add Course</button>
            </div>
        </form>
    </div>

    <script src="scripts.js"></script>
</body>

</html>