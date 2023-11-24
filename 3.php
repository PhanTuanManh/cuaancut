<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính Hóa Đơn</title>
</head>

<body>

    <?php
    // Dữ liệu mẫu
    $products = array(
        array("Bimbim", 1, 1000),
        array("Socola", 2, 5500),
        array("Hạnh nhân", 1, 1500),
        array("Omachi", 1, 2500),
        array("Sữa chua", 4, 5000)
    );

    $totalAmount = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $isValid = true;

        foreach ($products as $index => $product) {
            $quantityKey = "quantity_$index";
            $unitPriceKey = "unit_price_$index";
            $totalKey = "total_$index";

            if (!isset($_POST[$quantityKey]) || !isset($_POST[$unitPriceKey])) {
                $isValid = false;
                break;
            }

            $quantity = $_POST[$quantityKey];
            $unitPrice = $_POST[$unitPriceKey];


            if (!is_numeric($quantity) || !is_numeric($unitPrice)) {
                $isValid = false;
                break;
            }


            $total = $quantity * $unitPrice;
            $_POST[$totalKey] = $total;
            $totalAmount += $total;
        }

        if (!$isValid) {
            echo "<p style='color: red;'>Vui lòng nhập số lượng và đơn giá hợp lệ cho tất cả sản phẩm.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table border="1">
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Thành Tiền</th>
            </tr>

            <?php
            foreach ($products as $index => $product) {
                $stt = $index + 1;
                $productName = $product[0];
                $quantityKey = "quantity_$index";
                $unitPriceKey = "unit_price_$index";
                $totalKey = "total_$index";


                $quantityValue = isset($_POST[$quantityKey]) ? $_POST[$quantityKey] : "";
                $unitPriceValue = isset($_POST[$unitPriceKey]) ? $_POST[$unitPriceKey] : "";

                echo "<tr>";
                echo "<td>$stt</td>";
                echo "<td>$productName</td>";
                echo "<td><input type='number' name='$quantityKey' required value='$quantityValue'></td>";
                echo "<td><input type='number' name='$unitPriceKey' required value='$unitPriceValue'></td>";
                echo "<td>" . (isset($_POST[$totalKey]) ? number_format($_POST[$totalKey]) : "") . " đ</td>";
                echo "</tr>";
            }
            ?>

            <tr>
                <td colspan="4">Tổng tiền</td>
                <td>
                    <?php echo number_format($totalAmount); ?> đ
                </td>
            </tr>
            <tr>
                <td colspan="5"><input type="submit" value="Tính Tiền"></td>

            </tr>
        </table>
    </form>

</body>

</html>