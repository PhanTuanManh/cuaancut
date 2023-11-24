<?php
// Thông tin kết nối đến MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuaancut";

// Kết nối đến MySQL
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tạo cơ sở dữ liệu mới
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql_create_db);

// Chọn cơ sở dữ liệu
$conn->select_db($dbname);

// Tạo bảng Phongban
$sql_create_table_phongban = "CREATE TABLE IF NOT EXISTS Phongban (
    maphg INT AUTO_INCREMENT PRIMARY KEY,
    tenphg VARCHAR(255) NOT NULL
)";
$conn->query($sql_create_table_phongban);

// Tạo bảng Nhanvien
$sql_create_table_nhanvien = "CREATE TABLE IF NOT EXISTS Nhanvien (
    manv INT AUTO_INCREMENT PRIMARY KEY,
    tennv VARCHAR(255) NOT NULL,
    ngaysinh DATE,
    phai VARCHAR(10),
    luong INT,
    maphg INT,
    FOREIGN KEY (maphg) REFERENCES Phongban(maphg)
)";
$conn->query($sql_create_table_nhanvien);

// Tạo bảng Dean
$sql_create_table_dean = "CREATE TABLE IF NOT EXISTS Dean (
    mada INT AUTO_INCREMENT PRIMARY KEY,
    tenda VARCHAR(255) NOT NULL,
    maphg INT,
    FOREIGN KEY (maphg) REFERENCES Phongban(maphg)
)";
$conn->query($sql_create_table_dean);

// Tạo bảng Phancong
$sql_create_table_phancong = "CREATE TABLE IF NOT EXISTS Phancong (
    manv INT,
    mada INT,
    thoigian DATE,
    PRIMARY KEY (manv, mada),
    FOREIGN KEY (manv) REFERENCES Nhanvien(manv),
    FOREIGN KEY (mada) REFERENCES Dean(mada)
)";
$conn->query($sql_create_table_phancong);

// Thêm vào mỗi bảng 5 bản ghi
$sql_insert_phongban = "INSERT INTO Phongban (tenphg) VALUES 
                        ('Phòng A'),
                        ('Phòng B'),
                        ('Phòng C'),
                        ('Phòng D'),
                        ('Phòng E')";
$conn->query($sql_insert_phongban);

$sql_insert_nhanvien = "INSERT INTO Nhanvien (tennv, ngaysinh, phai, luong, maphg) VALUES
                        ('Nguyen Van A', '1990-01-01', 'Nam', 5000, 1),
                        ('Nguyen Van B', '1992-05-10', 'Nam', 5500, 2),
                        ('Nguyen Thi C', '1988-03-15', 'Nữ', 6000, 3),
                        ('Tran Van D', '1995-07-20', 'Nam', 5200, 2),
                        ('Le Thi E', '1998-12-25', 'Nữ', 5800, 1)";
$conn->query($sql_insert_nhanvien);

$sql_insert_dean = "INSERT INTO Dean (tenda, maphg) VALUES
                    ('Dự án 1', 1),
                    ('Dự án 2', 2),
                    ('Dự án 3', 3),
                    ('Dự án 4', 4),
                    ('Dự án 5', 5)";
$conn->query($sql_insert_dean);

$sql_insert_phancong = "INSERT INTO Phancong (manv, mada, thoigian) VALUES
                        (1, 1, '2023-01-01'),
                        (2, 2, '2023-02-15'),
                        (3, 3, '2023-03-20'),
                        (4, 4, '2023-04-10'),
                        (5, 5, '2023-05-05')";
$conn->query($sql_insert_phancong);

// Sửa dữ liệu bảng nhân viên có tennv thành 'Nguyễn Văn Quý' có manv là 5
$sql_update_nhanvien = "UPDATE Nhanvien SET tennv = 'Nguyễn Văn Quý' WHERE manv = 5";
$conn->query($sql_update_nhanvien);

// Xóa 1 bản ghi trong bảng phân công có manv = 1, và mada = 3
$sql_delete_phancong = "DELETE FROM Phancong WHERE manv = 1 AND mada = 3";
$conn->query($sql_delete_phancong);

// Hiển thị toàn bộ nhân viên và phòng ban tương ứng
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
