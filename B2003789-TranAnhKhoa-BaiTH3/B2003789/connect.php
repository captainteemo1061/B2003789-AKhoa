<?php
// Thông tin về chuỗi kết nối gồm server name, username và mật khẩu
$servername = "localhost";  // Tên máy chủ (localhost nếu dùng trên máy tính cá nhân)
$username = "root";         // Tên người dùng (mặc định là 'root' trong XAMPP)
$password = "";             // Mật khẩu (mặc định là rỗng trong XAMPP)

// Tạo kết nối
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    // Hiển thị lỗi nếu kết nối không thành công
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nếu kết nối thành công
echo "Connected successfully";
?>