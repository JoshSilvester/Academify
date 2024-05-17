<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/isi_materi.css">
    <title>Chapter</title>
</head>

<body>
    <?php
    require_once '../misc/teachercomp.php';
    ?>

    <div class="container">


        <div class="box">
            <?php
            $id = $_GET['id_chap'];
            $get_query = "SELECT * FROM chapter WHERE id_chapter = '$id'";
            $data = mysqli_query($con, $get_query);
            $display = mysqli_fetch_assoc($data);
            echo '<a href="course.php?id=' . $display['id_course'] . '" class="back-link">Back to Main Menu</a>';

            // $id = $_GET['id_chap'];
            // $get_query = "SELECT * FROM chapter WHERE id_chapter = '$id'";
            // $data = mysqli_query($con, $get_query);
            // $display = mysqli_fetch_assoc($data);
            $chapter_name = $display['chapter_name'];
            $chapter_content = $display['chapter_content'];
            $chapter_ppt = $display['chapter_ppt'];
            $chapter_gdrive = $display['chapter_gdrive'];

            echo '
            <h2>  ' . $chapter_name . ' </h2>
            <p> ' . $chapter_content . ' </p>
            <table class="chapter-table">
                <tr>
                    <td>Powerpoint</td>
                    <td>Gdrive</td>
                </tr>
                <tr>';
            if (!empty($chapter_ppt)) {
                echo ' <td><a href="' . $display['chapter_ppt'] . '">Click this for ppt</a></td>';
            } else {
                echo ' <td><a href="">Not yet Available</a></td>';
            }
            if (!empty($chapter_gdrive)) {
                echo ' <td><a href="' . $display['chapter_gdrive'] . '">Click this for G-drive</a></td>';
            } else {
                echo ' <td><a href="">Not yet Available</a></td>';
            }
            echo '
                    </tr>
            </table>';
            ?>

        </div>
    </div>

    <?php
    require_once '../misc/footer.php'
    ?>
</body>

</html>