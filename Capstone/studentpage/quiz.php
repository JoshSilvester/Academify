<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/quiz.css">
    <title>Quiz</title>
</head>

<body>
    <?php
    require_once '../misc/studentcomp.php';
    include 'result.php';
    ?>
    <div class="center-box">
        <div class="quiz-container">
            <h1>QUIZ "JUDUL"</h1>

            <?php
            // if (isset($_POST["submit"])) {
            //     $user_answ = $_POST['user_id'];

            //     if (isset($_POST['answer'])) {
            //         $opt = $_POST['answer'];
            //     }

            //     $quiz_id = $_POST['quiz_id'];

            //     $get_answer_query = "SELECT * FROM student_answer WHERE id_user = '$user_answ'";
            //     $check = mysqli_query($con, $get_answer_query);

            //     if (mysqli_num_rows($check) == 0) {
            //         $send_answer = mysqli_query($con, "INSERT INTO student_answer(id_user, id_quiz, answer) VALUES('$user_answ', '$quiz_id', '$opt')");

            //         if ($send_answer) {
            //             echo
            //             '<script>
            //                     alert("Succesful");
            //                     window.location = "course.php";       
            //             </script>';
            //         } else {
            //             echo
            //             '<script>
            //                 alert("Failed to create the data");
            //             </script>';
            //         }
            //     } else {
            //         $send_answer = mysqli_query($con, "UPDATE student_answer SET id_user = '$user_answ', id_quiz = '$quiz_id', answer = '$opt'");
            //     }
            // }
            // include 'quiz_process.php';

            $profile_query = "SELECT * FROM user";
            $get_profile_result = mysqli_query($con, $profile_query);
            $profile_id = mysqli_fetch_assoc($get_profile_result);
            $get_profile_id = $profile_id['id_user'];

            $get_choice_query = "SELECT * FROM choices";
            $choice_data = mysqli_query($con, $get_choice_query);
            $pilihanku = mysqli_fetch_assoc($choice_data);
            $pilihan = $pilihanku['pilihan'];

            $id = $_GET['id_quiz'];
            $no = 1;
            $choice = 1;
            $get_quiz_query = "SELECT * FROM quiz WHERE id_course = '$id' AND id_quiz";
            $data = mysqli_query($con, $get_quiz_query);
            $quiz_data = mysqli_fetch_assoc($data);
            $id_quiz = $quiz_data['id_quiz'];
            $ans_a = $quiz_data['ans_a'];
            $ans_b = $quiz_data['ans_b'];
            $ans_c = $quiz_data['ans_c'];
            $ans_d = $quiz_data['ans_d'];
            $arry_answr[] = "";
            $arry_question[] = "";
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <?php
                foreach ($data as $display) {
                    echo '
                        <div class="question-container">
                            <h2>Question ' . $no . ':</h2>
                            <div class="question">
                                <p>' . $display['quiz_question'] . '</p>
                            </div>
                            <div class="question">
                                <input type="hidden" name="user_id" value=' . $get_profile_id . '></input>
                                <input type="hidden" name="quiz_id" value=' . $id . '></input>
                                <input type="hidden" name="question_num" value=' . $no . '></input>
                                <input type="hidden" name="course_id" value=' . $display['id_course'] . '></input>
                            </div>
                            <div class="options">
                                <label><input type="radio" name=' . $no . ' value="a"> a) ' . $display['ans_a'] . '</label><br>
                                <label><input type="radio" name=' . $no . ' value="b"> b) ' . $display['ans_b'] . '</label><br>
                                <label><input type="radio" name=' . $no . ' value="c"> c) ' . $display['ans_c'] . '</label><br>
                                <label><input type="radio" name=' . $no . ' value="d"> d) ' . $display['ans_d'] . '</label><br>
                            </div>
                        </div>';

                    array_push($arry_answr, $choice);
                    array_push($arry_question, $no);
                    $no++;
                    $choice++;

                    for ($x = 0; $x <= $no; $x++) {
                        if (isset($_POST["submit"])) {
                            $user_answ = $_POST['user_id'];
                            $quiz_id = $_POST['quiz_id'];
                            $quiz_question = $_POST['question_num'];
                            $course_id = $_POST['course_id'];

                            if (isset($_POST[$choice])) {
                                $opt = $_POST[$choice];
                            }

                            $get_answer_query = "SELECT * FROM student_answer WHERE id_user = '$user_answ'";
                            $check = mysqli_query($con, $get_answer_query);

                            if (mysqli_num_rows($check) == 0) {
                                $send_answer = mysqli_query($con, "INSERT INTO student_answer(id_user, id_quiz, id_question, answer) VALUES('$user_answ', '$quiz_id', '$quiz_question', '$opt')");
                            } else {
                                $send_answer = mysqli_query($con, "UPDATE student_answer SET id_user = '$user_answ', id_quiz = '$quiz_id', id_question = '$quiz_question', answer = '$opt'");
                            }
                        }
                    }
                }
                echo ' INI TOLOL ' . implode(",", $arry_answr) . ' ';
                ?>
                <button type="submit" name="submit" class="done-button" id="finished"> Save </button>

            </form>
        </div>
    </div>


</body>

</html>