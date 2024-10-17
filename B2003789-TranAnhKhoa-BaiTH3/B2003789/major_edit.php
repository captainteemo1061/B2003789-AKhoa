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

// Kiểm tra xem id có tồn tại trong URL không
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Lấy id từ URL
} else {
    die("Không có ID được truyền vào!");
}

// Truy vấn để lấy thông tin chuyên ngành cần sửa
$sql = "SELECT * FROM major WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Lấy dữ liệu của chuyên ngành
} else {
    die("Không tìm thấy chuyên ngành!");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa chuyên ngành</title>
</head>
<body>
    <h2>Sửa chuyên ngành</h2>
    <form action="major_edit_save.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Tên chuyên ngành: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>

<?php
$conn->close();
?>