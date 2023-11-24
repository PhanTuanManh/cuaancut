<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Sản phẩm</title>
</head>

<body>

    <?php
    // Hàm tìm giá cao nhất và in ra thông tin sản phẩm có giá cao nhất
    function timGiaCaoNhat($sanPham1, $sanPham2, $sanPham3)
    {
        $giaCaoNhat = max($sanPham1['gia'], $sanPham2['gia'], $sanPham3['gia']);

        if ($sanPham1['gia'] == $giaCaoNhat) {
            return $sanPham1;
        } elseif ($sanPham2['gia'] == $giaCaoNhat) {
            return $sanPham2;
        } else {
            return $sanPham3;
        }
    }

    // Xử lý form khi người dùng submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sanPham1 = array("ten" => $_POST["tenSP1"], "gia" => $_POST["giaSP1"]);
        $sanPham2 = array("ten" => $_POST["tenSP2"], "gia" => $_POST["giaSP2"]);
        $sanPham3 = array("ten" => $_POST["tenSP3"], "gia" => $_POST["giaSP3"]);

        // In thông tin 3 sản phẩm
        echo "<h2>Thông tin 3 Sản phẩm</h2>";
        echo "<p>Sản phẩm 1: Tên: {$sanPham1['ten']}, Giá: {$sanPham1['gia']}</p>";
        echo "<p>Sản phẩm 2: Tên: {$sanPham2['ten']}, Giá: {$sanPham2['gia']}</p>";
        echo "<p>Sản phẩm 3: Tên: {$sanPham3['ten']}, Giá: {$sanPham3['gia']}</p>";

        // Tìm giá cao nhất và in ra thông tin sản phẩm có giá cao nhất
        $sanPhamCaoNhat = timGiaCaoNhat($sanPham1, $sanPham2, $sanPham3);
        echo "<h2>Thông tin Sản phẩm có giá cao nhất</h2>";
        echo "<p>Tên: {$sanPhamCaoNhat['ten']}, Giá: {$sanPhamCaoNhat['gia']}</p>";
    }
    ?>

    <!-- Form nhập thông tin 3 sản phẩm -->
    <h2>Nhập thông tin 3 Sản phẩm</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="tenSP1">Tên Sản phẩm 1:</label>
        <input type="text" name="tenSP1" required><br>

        <label for="giaSP1">Giá Sản phẩm 1:</label>
        <input type="number" name="giaSP1" min="0" required><br>

        <label for="tenSP2">Tên Sản phẩm 2:</label>
        <input type="text" name="tenSP2" required><br>

        <label for="giaSP2">Giá Sản phẩm 2:</label>
        <input type="number" name="giaSP2" min="0" required><br>

        <label for="tenSP3">Tên Sản phẩm 3:</label>
        <input type="text" name="tenSP3" required><br>

        <label for="giaSP3">Giá Sản phẩm 3:</label>
        <input type="number" name="giaSP3" min="0" required><br>

        <input type="submit" value="Submit">
    </form>

</body>

</html>