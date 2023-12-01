<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuaancut1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Chức năng hiển thị chuyên ngành
function displayMajors()
{
    global $conn;
    $sql = "SELECT * FROM majors";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Chuyên Ngành</h2>";
        echo "<table border='1'><tr><th>ID</th><th>Tên Chuyên Ngành</th><th>Thao Tác</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["majors_name"] . "</td><td><button onclick='editMajors(" . $row["id"] . ")'>Sửa</button><button onclick='deleteMajors(" . $row["id"] . ")'>Xóa</button></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu";
    }
}

// Chức năng hiển thị hồ sơ cá nhân
function displayProfiles()
{
    global $conn;
    $sql = "SELECT * FROM profile";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Hồ Sơ Cá Nhân</h2>";
        echo "<table border='1'><tr><th>ID</th><th>Họ Tên</th><th>Email</th><th>Thao Tác</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["fullname"] . "</td><td>" . $row["email"] . "</td><td><button onclick='editProfile(" . $row["id"] . ")'>Sửa</button><button onclick='deleteProfile(" . $row["id"] . ")'>Xóa</button></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có dữ liệu";
    }
}

// Thực hiện chức năng thêm mới chuyên ngành
if (isset($_POST["addMajors"])) {
    $majors_name = $_POST["majors_name"];
    $conn->query("INSERT INTO majors (majors_name) VALUES ('$majors_name')");
}

// Thực hiện chức năng thêm mới hồ sơ cá nhân
if (isset($_POST["addProfile"])) {
    $fullname = $_POST["fullname"];
    $avatar = $_POST["avatar"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $hobbie = $_POST["hobbie"];
    $skill = $_POST["skill"];
    $majors_id = $_POST["majors_id"];
    $conn->query("INSERT INTO profile (fullname, avatar, birthday, email, address, hobbie, skill, majors_id) VALUES ('$fullname', '$avatar', '$birthday', '$email', '$address', '$hobbie', '$skill', $majors_id)");
}

// Thực hiện chức năng sửa chuyên ngành
if (isset($_POST["editMajors"])) {
    $id = $_POST["majors_id"];
    $new_majors_name = $_POST["new_majors_name"];
    $conn->query("UPDATE majors SET majors_name='$new_majors_name' WHERE id=$id");
}

// Thực hiện chức năng sửa hồ sơ cá nhân
if (isset($_POST["editProfile"])) {
    $id = $_POST["profile_id"];
    $new_fullname = $_POST["new_fullname"];
    $new_avatar = $_POST["new_avatar"];
    $new_birthday = $_POST["new_birthday"];
    $new_email = $_POST["new_email"];
    $new_address = $_POST["new_address"];
    $new_hobbie = $_POST["new_hobbie"];
    $new_skill = $_POST["new_skill"];
    $new_majors_id = $_POST["new_majors_id"];
    $conn->query("UPDATE profile SET fullname='$new_fullname', avatar='$new_avatar', birthday='$new_birthday', email='$new_email', address='$new_address', hobbie='$new_hobbie', skill='$new_skill', majors_id=$new_majors_id WHERE id=$id");
}

// Thực hiện chức năng xóa chuyên ngành
if (isset($_POST["deleteMajors"])) {
    $id = $_POST["majors_id"];
    $conn->query("DELETE FROM majors WHERE id=$id");
}

// Thực hiện chức năng xóa hồ sơ cá nhân
if (isset($_POST["deleteProfile"])) {
    $id = $_POST["profile_id"];
    $conn->query("DELETE FROM profile WHERE id=$id");
}

$conn->close();
