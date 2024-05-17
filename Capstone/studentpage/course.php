<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/course_new.css">
    <title>Document</title>
</head>

<body>
    <?php
    require_once '../misc/studentcomp.php';
    ?>
    <div class="STUDENT-back">
        <a href="../studentpage/mainpage.php" class="STUDENT-back-style">Back</a>
    </div>

    <div class="allcontainer">
        <?php
        $id = $_GET['id'];
        $no = 1;
        $data = mysqli_query($con, "SELECT * FROM chapter WHERE id_course = '$id' ORDER BY id_chapter");
        foreach ($data as $display) {
            echo '
            <div class="container">
                <div class="course-box">
                    <h1> Materi ' . $no . '</h1>
                    <h3>' . $display['chapter_name'] . '</h3>
                    <p>' . $display['chap_desc'] . '</p>
                    <a href="chapter.php?id_chap=' . $display['id_chapter'] . '" class="linkBtn">Continue to ' . $display['chapter_name'] . '</a>
                </div>
            </div>';
            $no++;
        }

        $panggil_query_quiz = mysqli_query($con, "SELECT * FROM quiz WHERE id_course = '$id'");
        $check_quiz = mysqli_fetch_assoc($panggil_query_quiz);

        if ($check_quiz && isset($check_quiz['quiz_question'])) {
            $quiz = $check_quiz['quiz_question'];
            if (!is_null($quiz)) {
                echo '
        <h2>
            <a href="quiz_process.php?id=' . $id . '" class="button-11-student" > Take Quiz </a>
        </h2>';
            } else {
                echo '<p>No quiz questions available for this course.</p>';
            }
        } else {
            echo '
            <h2>
            <p class="no-quiz-found">No quiz found for this course.</p>
            </h2>';
        }
        ?>


    </div>
    <?php
    require_once '../misc/footer.php'
    ?>
</body>

</html>