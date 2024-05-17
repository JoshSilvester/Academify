<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/quiz_new.css">
    <title>Document</title>
</head>

<?php require_once '../misc/studentcomp.php'; ?>

<body>
    <div class="result">
        <div class="quiz-container">
            <div class="question-container">
                <h2 style="text-align: center;">Result</h2>

                <div class="recomendation">
                    <a href="../studentpage/mainpage.php" class="back-to-menu-Student"><< Back</a>
                    <?php
                    $course_id = $_GET['id'];
                    $ses_id = $_SESSION['student'];
                    $profile_query = "SELECT * FROM user WHERE name = '$ses_id'";
                    $get_profile_result = mysqli_query($con, $profile_query);
                    $profile_id = mysqli_fetch_assoc($get_profile_result);
                    $get_profile_id = $profile_id['id_user'];

                    $get_answer_query = mysqli_query($con, "SELECT * FROM student_answer WHERE id_user = '$get_profile_id'");
                    // $check_student_answer = mysqli_fetch_assoc($get_answer_query);
                    // $student_answer = $check_student_answer['answer'];

                    $id = $_GET['id'];
                    $get_query_quiz = mysqli_query($con, "SELECT * FROM quiz WHERE id_course = '$id'");
                    // $check_quiz = mysqli_fetch_assoc($get_query_quiz);
                    // $correct_answer = $check_quiz['correct_ans'];
                    // $chap_id = $check_quiz['id_chapter'];
                    $total_question = mysqli_num_rows($get_query_quiz);

                    $get_wrong_answer_query = "SELECT * FROM wrong_answer WHERE id_user = '$get_profile_id' AND id_course = '$course_id'";
                    $check = mysqli_query($con, $get_wrong_answer_query);

                    if ($get_answer_query && $get_query_quiz) {
                        $student_answer = [];
                        while ($check_student_ans = mysqli_fetch_assoc($get_answer_query)) {
                            $student_answer[] = $check_student_ans['answer'];
                        }

                        $correct_answer = [];
                        $chap_ids = [];
                        while ($check_ans = mysqli_fetch_assoc($get_query_quiz)) {
                            $correct_answer[] = $check_ans['correct_ans'];
                            $chap_ids[] = $check_ans['id_chapter'];
                        }

                        $total_correct = 0;

                        $current_student_answer = "";
                        $current_correct_answer = "";

                        $existing_records = mysqli_num_rows($check) > 0;
                        $existing_chapters_query = "SELECT id_chapter FROM wrong_answer WHERE id_user = '$get_profile_id'";
                        $existing_chapters_result = mysqli_query($con, $existing_chapters_query);

                        $existing_chapters = [];
                        while ($row = mysqli_fetch_assoc($existing_chapters_result)) {
                            $existing_chapters[] = $row['id_chapter'];
                        }

                        // $delete_query = "DELETE FROM wrong_answer WHERE id_user = '$get_profile_id'";
                        // $succes = mysqli_query($con, $delete_query);
                        // if ($succes) {
                        //     echo '<p> query delete kalau benar masuk </p>';
                        // } else {
                        //     echo '<p> query tidak masuk </p>';
                        // }

                        for ($i = 0; $i < $total_question; $i++) {
                            // echo '<input name="course_id" value="' . $correct_answer . '">';
                            // echo '<input name="course_id" value="' . $student_answer . '">';
                            if ($i < count($student_answer) && $i < count($correct_answer)) {
                                $current_student_answer = $student_answer[$i];
                                $current_correct_answer = $correct_answer[$i];
                            }

                            // echo '<input value="' . $i . '">';
                            // echo '<p> ' . $current_student_answer . '</p>';
                            // echo '<p> ' . $current_correct_answer . '</p>';
                            // echo '<p> ' . $get_profile_id . '</p>';

                            if ($current_correct_answer == $current_student_answer) {
                                $total_correct++;
                            } else {
                                $chap_id = $chap_ids[$i];
                                // echo '<p> ' . $chap_id . '</p>';
                                if (!$existing_records || !in_array($chap_id, $existing_chapters)) {
                                    $insert_query = "INSERT INTO wrong_answer (id_user, id_course, id_chapter) VALUES ('$get_profile_id', '$course_id', '$chap_id')";
                                    $succes = mysqli_query($con, $insert_query);
                                    // if ($succes) {
                                    //     echo '<p> query insert kalau salah masuk </p>';
                                    // } else {
                                    //     echo '<p> query tidak masuk </p>';
                                    // }
                                }
                                // else {
                                //     $delete_query = "DELETE FROM wrong_answer WHERE id_user = '$get_profile_id' AND id_chapter = '$chap_id'";
                                //     $succes = mysqli_query($con, $delete_query);
                                //     if ($succes) {
                                //         echo '<p> query delete kalau sudah exist masuk </p>';
                                //     } else {
                                //         echo '<p> query tidak masuk </p>';
                                //     }

                                //     $insert_query = "INSERT INTO wrong_answer (id_user, id_chapter) VALUES ('$get_profile_id', '$chap_id')";
                                //     mysqli_query($con, $insert_query);
                                // }
                            }


                            // if ($current_correct_answer == $current_student_answer) {
                            //     $total_correct++;
                            //     $chap_id = $chap_ids[$i];
                            //     // Delete existing record for this chapter if it exists
                            //     if ($existing_records) {
                            //         $delete_query = "DELETE FROM wrong_answer WHERE id_user = '$get_profile_id' AND id_chapter = '$chap_id'";
                            //         $succes = mysqli_query($con, $delete_query);
                            //         if ($succes) {
                            //             echo '<p> query delete kalau benar masuk </p>';
                            //         } else {
                            //             echo '<p> query tidak masuk </p>';
                            //         }
                            //     }
                            // } else {
                            //     $chap_id = $chap_ids[$i];
                            //     echo '<p> ' . $chap_id . '</p>';
                            //     if (!$existing_records || !in_array($chap_id, $existing_chapters)) {
                            //         $insert_query = "INSERT INTO wrong_answer (id_user, id_chapter) VALUES ('$get_profile_id', '$chap_id')";
                            //         $succes = mysqli_query($con, $insert_query);
                            //         if ($succes) {
                            //             echo '<p> query insert kalau salah masuk </p>';
                            //         } else {
                            //             echo '<p> query tidak masuk </p>';
                            //         }
                            //     } else {
                            //         $delete_query = "DELETE FROM wrong_answer WHERE id_user = '$get_profile_id' AND id_chapter = '$chap_id'";
                            //         $succes = mysqli_query($con, $delete_query);
                            //         if ($succes) {
                            //             echo '<p> query delete kalau sudah exist masuk </p>';
                            //         } else {
                            //             echo '<p> query tidak masuk </p>';
                            //         }

                            //         $insert_query = "INSERT INTO wrong_answer (id_user, id_chapter) VALUES ('$get_profile_id', '$chap_id')";
                            //         mysqli_query($con, $insert_query);
                            //     }
                            // }
                        }
                    }


                    $gTotal = $total_correct * 100;
                    $final_score = $gTotal / $total_question;
                    // $final_score = $total_question > 0 / $total_question;
                    ?>
                    <table>
                        <tr>
                            <?php
                            echo '<input type="hidden" name="course_id" value="' . $total_question . '">';
                            echo '<td class="label">Score </td>';
                            echo '<td class="value">: ' . $final_score . ' </td>';
                            ?>
                            <!-- <td class="label">Score </td>
                            <td class="value">: 80</td> -->
                        </tr>
                        <tr>
                            <?php
                            echo '<td class="label">Correct number</td>';
                            echo '<td class="value">: ' . $total_correct . ' / ' . $total_question . '</td>'
                            ?>
                            <!-- <td class="label">Correct number</td>
                            <td class="value">: 8 / 10</td> -->
                        </tr>
                    </table>


                </div>
            </div>
            <div class="allcontainer">
                <?php
                $no = 1;

                $ses_id = $_SESSION['student'];
                $profile_query = "SELECT * FROM user WHERE name = '$ses_id'";
                $get_profile_result = mysqli_query($con, $profile_query);
                $profile_id = mysqli_fetch_assoc($get_profile_result);
                $get_profile_id = $profile_id['id_user'];

                $wrong_answer_query = "SELECT * FROM wrong_answer WHERE id_user = '$get_profile_id' AND id_course = '$course_id'";
                $get_wrong_answer_result = mysqli_query($con, $wrong_answer_query);

                $id_chapters = array();

                while ($wrong_answer = mysqli_fetch_assoc($get_wrong_answer_result)) {
                    $id_chapters[] = $wrong_answer['id_chapter'];
                }

                $check_score = mysqli_query($con, "SELECT * FROM score WHERE id_user = '$get_profile_id'");

                // $get_recom_query = "SELECT * FROM recom WHERE id_user = '$get_profile_id'";
                // $check_recom = mysqli_query($con, $get_recom_query);
                // $existing_recom = mysqli_num_rows($check_recom) > 0;

                foreach ($id_chapters as $id_chapter) {
                    $chapter_query = "SELECT * FROM chapter WHERE id_chapter = '$id_chapter' ORDER BY id_chapter";
                    $get_chapter = mysqli_query($con, $chapter_query);
                    $fetch_chapter = mysqli_fetch_assoc($get_chapter);
                    $fetch_course = $fetch_chapter['id_course'];

                    $course_query = "SELECT * FROM course WHERE id_course = '$fetch_course'";
                    $get_course = mysqli_query($con, $course_query);
                    $fetch_course_name = mysqli_fetch_assoc($get_course);
                    if ($fetch_chapter) {
                        $chapter_name = $fetch_chapter['chapter_name'];
                        $course_name = $fetch_course_name['course_name'];
                        echo '
                            <div class="recom-container">
                                <div class="course-box">
                                    <h1> Materi ' . $no . '</h1>
                                    <h3>' . $chapter_name . '</h3>
                                    <p>' . $fetch_chapter['chap_desc'] . '</p>
                                    <a href="chapter.php?id_chap=' . $fetch_chapter['id_chapter'] . '" class="linkBtn">Lanjutkan ke ' . $chapter_name . '</a>
                                </div>
                            </div>';
                        $no++;
                    }
                    // DELETE FROM COURSE BASED ON ID_USER AND ID_COURSE
                    $delete_score = "DELETE FROM score WHERE id_user = '$get_profile_id' AND id_course = '$fetch_course'";
                    mysqli_query($con, $delete_score);

                    // INSERT TO SCORE
                    $insert_score = "INSERT INTO score (id_user, id_course, course_name, score) VALUES ('$get_profile_id', '$fetch_course', '$course_name', '$final_score')";
                    mysqli_query($con, $insert_score);
                    // if (mysqli_num_rows($check_score) == 0) {
                    //     $insert_score = "INSERT INTO score (id_user, id_course, course_name, score) VALUES ('$get_profile_id', '$fetch_course', '$course_name', '$final_score')";
                    //     mysqli_query($con, $insert_score);
                    // } else {
                    //     $update_score = "UPDATE score SET score = '$final_score' WHERE id_user = '$get_profile_id' AND '$fetch_course'";
                    //     mysqli_query($con, $update_score);
                    // };
                }

                $chapter_query = "SELECT * FROM chapter WHERE id_course = '$id'";
                $get_chapter = mysqli_query($con, $chapter_query);
                $fetch_chapter = mysqli_fetch_assoc($get_chapter);
                $fetch_course = $fetch_chapter['id_course'];

                $course_query = "SELECT * FROM course WHERE id_course = '$fetch_course'";
                $get_course = mysqli_query($con, $course_query);
                $fetch_course_name = mysqli_fetch_assoc($get_course);
                $course_name = $fetch_course_name['course_name'];

                // DELETE FROM COURSE BASED ON ID_USER AND ID_COURSE
                $delete_score = "DELETE FROM score WHERE id_user = '$get_profile_id' AND id_course = '$fetch_course'";
                mysqli_query($con, $delete_score);

                // INSERT TO SCORE
                $insert_score = "INSERT INTO score (id_user, id_course, course_name, score) VALUES ('$get_profile_id', '$fetch_course', '$course_name', '$final_score')";
                mysqli_query($con, $insert_score);

                // if (mysqli_num_rows($check_score) == 0) {
                //     $insert_score = "INSERT INTO score (id_user, id_course, course_name, score) VALUES ('$get_profile_id', '$id', '$course_name', '$final_score')";
                //     mysqli_query($con, $insert_score);
                // } else {
                //     $update_score = "UPDATE score SET score = '$final_score' WHERE id_user = '$get_profile_id' AND '$id'";
                //     mysqli_query($con, $update_score);
                // }
                ?>
            </div>
        </div>

</body>

</html>