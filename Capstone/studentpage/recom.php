<?php
include '../connection/connection.php';
$no = 1;

$ses_id = $_SESSION['student'];
$profile_query = "SELECT * FROM user WHERE name = '$ses_id'";
$get_profile_result = mysqli_query($con, $profile_query);
$profile_id = mysqli_fetch_assoc($get_profile_result);
$get_profile_id = $profile_id['id_user'];

$wrong_answer_query = "SELECT * FROM wrong_answer WHERE id_user = '$get_profile_id'";
$get_wrong_answer_result = mysqli_query($con, $wrong_answer_query);

$id_chapters = array();

while ($wrong_answer = mysqli_fetch_assoc($get_wrong_answer_result)) {
    $id_chapters[] = $wrong_answer['id_chapter'];
}


foreach ($id_chapters as $id_chapter) {
    $chapter_query = "SELECT * FROM chapter WHERE id_chapter = '$id_chapter' ORDER BY id_chapter";
    $get_chapter = mysqli_query($con, $chapter_query);
    $fetch_chapter = mysqli_fetch_assoc($get_chapter);
    if ($fetch_chapter) {
        echo '
        <div class="container">
            <div class="course-box">
                <h1> Materi ' . $no . '</h1>
                <h3>' . $fetch_chapter['chapter_name'] . '</h3>
                <p>' . $fetch_chapter['chap_desc'] . '</p>
                <a href="chapter.php?id_chap=' . $fetch_chapter['id_chapter'] . '" class="linkBtn">Lanjutkan ke Ruang Lingkup Biologi</a>
            </div>
        </div>';
        $no++;
    }
}
