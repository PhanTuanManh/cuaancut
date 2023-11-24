<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Sinh viên</title>
</head>
<body>

<?php
// Hàm kiểm tra xem sinh viên có qua môn không
function kiemTraQuaMon($diem)
{
    return $diem >= 5;
}

// Xử lý form khi người dùng submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mssv = $_POST["mssv"];
    $hoTen = $_POST["hoTen"];
    $ngaySinh = $_POST["ngaySinh"];
    $diem = $_POST["diem"];

    // In thông tin sinh viên
    echo "<h2>Thông tin Sinh viên</h2>";
    echo "<p>MSSV: $mssv</p>";
    echo "<p>Họ tên: $hoTen</p>";
    echo "<p>Ngày sinh: $ngaySinh</p>";
    echo "<p>Điểm: $diem</p>";

    // Kiểm tra xem sinh viên có qua môn không
    if (kiemTraQuaMon($diem)) {
        echo "<p>Sinh viên đã qua môn.</p>";
    } else {
        echo "<p>Sinh viên chưa qua môn.</p>";
    }
}
?>

<!-- Form nhập thông tin sinh viên -->
<h2>Nhập thông tin Sinh viên</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="mssv">MSSV:</label>
    <input type="text" name="mssv" required><br>

    <label for="hoTen">Họ tên:</label>
    <input type="text" name="hoTen" required><br>

    <label for="ngaySinh">Ngày sinh:</label>
    <input type="date" name="ngaySinh" required><br>

    <label for="diem">Điểm:</label>
    <input type="number" name="diem" min="0" max="10" step="0.1" required><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
