<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/data_student_admin.css">
    <title>Data student</title>
</head>
<body>
<?php
    // Sambungkan ke database
    require_once '../misc/teachercomp.php';

    // Query untuk mengambil data dari tabel user di dalam database capstone
    $query = "SELECT * FROM user WHERE usertype = 'student' ";

    // Eksekusi query
    $result = mysqli_query($con, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Jika query berhasil, tampilkan data dalam tabel
        echo '
                <table id="mySpecialTable">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Class</th>
                            <th>Student ID</th>
                            <th>Username</th>
                            <th>role</th>
                            <th>Action</th>
                        </tr>';

        // Iterasi melalui setiap baris hasil query
        while ($row = mysqli_fetch_assoc($result)) {
            // Tampilkan data dalam baris tabel
            echo '<tr>';
            echo '<td><img src="../student_foto/' . $row['profile_picture'] . '" alt="Deskripsi Gambar"></td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['class'] . '</td>';
            echo '<td>' . $row['id_user'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['usertype'] . '</td>';
            echo '<td>
                    <a href="update_student.php?id=' . $row['id_user'] . '" class="updateLink">Update</a>
                    <a href="delete_student.php?id=' . $row['id_user'] . '" class="deleteLink">Delete</a>
                  </td>';
            echo '</tr>';
        }

        echo '
              </table>
              ';
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error
        echo "Error: " . mysqli_error($con);
    }

    // Tutup koneksi database
    mysqli_close($con);
?>

</body>
</html> 




