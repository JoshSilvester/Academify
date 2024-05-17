<?php
require_once '../misc/teachercomp.php';

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $path_id = $_POST['path_id'];
    $path_name = $_POST['path_name'];
    $path_img = $_POST['path_img'];

    // Sanitize user input
    $selected_chapters = $_POST['selected_chapters'];

    // Loop through each selected chapter and insert into the database
    foreach ($selected_chapters as $chapter_id) {
        // Insert the data into the database
        $query = "INSERT INTO learning_path (path_id, path_name, id_chapter, path_img) VALUES ('$path_id', '$path_name', '$chapter_id', '$path_img')";
        mysqli_query($con, $query);
    }

    echo '<script>
        if (confirm("Path Added !")) {
            window.location.href = "path_material.php?id=' . $path_id . '";
        }
    </script>';

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Path</title>
    <link rel="stylesheet" href="../css/add_learnpath.css">
</head>

<body>

    <div class="add-path-material-BACK">
        <?php
        $id = $_GET['id'];
        echo '<a href="../teacherpage/path_material.php?id=' . $id . '" class="ADD-path-material-BACK">back</a>';
        ?>
    </div>

    <div class="container">
        <h2>Create Learning Path</h2>
        <?php
        // Retrieve path data related to GET
        $id = $_GET['id'];
        $sql_chapter = "SELECT * FROM learning_path WHERE path_id = '$id'";
        $result = mysqli_query($con, $sql_chapter);
        $row = mysqli_fetch_array($result);
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <?php
            // Hidden fields to pass path data
            echo '<input type="hidden" name="path_id" value="' . $id . '">';
            echo '<input type="hidden" name="path_name" value="' . $row['path_name'] . '">';
            echo '<input type="hidden" name="path_img" value="' . $row['path_img'] . '">';
            ?>

            <div class="form-group">
                <label>Learning Materials:</label><br>
                <div class="material-group">
                    <?php
                    $no = 1;
                    $sql = mysqli_query($con, "SELECT * FROM chapter ORDER BY id_course");

                    // Display checkboxes for each chapter
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
                <button type="submit" name="submit" class="Button-Material">Add Material</button>
                <!-- <button type="button" onclick="window.history.back()" class="Button-Return-Back">Return Back</button> -->
            </div>
        </form>
    </div>

</body>

</html>
