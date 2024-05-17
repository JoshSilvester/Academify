<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../css/student_MainPageNew.css">
</head>

<body>
    <?php
    require_once '../misc/studentcomp.php';
    ?>
    <div class="center-box">
        <h2 class="learning_path">
            <a href="learnpath_student.php">>> Learning Path list</a>
        </h2>
        <table class="main-table">


            <tr>
                <?php
                $no = 1;
                $data = mysqli_query($con, "SELECT * FROM course ORDER BY id_course");
                foreach ($data as $display) {
                    if ($no % 4 == 1) {
                        echo '<tr>';
                    }
                    echo '
                        <td>
                            <table class="subject-table">
                                <tr>
                                    <td> <a href="course.php?id=' . $display['id_course'] . '"><img src="../foto_pelajaran/' . $display['course_img'] . '"</td>
                                </tr>
                                <tr> 
                                    <td class="nama-mapel">' . $display['course_name'] . '</td>
                                </tr>
                            </table>
                        </td> ';
                    if ($no % 4 == 0) {
                        echo "</tr>";
                    }
                    $no++;
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