<?php
// Thông tin kết nối đến MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuaancut";

// Kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    exit();
}

// 3.3 Thêm vào mỗi bảng 5 bản ghi
$sql_insert_phongban = "INSERT INTO Phongban (maphg, tenphg) VALUES
                        (1, 'Phòng A'),
                        (2, 'Phòng B'),
                        (3, 'Phòng C'),
                        (4, 'Phòng D'),
                        (5, 'Phòng E')";

$sql_insert_nhanvien = "INSERT INTO Nhanvien (manv, tennv, ngaysinh, phai, luong, maphg) VALUES
                        (1, 'Nguyen Van A', '1990-01-01', 'Nam', 5000, 1),
                        (2, 'Nguyen Van B', '1992-05-10', 'Nam', 5500, 2),
                        (3, 'Nguyen Thi C', '1988-03-15', 'Nữ', 6000, 3),
                        (4, 'Tran Van D', '1995-07-20', 'Nam', 5200, 2),
                        (5, 'Le Thi E', '1998-12-25', 'Nữ', 5800, 1)";

$sql_insert_dean = "INSERT INTO Dean (mada, tenda, maphg) VALUES
                    (1, 'Dự án 1', 1),
                    (2, 'Dự án 2', 2),
                    (3, 'Dự án 3', 3),
                    (4, 'Dự án 4', 4),
                    (5, 'Dự án 5', 5)";

$sql_insert_phancong = "INSERT INTO Phancong (manv, mada, thoigian) VALUES
                        (1, 1, '2023-01-01'),
                        (2, 2, '2023-02-15'),
                        (3, 3, '2023-03-20'),
                        (4, 4, '2023-04-10'),
                        (5, 5, '2023-05-05')";

// Thực hiện truy vấn thêm dữ liệu
$conn->query($sql_insert_phongban);
$conn->query($sql_insert_nhanvien);
$conn->query($sql_insert_dean);
$conn->query($sql_insert_phancong);

// 3.3 Sửa dữ liệu bảng nhân viên có tennv thành 'Nguyễn Văn Quý' có manv là 5
$sql_update_nhanvien = "UPDATE Nhanvien SET tennv = 'Nguyễn Văn Quý' WHERE manv = 5";
$conn->query($sql_update_nhanvien);

// 3.4 Xóa 1 bản ghi trong bảng phân công có manv =1, và mada=3
$sql_delete_phancong = "DELETE FROM Phancong WHERE manv = 1 AND mada = 3";
$conn->query($sql_delete_phancong);

// 3.5 Hiển thị toàn bộ nhân viên và phòng ban tương ứng
$sql_select_all = "SELECT Nhanvien.manv, Nhanvien.tennv, Nhanvien.ngaysinh, Nhanvien.phai, Nhanvien.luong, Phongban.tenphg
                   FROM Nhanvien
                   INNER JOIN Phongban ON Nhanvien.maphg = Phongban.maphg";

$result = $conn->query($sql_select_all);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Mã NV: " . $row["manv"] . " - Tên NV: " . $row["tennv"] . " - Ngày sinh: " . $row["ngaysinh"] . " - Giới tính: " . $row["phai"] . " - Lương: " . $row["luong"] . " - Phòng ban: " . $row["tenphg"] . "<br>";
    }
} else {
    echo "Không có dữ liệu";
}

// Đóng kết nối
$conn->close();
