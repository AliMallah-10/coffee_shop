<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="../../css/admin_header.css"> 
    <link rel="stylesheet" href="../../css/menu_management.css">
    <link rel="stylesheet" href="../../css/modal.css">
</head>
<body>
<?php include '../../html/header.html'; ?>
    <main>
        <section class="menu" id="menu">
            <h1 class="heading">Manage Orders</h1> 
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th> 
                            <th>User Name</th>
                            <th>Menu Name</th>
                            <th>Menu Price</th>
                            <th>Order Date</th>
                            <th>Order Location</th>
                            <th>Quantity</th>
                            <th>Total Price</th> <!-- Added column for total price -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include './fetch_orders.php'; ?>
                    </tbody>
                </table>
            </div>  
            <div class="box-container">
                <div><h2>Add New Order</h2><div class="location-radio-group">
            <label><input type="radio" name="location_type" value="shop" checked onclick="toggleLocationInput()"><span>Inside the Shop</span></label>
            <label><input type="radio" name="location_type" value="delivery" onclick="toggleLocationInput()"><span>Delivery</span></label>
        </div>
                    <form action="./add_order.php" method="POST" enctype="multipart/form-data">
                        <select name="menu_id" id="menu_id" required></select>
                        <select name="user_id" id="user_id" required></select>
                        <div id="location-container">
                            <input type="text" name="location" id="location_input" class="disabled-input" placeholder="Location" value="Inside the Shop">
                            <p id="location_description" class="location-description">Please enter your delivery address.</p>
                        </div>
                        <input type="number" name="quantity" step="1" placeholder="Quantity" required>   
                        <input type="number"step="0.5" name="total_price" id="totalAmount"> 
                        <input type="submit" value="Add" class="btn">
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Structure -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="updateForm" action="./update_order.php" method="POST" enctype="multipart/form-data">
                <h2>Update Order</h2>
                <input type="hidden" name="order_id" id="updateId">
                <select name="menu_id" id="menu_id_update" required></select>
                <select name="user_id" id="user_id_update" required></select> 
                <input name="location" id="location_update" required>               
                <input name="quantity" id="quantity_update" required> 
                <input type="number"step="0.5" name="total_price" id="totalAmount">
                <input type="submit" value="Update" class="btn">
            </form>
        </div>
    </div>

    <script src="../../js/fetchOptions.js"></script> 
    <script src="../../js/modal.js"></script>
    <script>
        function toggleLocationInput() {
            var locationInput = document.getElementById("location_input");
            var locationDescription = document.getElementById("location_description");
            var locationType = document.querySelector('input[name="location_type"]:checked').value;
            
            if (locationType === "delivery") {
                locationInput.classList.remove("disabled-input");
                locationInput.disabled = false;
                locationInput.value = ""; // Reset value for delivery
                locationDescription.style.display = "block";
            } else {
                locationInput.classList.add("disabled-input");
                locationInput.value = "Inside the Shop"; // Set default value for in-shop
                locationDescription.style.display = "none";
            }
        }

        // Initialize location input state based on default radio button value
        window.onload = function() {
            toggleLocationInput();
        };
    </script>
</body>
</html>
