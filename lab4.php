<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuaancut1";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Tạo cơ sở dữ liệu
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Cơ sở dữ liệu đã được tạo hoặc đã tồn tại.";
} else {
    echo "Lỗi tạo cơ sở dữ liệu: " . $conn->error;
}

// Chọn cơ sở dữ liệu
$conn->select_db($dbname);

// Tạo bảng majors
$sql = "CREATE TABLE IF NOT EXISTS majors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    majors_name VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Tạo bảng profile
$sql = "CREATE TABLE IF NOT EXISTS profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    birthday DATE,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    hobbie VARCHAR(255),
    skill VARCHAR(255),
    majors_id INT,
    FOREIGN KEY (majors_id) REFERENCES majors(id) ON DELETE CASCADE
)";
$conn->query($sql);

// Thêm dữ liệu mẫu vào bảng majors
$conn->query("INSERT INTO majors (majors_name) VALUES ('Computer Science')");
$conn->query("INSERT INTO majors (majors_name) VALUES ('Business Administration')");

// Thêm dữ liệu mẫu vào bảng profile
$conn->query("INSERT INTO profile (fullname, avatar, birthday, email, address, hobbie, skill, majors_id) VALUES ('John Doe', 'john.jpg', '1990-01-01', 'john@example.com', '123 Main St', 'Reading', 'Programming', 1)");
$conn->query("INSERT INTO profile (fullname, avatar, birthday, email, address, hobbie, skill, majors_id) VALUES ('Jane Doe', 'jane.jpg', '1992-03-15', 'jane@example.com', '456 Oak St', 'Traveling', 'Marketing', 2)");

$conn->close();
