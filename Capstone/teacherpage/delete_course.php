<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Chapter</title>
</head>

<body>
    <form>

        <?php
        require_once '../misc/teachercomp.php';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "Delete from course WHERE id_course = '$id'";
            $sqls = "Delete from chapter WHERE id_chapter = '$id'";
            $result = mysqli_query($con, $sql);
            $results = mysqli_query($con, $sqls);
            if ($result && $results) {
                echo
                '<script>
        if (confirm("Course Deleted !")) {
        window.location.href = "mainpage.php";
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