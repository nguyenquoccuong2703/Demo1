<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .content {
            display: flex;
            justify-content: center;
        }

        .product-box {

            margin-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <!-- Header content here -->
    </header>
    
    <main>       
        <div class="content">            
            <div class="product-box" style=" overflow-x: hidden;overflow-y: auto;">
                <h1 style="text-align: center;">Product List</h1>
                <?php include "connect.php"?>
                <?php   
                $Jsondata = file_get_contents('data.json');  
                $data = json_decode($Jsondata, true);
                $shoes = $data["shoes"] ?? [];
                foreach ($shoes as $shoe):?> 
                    <div class="product" style="border-width: 0;">   
                        <div class="color-square" style="background-color: <?= $shoe['color'] ?? '#000'; ?>; border-radius: 50px;">
                            <div class="product-image">
                                <img src="<?= $shoe['image'] ?? 'N/A';?>" alt="<?= $shoe['name'] ?? 'Product Image';?>">
                            </div>
                        </div>
                        <div class="product-info">
                            <ul>
                                <li><strong>Name:</strong> <?= $shoe['name'] ?? 'N/A';?></li>
                                <li><strong>Description:</strong> <?= $shoe['description'] ?? 'N/A';?></li>
                            </ul>
                        </div>
                        <div class="product-actions">
                            <div class="product-price">
                                <strong>Price:</strong> <?= $shoe['price'] ?? 'N/A';?>
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart(<?= $shoe['id'] ?? '0'; ?>, '<?= $shoe['image'] ?? ''; ?>', '<?= $shoe['color'] ?? ''; ?>', '<?= $shoe['name'] ?? ''; ?>', <?= $shoe['price'] ?? '0'; ?>)" id="add-to-cart-btn-<?= $shoe['id'] ?? '0'; ?>">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            
            <div class="purchased-items" style=" overflow-x: hidden;overflow-y: auto;">
            <h2>Purchased Items</h2>
            <div id="total-price-container"><span id="total-price">$0.00</span></div>
            <ul id="purchased-items-list"></ul>
            
            </div>
        </div>
    </main>
            
    <script>
        function addToCart(productId, image, color, name, price) {
    var btnId = "add-to-cart-btn-" + productId;
    var btn = document.getElementById(btnId);
    if (!btn.disabled) {
        btn.innerHTML = "<img src='check.png' alt='Added' />";
        btn.disabled = true;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                updatePurchasedItems(); 
            }
        };
        var data = "productId=" + productId + "&image=" + encodeURIComponent(image) + "&color=" + encodeURIComponent(color) + "&name=" + encodeURIComponent(name) + "&price=" + price;
        xhr.send(data);
    }   
}


function updatePurchasedItems() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_purchased_items.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var purchasedItemsList = document.getElementById("purchased-items-list");
            var newItem = document.createElement("li");
            newItem.innerHTML = xhr.responseText;
            purchasedItemsList.appendChild(newItem);
            
            calculateTotal();
        }
    };
    xhr.send();
}

function calculateTotal() {
    var purchasedItems = document.querySelectorAll("#purchased-items-list li");
    var total = 0;
    purchasedItems.forEach(function(item) {
        var priceString = item.querySelector(".product-price").innerText;
        var price = parseFloat(priceString.replace("Price: $", ""));
        total += price;
    });
    
    var totalElement = document.getElementById("total-price");
    if (totalElement) {
        totalElement.innerText = "Total: $" + total.toFixed(2);
    }
}


const square = document.getElementById('square');

square.addEventListener('mouseout', function() {
    this.style.display = 'none';
});

square.addEventListener('mouseover', function() {
    this.style.display = 'block';
});
    </script>
</body>
</html>
