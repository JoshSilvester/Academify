<!DOCTYPE html>
<html lang="en">
<?php
require("../connection/connection.php");
session_name('student_session');
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['student'])) {
    header("Location:../login/login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>
    <h3>
        <a href="mainpage.php" class="back-to-main-menu">Back to Main Menu</a>
    </h3>
    <div class="profile-container">
        <table>
            <tr>
                <td class="profile-image">
                    <?php
                    $name = $_SESSION['student'];

                    $profile_query = "SELECT profile_picture FROM user WHERE name = '$name'";
                    $profile_result = mysqli_query($con, $profile_query);

                    if (mysqli_num_rows($profile_result) > 0) {
                        $row = mysqli_fetch_assoc($profile_result);
                        $profile_pic = $row['profile_picture'];
                        if (!empty($profile_pic)) {
                            echo '<img src="../student_foto/' . $profile_pic . '" alt="Profile Picture" class="profile-pic">';
                        } else {
                            echo '<img src="../default_profile_pic.png" alt="Default Profile Picture" class="profile-pic">';
                        }
                    } else {
                        echo '<img src="../default_profile_pic.png" alt="Default Profile Picture" class="profile-pic">';
                    }
                    ?>
                </td>
                <td class="profile-details">
                    <table>
                        <?php
                        $name = $_SESSION['student'];

                        $user_query = "SELECT * FROM user WHERE name = '$name'";
                        $user_result = mysqli_query($con, $user_query);

                        if (mysqli_num_rows($user_result) > 0) {
                            $user_data = mysqli_fetch_assoc($user_result);
                            $nama = $user_data['name'];
                            $kelas = $user_data['class'];
                            $student_id = $user_data['id_user'];
                            $email = $user_data['email_user'];
                            $username = $user_data['username'];
                            // $walikelas = $user_data['walikelas']; 
                        } else {
                            $nama = "N/A";
                            $kelas = "N/A";
                            $student_id = "N/A";
                            $email = "N/A";
                            $username = "N/A";
                            // $walikelas = "N/A";
                        }

                        echo '<tr>
                        <td class="label">Nama </td>
                        <td class="value">: ' . $nama . '</td>
                    </tr>
                    <tr>
                        <td class="label">Kelas</td>
                        <td class="value">: ' . $kelas . '</td>
                    </tr>
                    <tr>
                        <td class="label">Student Id</td>
                        <td class="value">: ' . $student_id . '</td>
                    </tr>
                    <tr>
                        <td class="label">Email</td>
                        <td class="value">: ' . $email . '</td>
                    </tr>
                        <tr>
                        <td class="label">Username</td>
                        <td class="value">: ' . $username . '</td>
                    </tr>';
                        ?>
                    </table>
                </td>
            </tr>
        </table>
        <div class="semester-details" id="semester1-details">
            <table>

                <tr>
                    <th>No.</th>
                    <th>Course</th>
                    <th>Score</th>
                    <th>Recommendation</th>
                </tr>
                <?php
                $no = 1;

                $ses_id = $_SESSION['student'];
                $profile_query = "SELECT * FROM user WHERE name = '$ses_id'";
                $get_profile_result = mysqli_query($con, $profile_query);
                $profile_id = mysqli_fetch_assoc($get_profile_result);
                $get_profile_id = $profile_id['id_user'];

                $data = mysqli_query($con, "SELECT * FROM score WHERE id_user = '$get_profile_id' ORDER BY id_course");
                // $recom = mysqli_query($con, "SELECT * FROM wrong_answer WHERE id_user = '$get_profile_id' ORDER BY id_chapter");

                // // GET COURSE
                // $course_query = "SELECT * FROM course ORDER BY id_course";
                // $get_course = mysqli_query($con, $course_query);
                // $fetch_course = mysqli_fetch_assoc($get_course);
                // $id_course = $fetch_course['id_course'];

                // GET CHAPTER
                $chapter_query = "SELECT w.id_user, w.id_chapter, w.id_course, c.id_chapter, c.chapter_name
                FROM wrong_answer w
                JOIN chapter c
                ON w.id_chapter = c.id_chapter
                WHERE w.id_user = '$get_profile_id'
                ORDER BY w.id_chapter";
                $recom = mysqli_query($con, $chapter_query);
                // $chapter_query = "SELECT * FROM chapter WHERE id_course = '$id_course'";
                // $get_chapter = mysqli_query($con, $chapter_query);
                // $fetch_chapter = mysqli_fetch_assoc($get_chapter);

                while ($display = mysqli_fetch_array($data)) {
                    echo '<tr>';
                    echo '<td> ' . $no . '</td>';
                    echo '<td> ' . $display['course_name'] . '</td>';
                    echo '<td> ' . $display['score'] . '</td>';
                    $chapters_to_learn = "";
                    mysqli_data_seek($recom, 0);
                    while ($show = mysqli_fetch_array($recom)) {
                        if ($show['id_user'] == $display['id_user'] && $display['id_course'] == $show['id_course']) {
                            $chapters_to_learn .= 'Chapter ' . $show['chapter_name'] . ', ';
                        }
                    }
                    $chapters_to_learn = rtrim($chapters_to_learn, ', ');
                    if (!empty($chapters_to_learn)) {
                        echo '<td> Please learn ' . $chapters_to_learn . '</td>';
                    } else {
                        echo '<td>No reccomendation, Keep up the good work</td>';
                    }
                    echo '</tr>';
                    $no++;
                }

                ?>
            </table>
        </div>
    </div>
    <script src="profile.js"></script>
    <?php
    require_once '../misc/footer.php'

    ?>

</html>