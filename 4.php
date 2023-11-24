<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính thuế thu nhập cá nhân</title>
</head>

<body>

    <?php
    // Kiểm tra xem đã submit form chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy giá trị thu nhập từ form
        $thuNhap = $_POST["thuNhap"];

        // Tính thuế dựa trên quy tắc
        if ($thuNhap >= 20 && $thuNhap < 30) {
            $thue = $thuNhap * 0.1;
        } elseif ($thuNhap >= 30 && $thuNhap < 40) {
            $thue = $thuNhap * 0.125;
        } elseif ($thuNhap >= 40 && $thuNhap < 50) {
            $thue = $thuNhap * 0.15;
        } elseif ($thuNhap >= 50) {
            $thue = $thuNhap * 0.2;
        } else {
            $thue = 0;
        }

        // Hiển thị kết quả
        echo "Thu nhập cá nhân: $thuNhap triệu VND<br>";
        echo "Số thuế phải nộp: $thue triệu VND";
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="thuNhap">Nhập thu nhập cá nhân (triệu VND): </label>
        <input type="number" name="thuNhap" id="thuNhap" required>
        <br>
        <input type="submit" value="Tính thuế">
    </form>

</body>

</html>