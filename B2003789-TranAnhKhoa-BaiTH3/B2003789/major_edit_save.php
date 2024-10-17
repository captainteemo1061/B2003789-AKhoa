<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_POST['id']) && isset($_POST['name'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    // Truy vấn cập nhật chuyên ngành
    $sql = "UPDATE major SET name='$name' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công!";
        header("Location: major_index.php"); // Chuyển hướng về danh sách chuyên ngành
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>