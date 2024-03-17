<?php
$servername = "localhost";
$username = 'root';
$password = '';
$dbname = "hangmua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

mysqli_set_charset($conn, 'utf8');

$productId = $_POST['productId'];
$image = $_POST['image'];
$color = $_POST['color'];
$name = $_POST['name'];
$price = $_POST['price'];

$sql = "INSERT INTO Invoice_Items (Invoice_ID, image, color, Name, Price) VALUES ('$productId', '$image', '$color', '$name', '$price')";

if ($conn->query($sql) === TRUE) {
    echo "Sản phẩm đã được thêm vào giỏ hàng thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
