<?php
require_once '../misc/teachercomp.php';
// include 'result.php';
$id = $_GET['id'];

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // $id = $_GET['id'];
    $course_id = $_POST['course_id'];
    $chapter_title = $_POST['lesson_title'];
    $chapter_desc = $_POST['lesson_description'];
    $chapter_content = $_POST['lesson_content'];
    $url_ppt = $_POST['ppt_url'];
    $url_gdrive = $_POST['gdrive_url'];
    // $chapter_img = $_POST['chapter_image'];

    // Convert the input course title to lowercase
    $query = "INSERT INTO chapter (id_course, chapter_name, chap_desc,chapter_content, chapter_ppt, chapter_gdrive) VALUES ('$course_id', '$chapter_title', '$chapter_desc', '$chapter_content', '$url_ppt', '$url_gdrive')";
    mysqli_query($con, $query);
    echo
    '<script>
        if (confirm("Chapter Added !")) {
        window.location.href = "course.php?id=' . $course_id . '";
        }
    </script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chapter Material</title>
    <link rel="stylesheet" href="../css/add_chapter_new.css">
</head>

<body>
    <?php 
    $id = $_GET['id'];
    echo '<a href="../teacherpage/course.php?id=' . $id . '" class="add_chapter_Back">Back</a>';
    ?>
    <div class="container">
        <h2>Add Chapter Material</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <?php
            echo '<input type="hidden" name="course_id" value="' . $id . '">';
            ?>
            <div class="form-group">
                <label for="lesson_title">Chapter Title:</label>
                <input type="text" id="lesson_title" name="lesson_title" required>
            </div>
            <div class="form-group">
                <label for="lesson_description">Chapter Description:</label>
                <textarea id="lesson_description" name="lesson_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="lesson_description">Chapter Content:</label>
                <textarea id="lesson_description" name="lesson_content" required></textarea>
            </div>
            <div class="form-group">
                <label for="lesson_url">Input URL PPT:</label>
                <input type="text" id="lesson_url" name="ppt_url">
                <small>(leave it blank if there is none)</small>
            </div>
            <div class="form-group">
                <label for="lesson_url">Input URL Gdrive:</label>
                <input type="text" id="lesson_url" name="gdrive_url">
                <small>(leave it blank if there is none)</small>
            </div>
            <!-- <div class="preview" id="materialPreview"></div>
            <div class="form-group">
                <label for="lesson_image">Upload Lesson Image:</label>
                <input type="file" id="lesson_image" name="chapter_image" accept="image/*" onchange="previewImage(this)">
                <small>(Accepted formats: JPEG, PNG, GIF)</small>
            </div> -->
            <div class="preview" id="imagePreview"></div>
            <div class="form-group">
                <button type="submit" name="submit">Add Lesson</button>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>