<!DOCTYPE html>
<html>

<head>
    <title>Kiểm tra học lực</title>
</head>

<body>
    <h1>Kiểm tra học lực</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin từ form
        $hoTen = $_POST["hoTen"];
        $ngaySinh = $_POST["ngaySinh"];
        $diem = $_POST["diem"];

        // Hiển thị thông tin học viên
        echo "<p><strong>Thông tin học viên:</strong></p>";
        echo "<p>Họ tên: $hoTen</p>";
        echo "<p>Ngày sinh: $ngaySinh</p>";
        echo "<p>Điểm: $diem</p>";

        // Kiểm tra học lực
        if ($diem < 5) {
            echo "<p>Học lực: Yếu</p>";
        } elseif ($diem < 6.5) {
            echo "<p>Học lực: Trung bình</p>";
        } elseif ($diem < 7.5) {
            echo "<p>Học lực: Khá</p>";
        } elseif ($diem < 9) {
            echo "<p>Học lực: Giỏi</p>";
        } else {
            echo "<p>Học lực: Xuất sắc</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="hoTen">Họ tên:</label>
        <input type="text" name="hoTen" placeholder="Cua An Cut" required><br>

        <label for="ngaySinh">Ngày sinh:</label>
        <input type="date" name="ngaySinh" required><br>

        <label for="diem">Điểm:</label>
        <input type="number" name="diem" step="0.1" placeholder="2.5" required><br>

        <input type="submit" value="Kiểm tra">
    </form>
</body>

</html>