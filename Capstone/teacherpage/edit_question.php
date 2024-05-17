<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addnewquestion.css">
    <title>Edit Question</title>
    <?php
    require_once '../misc/teachercomp.php';
    // include 'result.php';

    // Check if the form is submitted
    $id = $_GET['id'];
    if (isset($_POST["submit"])) {
        $course_id = $_POST['course_id'];
        $quiz_no = $_POST['quiz_no'];
        $question = $_POST['question'];
        $option_A = $_POST['optionA'];
        $option_B = $_POST['optionB'];
        $option_C = $_POST['optionC'];
        $option_D = $_POST['optionD'];
        $chapter_id = $_POST['chapterID'];
        $correct_answer = $_POST['correctAnswer'];

        if ($correct_answer == "A") {
            $final_answer = $option_A;
        }
        if ($correct_answer == "B") {
            $final_answer = $option_B;
        }
        if ($correct_answer == "C") {
            $final_answer = $option_C;
        }
        if ($correct_answer == "D") {
            $final_answer = $option_D;
        }

        $sql = "UPDATE quiz SET quiz_question = '$question', ans_a = '$option_A', ans_b = '$option_B', ans_c = '$option_C' , ans_d = '$option_D' , correct_ans = '$final_answer' WHERE id_course = '$course_id' AND no = '$quiz_no'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo '<script>
    if (confirm("Question Edited !")) {
    window.location.href = "list_question.php?id=' . $course_id . '";
    }
</script>';
        }
        // if fail
        else {
            echo "Update Fail";
        }
    }
    ?>
</head>

<body>
    <div class="edit-quiz-question">
        <?php
            $id = $_GET['id'];
            echo '<a href="../teacherpage/list_question.php?id=' . $id . '" class="back-to-listQUEST">Back</a>';
        // <a href="../teacherpage/list_question.php">Back</a>
        ?>
    </div>

    <div class="container">
        <h2>Edit Question</h2>
        <form id="question-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div id="questions-container">
                <div class="question-container">
                    <?php
                    $course_id = $_GET['course_id'];
                    $quiz_no = $_GET['quiz_no'];
                    $sql_chapter = "SELECT * FROM quiz WHERE id_course = '$course_id' AND  no = '$quiz_no'";
                    $result = mysqli_query($con, $sql_chapter);
                    $row = mysqli_fetch_array($result);
                    ?>
                    <?php
                    echo '<input type="hidden" name="course_id" value="' . $course_id . '">';
                    echo '<input type="hidden" name="quiz_no" value="' . $quiz_no . '">';
                    ?>
                    <label for="question">Question:</label>
                    <textarea name="question" required><?php echo $row['quiz_question'] ?></textarea>
                    <label for="optionA">Option A:</label>
                    <input type="text" name="optionA" value="<?php echo $row['ans_a'] ?>" required>
                    <label for="optionB">Option B:</label>
                    <input type="text" name="optionB" value="<?php echo $row['ans_b'] ?>" required>
                    <label for="optionC">Option C:</label>
                    <input type="text" name="optionC" value="<?php echo $row['ans_c'] ?>" required>
                    <label for="optionD">Option D:</label>
                    <input type="text" name="optionD" value="<?php echo $row['ans_d'] ?>" required>
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
                        $get_chapter_right_now = mysqli_query($con, "SELECT * FROM chapter");
                        while ($data = mysqli_fetch_array($get_chapter_right_now)) {
                        ?>
                            <option value="<?= $data['id_chapter'] ?>"> <?= $data['id_chapter'] ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- <button type="button" onclick="addQuestion()" class="submit_addNEW">Add New Question</button> -->
            <button type="submit" name="submit" class="submit_edit">Submit</button>
        </form>
    </div>


    <!-- <script>
        // JavaScript
        function addQuestion() {
            const questionsContainer = document.getElementById('questions-container');
            const newQuestionContainer = document.createElement('div');
            newQuestionContainer.classList.add('question-container');
            newQuestionContainer.innerHTML = `
        
            <label for="question"> New Question:</label>
            <textarea name="question[]" required></textarea>
            <label for="optionA">Option A:</label>
            <input type="text" name="optionA[]" required>
            <label for="optionB">Option B:</label>
            <input type="text" name="optionB[]" required>
            <label for="optionC">Option C:</label>
            <input type="text" name="optionC[]" required>
            <label for="optionD">Option D:</label>
            <input type="text" name="optionD[]" required>
            <label for="correctAnswer">Correct Answer:</label>
            <select name="correctAnswer[]" required>
                <option value="A">Option A</option>
                <option value="B">Option B</option>
                <option value="C">Option C</option>
                <option value="D">Option D</option>
            </select>
            <label for="chapter">Chapter:</label>
            <select name="chapter[]" required>
                <?php
                // $get_chapter_query = "SELECT * FROM chapter WHERE id_course = '$id'";
                // $get_chapter_result = mysqli_query($con, $chapter_query);
                // foreach ($get_chapter_result as $display) {
                //     $chapter_id = $display['id_chapter'];
                //     echo '<option value=' . $chapter_id . '>' . $chapter_id . '</option>';
                // }
                ?>
            </select>
        `;
            questionsContainer.appendChild(newQuestionContainer);
        }
    </script> -->
</body>

</html>