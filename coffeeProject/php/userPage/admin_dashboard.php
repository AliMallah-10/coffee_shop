<?php
include '../auth.php';
check_user_role(1); // Ensure the user has the admin role (role = 1)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/admin_dashboard.css">
    <link rel="stylesheet" href="../../css/modal.css"> 
    <link rel="stylesheet" href="../../css/admin_header.css"> 
</head>
<body>
<!-- <header>
        <h1>Welcome, Admin!</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">User Management</a></li>
                <li><a href="menu_management.php">Menu Management</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header> -->
    <?php include '../../html/header.html'; ?>
    <main>
        <section class="user-management">
            <h2>User Management</h2>
            <!-- Display users in a table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // PHP code to fetch users and populate the table
                    include 'fetch_users.php';
                    ?>
                </tbody>
            </table>
            <!-- Form to add new user -->
            <form class="form" action="./add_user.php" method="POST">
                <h3>Add New User</h3>
                
                <input type="text" id="name" name="name" placeholder="Name" required>
                
                <input type="email" id="email" name="email" placeholder="Email" required>
               
                <input type="text" id="address" name="address" placeholder="Address">
            
                <input type="text" id="role" name="role" placeholder="Role">
             
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Add User</button>
            </form>
        </section>
    </main>
   <!-- Modal Structure -->
<div id="updateModalUser" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="updateForm" action="./update_user.php" method="POST" enctype="multipart/form-data">
            <h2>Update User</h2>
            <input type="hidden" name="user_id" id="userId">
            <input type="text" name="name" id="Username" placeholder="User Name" required>
            <input type="email" name="email" id="Useremail" placeholder="Email" required>
            <input type="text" name="address" id="Useraddress" placeholder="Address" required>
            <input type="text" name="role" id="Userrole" placeholder="Role">
            <input type="submit" value="Update" class="btn">
        </form>
    </div>
</div>


    <script src="../../js/openModalUser.js"></script> <!-- Add this line -->
</body>
</html>
