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

// Lấy thông tin sinh viên cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM student WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

// Xử lý form khi được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $major_id = $_POST['major_id'];

    $sql = "UPDATE student SET fullname = ?, email = ?, birthday = ?, major_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullname, $email, $birthday, $major_id, $id);

    if ($stmt->execute()) {
        echo "Cập nhật sinh viên thành công";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa Thông Tin Sinh Viên</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Sửa Thông Tin Sinh Viên</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

        <label for="fullname">Họ tên:</label>
        <input type="text" id="fullname" name="fullname" value="<?php echo $student['fullname']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>

        <label for="birthday">Ngày sinh:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo $student['birthday']; ?>" required><br><br>

        <label for="major_id">Chuyên ngành:</label>
        <select id="major_id" name="major_id" required>
            <option value="">Chọn chuyên ngành</option>
            <?php
            if ($result_majors->num_rows > 0) {
                while($row = $result_majors->fetch_assoc()) {
                    $selected = ($row['id'] == $student['major_id']) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <input type="submit" value="Cập nhật sinh viên">
    </form>
</body>
</html>

<?php
$conn->close();
?>