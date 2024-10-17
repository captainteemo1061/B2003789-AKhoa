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

// Lấy dữ liệu từ form
$major_id = $_POST['major_id'];
$major_name = $_POST['major_name'];

// Câu lệnh SQL để thêm dữ liệu vào bảng major
$sql = "INSERT INTO major (id, name) VALUES ('$major_id', '$major_name')";

if ($conn->query($sql) === TRUE) {
    echo "Thêm chuyên ngành thành công";
    echo "<br><a href='major_add.php'>Thêm chuyên ngành khác</a>";
    echo "<br><a href='taidulieu_bang1.php'>Xem danh sách sinh viên</a>";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>