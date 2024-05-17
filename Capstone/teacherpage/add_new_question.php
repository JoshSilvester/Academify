<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addnewquestion.css">
    <title>Add New Question</title>
    <?php
    require_once '../misc/teachercomp.php';
    // include 'result.php';

    // Check if the form is submitted
    $id = $_GET['id'];
    if (isset($_POST["submit"])) {
        $course_id = $_POST['course_id'];
        $question = $_POST['question'];
        $option_A = $_POST['optionA'];
        $option_B = $_POST['optionB'];
        $option_C = $_POST['optionC'];
        $option_D = $_POST['optionD'];
        $chapter_id = $_POST['chapterID'];
        $correct_answer = $_POST['correctAnswer'];

        if($correct_answer == "A") {
            $final_answer = $option_A;
        }
        if($correct_answer == "B") {
            $final_answer = $option_B;
        }
        if($correct_answer == "C") {
            $final_answer = $option_C;
        }
        if($correct_answer == "D") {
            $final_answer = $option_D;
        }

        $quiz_query = "SELECT * FROM quiz WHERE id_course = '$course_id' ";
        $quiz_result = mysqli_query($con, $quiz_query);

        $query = mysqli_query($con, "INSERT INTO quiz (id_course, id_chapter, quiz_question, ans_a, ans_b, ans_c, ans_d, correct_ans) VALUES ('$course_id', '$chapter_id', '$question', '$option_A', '$option_B', '$option_C', '$option_D', '$final_answer')");
        if ($query) {
            echo
            '<script>
                if (confirm("Quiz submitted!")) {
                    window.location.href = "course.php?id=' . $course_id . '";
                }
            </script>';
        } else {
            '<script>
                alert("Failed to create data");
                window.location.href = "course.php?id=' . $course_id . '";
            </script>';
        }
    }
    ?>
</head>

<body>
    <div class="add_new_question_">
        <?php
        $id = $_GET['id'];
        echo '<a href="../teacherpage/course.php?id=' . $id . ' " class ="addnewquest_back">Back <a>';
        
        ?>
    </div>
    <div class="container">
        <h2>Add New Question</h2>
        <form id="question-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div id="questions-container">
                <div class="question-container">
                    <?php
                    echo '<input type="hidden" name="course_id" value="' . $id . '">';
                    ?>
                    <label for="question">New Question:</label>
                    <textarea name="question" required></textarea>
                    <label for="optionA">Option A:</label>
                    <input type="text" name="optionA" required>
                    <label for="optionB">Option B:</label>
                    <input type="text" name="optionB" required>
                    <label for="optionC">Option C:</label>
                    <input type="text" name="optionC" required>
                    <label for="optionD">Option D:</label>
                    <input type="text" name="optionD" required>
                    <label for="correctAnswer">Correct Answer:</label>
                    <select name="correctAnswer" required>
                        <option value="A">Option A</option>
                        <option value="B">Option B</option>
                        <option value="C">Option C</option>
                        <option value="D">Option D</option>
                    </select>
                    <?php
                    $get_chapter_query = "SELECT * FROM chapter WHERE id_course = '$id'";
                    $get_chapter_result = mysqli_query($con, $get_chapter_query);
                    $row = mysqli_fetch_array($get_chapter_result);
                    ?>
                    <label for="chapterID">Chapter:</label>
                    <select name="chapterID" required>

                        <?php
                        $get_chapter_right_now = mysqli_query($con, "SELECT * FROM chapter WHERE id_course = '$id'");
                        while ($data = mysqli_fetch_array($get_chapter_right_now)) {
                        ?>
                            <option value="<?= $data['id_chapter'] ?>"> <?= $data['chapter_name'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>