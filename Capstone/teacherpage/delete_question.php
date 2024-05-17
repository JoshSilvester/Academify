<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Question</title>
</head>

<body>
    <form>

        <?php
        require_once '../misc/teachercomp.php';
        if (isset($_GET['course_id']) && isset($_GET['quiz_no'])) {
            $course_id = $_GET['course_id'];
            $quiz_no = $_GET['quiz_no'];
            $sql = "Delete from quiz WHERE id_course = '$course_id' AND no = '$quiz_no'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo
                '<script>
        if (confirm("Chapter Deleted !")) {
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