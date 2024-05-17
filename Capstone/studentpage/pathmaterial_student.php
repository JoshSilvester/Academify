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
    require_once '../misc/studentcomp.php';
    ?>

    <div class="allcontainer">
        <div class="atas">
        <tr>
        <a href="learnpath_student.php" class="back-link">Back</a>
        <?php
        $id = $_GET['id'];
        
        
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
                            <a href="chapter.php?id_chap=' . $chapter_id . '" class="linkBtn">Continue to ' . $display['chapter_name'] . '</a>
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