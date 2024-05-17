<?php
require_once '../misc/studentcomp.php';
// include 'result.php';

// Check if the form is submitted
if (isset($_POST["submit"])) {

    $user_answ = $_POST['user_id'];
    $quiz_id = $_POST['quiz_id'];
    $course_id = $_POST['course_id'];
    $num_quest = $_POST['num_questions'];
    $get_answer_query = "SELECT * FROM student_answer WHERE id_user = '$user_answ'";
    $check = mysqli_query($con, $get_answer_query);
    $query = mysqli_query($con, "DELETE FROM student_answer WHERE id_user = '$user_answ'");

    // DELETE FROM WRONG ANSWER
    $get_wrong_answer_query = "SELECT * FROM wrong_answer WHERE id_user = '$user_answ'";
    $check = mysqli_query($con, $get_wrong_answer_query);

    $delete_query = "DELETE FROM wrong_answer WHERE id_user = '$user_answ' AND id_course = '$course_id'";
    $succes = mysqli_query($con, $delete_query);

    // GET CHAPTER NAME
    $get_chapter_name = "SELECT * FROM chapter WHERE id_course = '$course_id' ORDER BY id_chapter";

    // Loop through the submitted data to extract answers
    for ($i = 1; $i <= $num_quest; $i++) {
        // Check if a radio button is selected
        if (isset($_POST["answer_$i"])) {
            $answer = $_POST["answer_$i"];
        }

        $quiz_query = "SELECT * FROM student_answer WHERE id_user = '$user_answ' ";
        $quiz_result = mysqli_query($con, $quiz_query);

        $query = mysqli_query($con, "INSERT INTO student_answer (id_user, id_quiz, id_question, answer) VALUES ('$user_answ', '$quiz_id', '$i', '$answer')");
    }

    // Redirect after submitting answers
    echo 
    '<script>
        if (confirm("Quiz submitted!")) {
            window.location.href = "result.php?id=' . $course_id . '";
        }
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/quiz_new.css">
    <title>Quiz</title>
</head>

<body>

    <div class="center-box">
        <div class="quiz-container">
            <h1>QUIZ</h1>

            <?php
            // Fetch quiz questions
            $id = $_GET['id'];
            $quiz_query = "SELECT * FROM quiz WHERE id_course = '$id'";
            $quiz_result = mysqli_query($con, $quiz_query);

            // To get USER ID
            $ses_id = $_SESSION['student'];
            $profile_query = "SELECT * FROM user WHERE name = '$ses_id'";
            $get_profile_result = mysqli_query($con, $profile_query);
            $profile_id = mysqli_fetch_assoc($get_profile_result);
            $get_profile_id = $profile_id['id_user'];

            if (mysqli_num_rows($quiz_result) > 0) {
                $question_num = 1;
                echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="POST">';
                echo '<input type="hidden" name="user_id" value="' . $get_profile_id . '">';
                echo '<input type="hidden" name="quiz_id" value="' . $id . '">';
                echo '<input type="hidden" name="course_id" value="' . $id . '">';

                while ($quiz_data = mysqli_fetch_assoc($quiz_result)) {
                    echo '<input type="hidden" name="num_questions" value="' . $question_num . '">';
                    echo '<input type="hidden" name="chapter_id" value="' . $quiz_data['id_chapter'] . '">';
                    echo '<div class="question-container">';
                    echo '<h2>Question ' . $question_num . ':</h2>';
                    echo '<div class="question">';
                    echo '<p>' . $quiz_data['quiz_question'] . '</p>';
                    echo '</div>';
                    echo '<div class="options">';

                    // Generate radio buttons for each option
                    $options = ['a', 'b', 'c', 'd'];
                    foreach ($options as $option) {
                        echo '<label><input type="radio" name="answer_' . $question_num . '" value="' . $quiz_data['ans_' . $option] . '" required> ' . $quiz_data['ans_' . $option] . '</label><br>';
                    }

                    echo '</div>';
                    echo '</div>';

                    $question_num++;
                }

                echo '<button type="submit" name="submit" class="done-button"> Save </button>';
                echo '</form>';
            } else {
                echo '<p>No quiz questions found.</p>';
            }
            ?>
        </div>
    </div>

</body>

</html>