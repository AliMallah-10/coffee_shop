<?php
include '../auth.php';
check_user_role(1); // Ensure the user has the admin role (role = 1)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
    <link rel="stylesheet" href="../../css/admin_header.css"> 
    <link rel="stylesheet" href="../../css/menu_management.css">
    <link rel="stylesheet" href="../../css/modal.css"> <!-- Add this line -->
</head>
<body>
<?php include '../../html/header.html'; ?>
    <main>
        <section class="menu" id="menu">
            <h1 class="heading">Manage Menu</h1> 
                  <div>
                   
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include './fetch_menu.php'; ?>
                        </tbody>
                    </table>
                </div>
            <div class="box-container">
                <div>
                    <form action="./add_menu.php" method="POST" enctype="multipart/form-data">
                        <h2>Add New Menu Item</h2>
                        <input type="text" name="name" placeholder="Coffee Name" required>
                        <textarea name="description" placeholder="Description" required></textarea>
                        <input type="number" name="price" step="0.5" placeholder="Price" required>
                        <input type="file" name="image" required>
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
        <form id="updateForm" action="./update_menu.php" method="POST" enctype="multipart/form-data">
            <h2>Update Menu Item</h2> <img id="updateImagePreview" src="updateImagePreview" alt="Image Preview" style="display: block; margin-block: 10px; max-width: 20%;margin-inline:auto;">
            <input type="hidden" name="menu_id" id="updateId">
            <input type="text" name="name" id="updateName" placeholder="Coffee Name" required>
            <textarea name="description" id="updateDescription" placeholder="Description" required></textarea>
            <input type="number" name="price" id="updatePrice" step="0.5" placeholder="Price" required>
           
            <input type="file" name="image" id="updateImage">
            <input type="submit" value="Update" class="btn">
        </form>
    </div>
</div>


    <script src="../../js/modal.js"></script> <!-- Add this line -->
</body>
</html>
