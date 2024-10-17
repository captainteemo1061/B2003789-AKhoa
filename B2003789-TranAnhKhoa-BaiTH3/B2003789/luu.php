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

// Kiểm tra nếu dữ liệu được gửi qua phương thức POST
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["birth"])) {
    // Tạo đối tượng DateTime từ dữ liệu ngày sinh
    $date = date_create($_POST["birth"]);

    // Tạo câu truy vấn SQL
    $sql = "INSERT INTO student (fullname, email, birthday) VALUES ('" . $conn->real_escape_string($_POST["name"]) . "', '" . $conn->real_escape_string($_POST["email"]) . "', '" . $date->format('Y-m-d') . "')";

    // Thực thi câu truy vấn
    if ($conn->query($sql) === TRUE) {
        // Di chuyển đến taidulieu_bang.php nếu thêm sinh viên thành công
        header('Location: taidulieu_bang.php');
        exit(); // Dừng lại sau khi di chuyển trang
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Vui lòng điền đầy đủ thông tin.";
}

// Đóng kết nối
$conn->close();
?>