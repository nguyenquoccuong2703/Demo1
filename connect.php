<?php

$servername = "localhost";
$username = 'root';
$password = '';
$dbname = "hangmua";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS Invoice_Items (
    Invoice_Item_ID INT AUTO_INCREMENT PRIMARY KEY,
    Invoice_ID INT, 
    image VARCHAR(1000),
    color VARCHAR(255),
    Name VARCHAR(255),
    Price Float
)";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

mysqli_set_charset($conn, 'utf8');

?>
