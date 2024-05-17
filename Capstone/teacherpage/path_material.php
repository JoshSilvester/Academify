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
                <a href="learnpage.php" class="back-link">Back</a>
                <?php
                $id = $_GET['id'];

                echo '<a href="add_path_material.php?id=' . $id . '" class="add-chapter">Add path material</a>';
                ?>
            </tr>
        </div>
        <?php
        // $id = $_GET['id'];
        $no = 1;
        $chapter_query = "SELECT * FROM learning_path WHERE path_id = '$id' ORDER BY path_id";
        $get_chapter_query = mysqli_query($con, $chapter_query);
        // $get_chapter = mysqli_fetch_assoc($get_chapter_query);
        // $chapter_path = $get_chapter['id_chapter'];
        while ($get_chapter = mysqli_fetch_assoc($get_chapter_query)) {
            $chapter_path = $get_chapter['id_chapter'];

            $chap_query = "SELECT * FROM chapter WHERE id_chapter = '$chapter_path' ";
            $get_chap_query = mysqli_query($con, $chap_query);

            foreach ($get_chap_query as $display) {
                $chapter_id = $display['id_chapter'];
                echo '
                <div class="container">
                    <div class="course-box">
                        <div class="text-container">
                            <h1> Materi ' . $no . '</h1>
                            <h3>' . $display['chapter_name'] . '</h3>
                            <p>' . $display['chap_desc'] . '</p>
                            <a href="chapter_learnpath.php?id_chap=' . $chapter_id . '&id=' . $id . '" class="linkBtn">Press to Continue</a>
                        </div>
                        <div class="button-group">
                            <a href="delete_path_material.php?chapter_id=' . $chapter_id . '&path_id=' . $id . '" class="path-delete"> Delete</a>
                        </div>
                        
                    </div>
                </div>';
                $no++;
            }
        }


        ?>
    </div>
</body>

</html>