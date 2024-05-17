<?php

require_once '../misc/teachercomp.php';

if (isset($_POST["submit"])) {
    $ids = $_POST['id'];
    $chapter_name = $_POST['lesson_title'];
    $chapter_desc = $_POST['lesson_description'];
    $chapter_content = $_POST['lesson_content'];
    $chapter_ppt = $_POST['lesson_ppt'];
    $chapter_gdrive = $_POST['lesson_gdrive'];

    $sql = "UPDATE chapter SET chapter_name = '$chapter_name', chap_desc = '$chapter_desc', chapter_content = '$chapter_content', chapter_ppt = '$chapter_ppt', chapter_gdrive = '$chapter_gdrive'  WHERE id_chapter = '$ids'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo '<script>
    if (confirm("Chapter Added !")) {
    window.location.href = "chapter.php?id_chap=' . $ids . '";
    }
</script>';
    }
    // if fail
    else {
        echo "Update Fail";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lesson </title>
    <link rel="stylesheet" href="../css/edit_chapter_new.css">
</head>

<body>

    <?php
    // database connection


    $id = $_GET['id'];
    // show data related to GET

    $sql_chapter = "SELECT * FROM chapter WHERE id_chapter = '$id'";
    $result = mysqli_query($con, $sql_chapter);
    $row = mysqli_fetch_array($result);

    ?>

    <div class="edit-backto-course">
        <?php
        $id = $_GET['id'];
        echo '<a href="course.php?id=' . $id . '" class="edit-backto">back</a>';
        ?>
    </div>

    <div class="container">
        <h2>Edit Lesson</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $row['id_chapter']; ?>" name="id" />
            <div class="form-group">
                <label for="lesson_title">Lesson Title:</label>
                <input type="text" id="lesson_title" name="lesson_title" value="<?php echo $row['chapter_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="lesson_description">Lesson Description:</label>
                <textarea id="lesson_description" name="lesson_description" required><?php echo $row['chap_desc'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="lesson_description">Lesson Content:</label>
                <textarea id="lesson_description" name="lesson_content" required><?php echo $row['chapter_content'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="lesson_url">Input New PPT URL Material:</label>
                <input type="text" id="lesson_url" name="lesson_ppt" value="<?php echo $row['chapter_ppt'] ?>">
                <small>(Provide the URL of the lesson material)</small>
            </div>
            <div class="form-group">
                <label for="lesson_url">Input New GDrive URL Material:</label>
                <input type="text" id="lesson_url" name="lesson_gdrive" value="<?php echo $row['chapter_gdrive'] ?>">
                <small>(Provide the URL of the lesson material)</small>
            </div>
            <div class="preview" id="imagePreview"></div>
            <div class="form-group">
                <button type="submit" name="submit">Edit Lesson</button>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>