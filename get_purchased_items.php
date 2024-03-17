<?php

include("connect.php");


$sql = "SELECT * FROM Invoice_Items ORDER BY Invoice_Item_ID DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<div class='product-info'>";
        echo "<div class='thumbnail' style='background-color: " . $row["color"] . ";'>";
        echo "<img src='" . $row["image"] . "' alt='Product Image'>";
        echo "</div>";
        echo "<div class='details'>";
        echo "<span class='product-name'>" . $row["Name"] . "</span>";
        echo "<span class='product-price'>" . $row["Price"] . "</span>";
        echo "<img class='small-icon' src='assets/trash.png'>";
        echo "<img class='small-icon' src='assets/minus.png'>";
        echo "<img class='small-icon' src='assets/plus.png'>";
        echo "</div>";
        echo "</div>";
        echo "</li>";
    }
} else {
    echo "Không có sản phẩm nào được mua.";
}

$conn->close();
?>
