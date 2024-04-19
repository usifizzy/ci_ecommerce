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
        
        .card-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .card {
            flex: 0 1 calc(33.333% - 80px);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* background-color: #fff; */
        }
        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #ffff; 
        }
        .card p {
            font-size: 16px;
            /* color: #666; */
            color: #ffff; 
        }
        .card .icon {
            font-size: 40px;
            float: left;
            margin-right: 10px;
        }
        .success {
            /* color: #28a745; */
            background-color: #28a745;
        }
        .warning {
            /* color: #ffc107; */
            background-color: #ffc107;
        }
        .danger {
            /* color: #ffc107; */
            background-color: #dc3545;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
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
            <li>Hi, <?= esc($userName) ?></li>
            <br>
            <br>
            <li>Dashboard</li>
            <li><a href="/admin/products">Products</a></li>
            <li><a href="/admin/orders">Orders</a></li>
            <li><a href="/admin/customers">Customers</a></li>
            <li><a href="/auth/signout">Sign Out</a></li>
            <br>
            <br>
            <li><a href="/">Store</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Dashboard</h1>
        
        <div class="card-container">
            <div class="card success">
                <div>
                    <h2>Total Sales</h2>
                    <p>£<?= var_dump($totalOrderAmount->amount) ?></p>
                </div>
            </div>
            <div class="card warning">
                <div>
                    <h2>Orders</h2>
                    <p><?= esc($orderCount) ?></p>
                </div>
            </div>
            <div class="card danger">
                <div>
                    <h2>Customers</h2>
                    <p><?= esc($customers) ?></p>
                </div>
            </div>
        </div>

           
    <h3>Last 5 Order</h3>


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order No</th>
                <th>Amount(£)</th>
                <th>Customer Email</th>
                <th>Customer Name</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
        <?php 
        // var_dump($last_orders)
        $count = 1;
        foreach ($last_orders as $single_products) 
        { ?>
            <tr>
                <td><?= esc($single_products->created_at)?></td>
                <td><?= esc($single_products->order_no) ?></td>
                <td><?= esc($single_products->amount) ?></td>
                <td><?= esc($single_products->email) ?></td>
                <td><?= esc($single_products->name) ?></td>
                <td><a href="<?= esc('admin/order/details/'.$single_products->id, 'url');?>"><span>Details</span></a> </td>
            </tr>
            
            <?php
                }
                ?>
        </tbody>
    </table>
    </div>
</body>
</html>

<!-- 
.container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        } -->