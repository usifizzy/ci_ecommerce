<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
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
    </style>
</head>
<body>
    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Image</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $count = 1;
        foreach ($get_all_products as $single_products) 
        { ?>
            <tr>
                <td><?= esc($count)?></td>
                <td><?= esc($single_products->name) ?></td>
                <td><?= esc($single_products->price) ?></td>
                <td><?= esc($single_products->category) ?></td>
                <td><?= esc($single_products->description) ?></td>
                <td><img src="<?= esc('public/uploads/'.$single_products->image)?>" alt="<?= esc($single_products->name) ?>"></td>
                <td> </td>
            </tr>
            
            <?php
                }
                ?>
        </tbody>
    </table>
</body>
</html>
