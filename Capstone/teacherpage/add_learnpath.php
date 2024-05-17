<?php
require_once '../misc/teachercomp.php';

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $id_path = 1;
    $path_name = mysqli_real_escape_string($con, $_POST['learning_path_name']); // Sanitize user input
    $selected_chapters = $_POST['selected_chapters'];

    $picture = $_POST['path_image'];
    $img_name = $_FILES['path_image']['name'];
    $img_type = $_FILES['path_image']['tmp_name'];
    $location = "../foto_pelajaran/$img_name";

    // Check if the current $id_path exists in the database
    $check_query = "SELECT * FROM learning_path WHERE path_id = $id_path";
    $check_result = mysqli_query($con, $check_query);

    // If no records found for the current $id_path, increment $id_path until a non-existent path is found
    while (mysqli_num_rows($check_result) > 0) {
        $id_path++;
        $check_query = "SELECT * FROM learning_path WHERE path_id = $id_path";
        $check_result = mysqli_query($con, $check_query);
    }

    // Insert the learning path and associated chapters into the database
    foreach ($selected_chapters as $chapter_id) {
        move_uploaded_file($img_type, $location);
        $query = "INSERT INTO learning_path (path_id, path_name, id_chapter, path_img) VALUES ('$id_path', '$path_name', '$chapter_id', '$img_name')";
        mysqli_query($con, $query);
    }

    // Notify the user about the successful creation of the learning path
    echo '<script>
             if (confirm("Learning path created!")) {
                 window.location.href = "learnpage.php";
             }
          </script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Learning Path</title>
    <link rel="stylesheet" href="../css/add_newPath.css">
</head>

<body>

    <div class="container">
        <h2>Create Learning Path</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="learning_path_name">Learning Path Name:</label>
                <input type="text" id="learning_path_name" name="learning_path_name" required>
            </div>
            <div class="form-group">
                <label for="path_image">Upload Path Image:</label>
                <input type="file" id="path_image" name="path_image" onchange="previewImage(this)" required>
            </div>
            <div class="form-group">
                <label>Learning Materials:</label><br>
                <div class="material-group">
                    <?php
                    $no = 1;
                    $sql = mysqli_query($con, "SELECT * FROM chapter ORDER BY id_course");

                    while ($data = mysqli_fetch_array($sql)) {
                        echo '<div class="material">';
                        echo '<input type="checkbox" id="material' . $no . '" name="selected_chapters[]" value="' . $data['id_chapter'] . '">';
                        echo '<label for="material' . $no . '"> ' . $data['chapter_name'] . '</label>';
                        echo '<p>' . $data['chap_desc'] . '</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <button type="button" onclick="window.history.back()" class="create-return-back"><- Return Back</button>
                <button type="submit" name="submit" class="create-add-learnPath">Create Learning Path</button>
            </div>
        </form>
    </div>

</body>

</html>