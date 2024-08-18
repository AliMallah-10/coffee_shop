<?php
include '../auth.php';
check_user_role(1); // Ensure the user has the admin role (role = 1)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inv Management</title>
    <link rel="stylesheet" href="../../css/admin_header.css"> 
    <link rel="stylesheet" href="../../css/menu_management.css">
    <link rel="stylesheet" href="../../css/modal.css"> <!-- Add this line -->
</head>
<body>
<?php include '../../html/header.html'; ?>
    <main>
        <section class="menu" id="menu">
            <h1 class="heading">Manage Inventory</h1> 
                  <div>
                   
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Menu_ID</th>
                                <th>Menu_Name</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php include './fetch_Inv.php'; ?>
                        </tbody>
                    </table>
                </div>
            <div class="box-container">
                <div>
                    <form action="./add_inv.php" method="POST" enctype="multipart/form-data">
                        <h2>Add New Menu Item to Stock</h2>
                        <select name="menu_id" id="menu_id" required></select>
                        
                        <input type="number" name="quantity_in_stock" step="1" placeholder="Quantity" required>
                     
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
            <form id="updateForm" action="./update_inv.php" method="POST" enctype="multipart/form-data">
                <h2>Update Item in stock</h2>
                <input type="hidden" name="inventory_id" id="invId">
                <select name="menu_id" id="menu_id_update"></select>
                        
                <input type="number" name="quantity_in_stock" id="quantity" step="1" placeholder="Quantity" required>
                     
                <input type="submit" value="Update" class="btn">
            </form>
        </div>
    </div>

    <script src="../../js/modal.js"></script> 
    <script src="../../js/fetchOptions.js"></script> 
</body>
</html>
