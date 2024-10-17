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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn xóa chuyên ngành
    $sql = "DELETE FROM major WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công!";
        header("Location: major_index.php"); // Chuyển hướng về danh sách chuyên ngành
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>