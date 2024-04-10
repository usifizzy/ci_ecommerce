<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li{
            padding: 10px 20px;
            color: #fff;
            cursor: pointer;
        }
        .sidebar ul li:hover {
            background-color: #555;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        a{
            color: #ffff; 
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li>Dashboard</li>
            <li><a href="/admin/products">Products</a></li>
            <li><a href="/admin/orders">Orders</a></li>
            <li><a href="/admin/customers">Customers</a></li>
            <li><a href="/auth/signout">Sign Out</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Admin Dashboard</h1>
        <!-- Add your dashboard content here -->
    </div>
</body>
</html>
