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

// Truy vấn để lấy tất cả chuyên ngành
$sql = "SELECT * FROM major";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách chuyên ngành</title>
</head>
<body>
    <h2>Danh sách chuyên ngành</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên chuyên ngành</th>
            <th>Hành động</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
                <a href="major_edit.php?id=<?php echo $row['id']; ?>">Sửa</a> |
                <a href="major_xoa.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="major_add.php">Thêm chuyên ngành mới</a>
</body>
</html>

<?php
$conn->close();
?>