<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../css/main_PAGE_new.css">
</head>

<body>
    <?php
    require_once '../misc/teachercomp.php';
    ?>
    <div class="center-box">
        <h3>
            <a href="add_learnpath.php" class="button-22">Add new path</a>
        </h3>
        <table class="main-table">
                <?php
                $no = 1;
                $data = mysqli_query($con, "SELECT DISTINCT path_id, path_name, path_img FROM learning_path ORDER BY no");
                foreach ($data as $display) {
                    if($no % 4 ==1){
                        echo'<tr>';
                    }
                    echo '
                        <td>
                            <table class="subject-table">
                                <tr>
                                    <td> <a href="path_material.php?id=' . $display['path_id'] . '"><img src="../foto_pelajaran/' . $display['path_img'] . '"</td>
                                </tr>
                                <tr> 
                                    <td>' . $display['path_name'] . '</td>
                                </tr>
                            </table>
                        </td> ';
                    if ($no % 4 == 0) {
                        echo "</tr>";
                    }
                    $no++;
                }
                if (($no - 1) % 4 != 0) {
                    echo '</tr>';
                }
                ?>
            </tr>
        </table>
    </div>

    <script>
        function fadeIn(element) {
            var opacity = 0;
            var blur = 20; // Besar blur awal

            var timer = setInterval(function() {
                if (opacity >= 1) {
                    clearInterval(timer); // Hentikan interval saat opacity mencapai 1
                }

                element.style.opacity = opacity;
                element.style.filter = 'blur(' + blur + 'px)'; // Terapkan efek blur

                opacity += 0.05; // Tingkatkan opacity secara bertahap
                blur -= 1; // Kurangi besar blur secara bertahap

            }, 30); // Interval waktu untuk perubahan efek
        }

        // Panggil fungsi fadeIn untuk semua elemen dengan kelas 'subject-table'
        document.addEventListener('DOMContentLoaded', function() {
            var subjectTables = document.querySelectorAll('.subject-table');
            subjectTables.forEach(function(table) {
                fadeIn(table);
            });
        });
    </script>


    <?php
    require_once '../misc/footer.php'
    ?>
</body>

</html>