<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký học online</title>
</head>

<body>
    <h1>Đăng ký học online</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy thông tin từ form
        $hoTen = $_POST["hoTen"];
        $email = $_POST["email"];
        $soDienThoai = $_POST["soDienThoai"];
        $diaChi = $_POST["diaChi"];
        $khoaHoc = $_POST["khoaHoc"];

        // Hiển thị thông tin học viên
        echo "<p><strong>Thông tin học viên:</strong></p>";
        echo "<p>Họ tên: $hoTen</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Số điện thoại: $soDienThoai</p>";
        echo "<p>Địa chỉ: $diaChi</p>";
        echo "<p>Khóa học: $khoaHoc</p>";
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="hoTen">Họ tên:</label>
        <input type="text" name="hoTen" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="soDienThoai">Số điện thoại:</label>
        <input type="tel" name="soDienThoai" required><br>

        <label for="diaChi">Địa chỉ:</label>
        <input type="text" name="diaChi" required><br>

        <label for="khoaHoc">Khóa học:</label>
        <select name="khoaHoc" required>
            <option value="khoa1">Khóa học 1</option>
            <option value="khoa2">Khóa học 2</option>
            <!-- Thêm các tùy chọn khác nếu cần -->
        </select><br>

        <input type="submit" value="Đăng ký">
    </form>
</body>

</html>