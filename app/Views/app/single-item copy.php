<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <style>
        .product-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }
        .product-image {
            max-width: 50%;
            padding-right: 20px;
        }
        .product-content {
            max-width: 50%;
        }
        .product-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-description {
            margin-bottom: 10px;
        }
        .product-price {
            color: #007bff;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="product-container">
        <div class="product-image">
            <img src="product_image.jpg" alt="Product Image">
        </div>
        <div class="product-content">
            <div class="product-title">Product Title</div>
            <div class="product-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Nulla condimentum tortor vitae leo maximus, et efficitur neque hendrerit.
            </div>
            <div class="product-price">$19.99</div>
            <button>Add to Cart</button>
        </div>
    </div>
</body>
</html>
