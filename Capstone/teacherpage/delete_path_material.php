<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Material</title>
</head>

<body>
    <form>

        <?php
        require_once '../misc/teachercomp.php';
        if (isset($_GET['chapter_id']) && isset($_GET[ 'path_id'])) {
            $chapter_id = $_GET['chapter_id'];
            $path_id = $_GET['path_id'];
            $sql = "Delete from learning_path WHERE path_id ='$path_id'AND id_chapter = '$chapter_id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo
                '<script>
        if (confirm("Chapter Deleted !")) {
        window.location.href = "path_material.php?id='.$path_id.'"
        }
    </script>';
            }
            // if fail
            else {
                echo "Delete Fail";
            }
        }
        ?>
    </form>
</body>

</html>