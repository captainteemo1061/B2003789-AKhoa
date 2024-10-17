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

// Lấy danh sách chuyên ngành
$sql_majors = "SELECT id, name FROM major";
$result_majors = $conn->query($sql_majors);

// Xử lý form khi được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $major_id = $_POST['major_id'];

    $sql = "INSERT INTO student (fullname, email, birthday, major_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $email, $birthday, $major_id);

    if ($stmt->execute()) {
        echo "Thêm sinh viên thành công";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sinh Viên Mới</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Thêm Sinh Viên Mới</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="fullname">Họ tên:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="birthday">Ngày sinh:</label>
        <input type="date" id="birthday" name="birthday" required><br><br>

        <label for="major_id">Chuyên ngành:</label>
        <select id="major_id" name="major_id" required>
            <option value="">Chọn chuyên ngành</option>
            <?php
            if ($result_majors->num_rows > 0) {
                while($row = $result_majors->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <input type="submit" value="Thêm sinh viên">
    </form>
</body>
</html>

<?php
$conn->close();
?>