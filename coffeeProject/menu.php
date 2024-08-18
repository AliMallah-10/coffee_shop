<?php 
session_start(); 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/modelHome.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<header class="header">
    <div id="menu-btn" class="fas fa-bars"></div>
    <a href="#" class="logo">Coffee Shop <i class="fas fa-mug-hot"></i> </a>
    <nav class="navbar">
        <a href="/coffeeProject">home</a>
        <a href="/coffeeProject/#about">about</a>
        <a href="#menu">menu</a>
        <a href="/coffeeProject/#review">review</a>
        <a href="/coffeeProject/#contactUs">contact us</a>
    </nav>
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
        <div> <a href="/coffeeProject/menu.php" class="btn">order now</a>
        <a href="./php/logout.php" class="btn">Logout</a></div>
    <?php else: ?>
        <a href="./php/signin.php" class="btn">Login</a>
    <?php endif; ?>
</header>

<section class="menu" id="menu">
    <h1 class="heading"> our menu <span>popular menu</span> </h1>
    <div class="box-container">
        <?php
        include './php/config.php';
        $sql = "SELECT * FROM menu_items";
        $result = $conn->query($sql);
        $totalPrice = 0;
        $itemCount = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $totalPrice += $row["price"];
                $itemCount++;
                echo '<div class="box" onclick="openModal(\'' . $row["name"] . '\', ' . $row["price"] . ', \'./image/' . $row["image_url"] . '\', ' . $row["menu_id"] . ')">';
                echo '<img src="./image/' . $row["image_url"] . '" alt="">';
                echo '<div class="contentMenu">';
                echo '<div class="content">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<span>$' . $row["price"] . '</span>';
                echo '</div>';
                echo '<button class="btnBook">Order</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $meanPrice = 1.00;
        $conn->close();
        ?>
    </div>
</section>

<div id="orderModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalItemName"></h2>
        <img id="modalItemImage" src="" alt="Item Image">
        <form id="orderForm" action="./php/addOrder.php" method="post">
            <input type="hidden" name="menu_id" id="menuId">
            <input type="hidden" name="user_id" id="userId" value="<?php echo isset($_SESSION['userid']) ? $_SESSION['userid'] : ''; ?>">
            <input type="hidden" name="order_status" value="pending">
            <input type="hidden" name="location" id="locationField"> <!-- Hidden field for location -->
            <p>Price: <span>$</span><span id="modalItemPrice"></span></p>
            <div class="location-radio-group">
                <label><input type="radio" name="location_type" value="shop" checked onclick="toggleLocationInputModal()"><span>Inside the Shop</span></label>
                <label><input type="radio" name="location_type" value="delivery" onclick="toggleLocationInputModal()"><span>Delivery</span></label>
            </div>
            <p id="deliveryDescription" style="display:none;">An additional <span>$<?php echo $meanPrice; ?> </span> fee will be applied for delivery.</p>
            <div id="deliveryLocationInput" style="display:none;">
                <p>Please enter the delivery location:</p>
                <input type="text" name="location_input" id="locationInput" placeholder="Enter delivery location">
            </div>
            <div class="quantity-input">
                <label>Quantity:</label>
                <input type="number" name="quantity" id="quantityInput" min="1" value="1" onchange="updateTotalPrice()">
            </div>
            <input type="hidden" name="total_amount" id="totalAmount">
            <button type="submit" id="orderButton" class="btn">Order Now</button>
        </form>
    </div>
</div>


<section class="footer" id="footer">

    <div class="box-container">

        <div class="box">
            <h3>our branches</h3>
            <a href="#"> <i class="fas fa-arrow-right"></i> Beirut </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Baabda </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Aley </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Harisa </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Tyre </a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> about </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> menu </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> review </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> book </a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +96170891093 </a>
            <a href="#"> <i class="fas fa-phone"></i> +96171361731 </a>
            <a href="#"> <i class="fas fa-envelope"></i> 11931339@students.liu.edu.lb </a>
            <a href="#"> <i class="fas fa-envelope"></i> 42030237@students.liu.edu.lb </a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="https://facebook.com"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
        </div>

    </div>

    <div class="credit">   all Copyrights reserved &copy;</div>

</section>
<script src="./js/modelOrder.js"></script>

<script>
    function updateTotalPrice() {
        var price = parseFloat(document.getElementById('modalItemPrice').innerText);
        var quantity = parseInt(document.getElementById('quantityInput').value);
        var totalAmount = price * quantity;
        document.getElementById('totalAmount').value = totalAmount.toFixed(2);
    }

    document.getElementById('quantityInput').addEventListener('input', updateTotalPrice);
    window.addEventListener('load', updateTotalPrice);
</script>
</body>
</html>


