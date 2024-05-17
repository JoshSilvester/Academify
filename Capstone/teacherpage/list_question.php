<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/quiz_new.css">
    <title>List Question</title>
</head>

<body>

    <div class="center-box">
        <div class="quiz-container">
            <h1>QUIZ QUESTION</h1>

            <?php
            require_once '../misc/teachercomp.php';
            // Fetch quiz questions
            $id = $_GET['id'];
            $no = 1;
            $quiz_query = "SELECT * FROM quiz WHERE id_course = '$id'";
            $quiz_result = mysqli_query($con, $quiz_query);
            
        
            // $chapter_query = "SELECT * FROM chapter";
            // $get_chapter_result = mysqli_query($con, $chapter_query);
            // $chapter_id = mysqli_fetch_assoc($get_chapter_result);
            // $get_chapter_id = $chapter_id['id_chapter'];
            $question_num = 1; 
                while ($quiz_data = mysqli_fetch_assoc($quiz_result)) {
                    $quiz_no = $quiz_data['no'];
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

                    echo '<a href="edit_question.php?id=' . $id . '&course_id=' . $id . '&quiz_no=' . $quiz_data['no'] . '" class="edit_QUESTION"> Edit</a>';
                    echo '<a href="delete_question.php?id=' . $id . '&course_id=' . $id . '&quiz_no=' . $quiz_data['no'] . '" class="delete_QUESTION"> Delete</a>';
                    echo '</div>';
                    echo '</div>';

                    $question_num++;
                }

              
            ?>
        </div>
    </div>

</body>

</html>