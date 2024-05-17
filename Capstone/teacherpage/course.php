<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Course</title>
    <link rel="stylesheet" href="../css/course_teach.css">
</head>

<body>
    <?php
    require_once '../misc/teachercomp.php';
    ?>

    <div class="allcontainer">
        <div class="atas">
            <tr>
                <a href="../teacherpage/mainpage.php" class="back-link">Back</a>
                <?php
                $id = $_GET['id'];
                echo '<a href="add_new_question.php?id=' . $id . '" class="add-chapter">add new quiz question</a>';
                echo '<a href="add_chapter.php?id=' . $id . '" class="add-chapter">add chapter</a>';
                ?>
            </tr>
        </div>
        <?php
        // $id = $_GET['id'];
        $no = 1;
        $chapter_query = "SELECT * FROM chapter WHERE id_course = '$id' ORDER BY id_chapter";
        $get_chapter_query = mysqli_query($con, $chapter_query);
        foreach ($get_chapter_query as $display) {
            $chapter_id = $display['id_chapter'];
            echo '
                <div class="container">
                    <div class="course-box">
                        <div class="text-container">
                            <h1> Materi ' . $no . '</h1>
                            <h3>' . $display['chapter_name'] . '</h3>
                            <p>' . $display['chap_desc'] . '</p>
                            <a href="chapter.php?id_chap=' . $chapter_id . '" class="linkBtn">Lanjutkan ke ' . $display['chapter_name'] . '</a>
                        </div>
                        <div class="button-group">
                            <a class="edit-button" href="edit_chapter.php?id=' . $chapter_id . '" > Edit</a>
                            <a class="path-delete" href="delete_chapter.php?id=' . $chapter_id . '"> Delete</a>

                        </div>
                        
                    </div>
                </div>';
            $no++;
        }

        // PANGGIL COURSE ID DARI QUIZ
        // $panggil_query_quiz = mysqli_query($con, "SELECT * FROM quiz WHERE id_course = '$id'");
        // $check_quiz = mysqli_fetch_assoc($panggil_query_quiz);
        // $quiz = $check_quiz['quiz_question'];
        // $id_course = $id;
        // if (!$quiz == NULL) {
        //     echo '
        //     <h2>
        //         <a href="quiz_process.php?id=' . $id . '" class="button-11" > Take Quiz </a>
        //     </h2>';
        // }
        $panggil_query_quiz = mysqli_query($con, "SELECT * FROM quiz WHERE id_course = '$id'");
        $check_quiz = mysqli_fetch_assoc($panggil_query_quiz);

        if ($check_quiz && isset($check_quiz['quiz_question'])) {
            $quiz = $check_quiz['quiz_question'];
            if (!is_null($quiz)) {
                echo '
        <h2>
            <a href="list_question.php?id=' . $id . '" class="button-11" > See Quiz Question </a>
        </h2>';
            } else {
                echo '<p>No quiz questions available for this course.</p>';
            }
        } else {
            echo '
            <h2>
            <p>No quiz found for this course.</p>
            </h2>';
        }
        ?>
    </div>
</body>

</html>