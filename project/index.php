<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Little Orchid Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            background-color: #f8f9fa;
        }
        .banner {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('img/banner.webp') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 120px 20px;
            border-radius: 10px;
        }
        .banner h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .banner p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        .banner .btn {
            font-size: 1.2rem;
            padding: 12px 40px;
        }
        .cta-section {
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .cta-section img {
            border-radius: 10px 0 0 10px;
        }
        .cta-section h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .cta-section .btn {
            font-size: 1rem;
            padding: 10px 20px;
        }
        .text-highlight {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Banner -->
    <div class="banner mb-5">
        <h1>Welcome to Little Orchid Shop</h1>
        <p>Not Fresh Flowers, Unique Bouquets, and Express Delivery</p>
        <a href="products.php" class="btn btn-success">Shop Now</a>
    </div>

    <!-- Best Selling Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Our <span class="text-highlight">Best Sell</span></h2>
        <div class="row cta-section">
            <div class="col-md-6 p-0">
                <img src="img/product2.jpg" alt="Call to Action" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center p-4">
                <h3>Special Offers</h3>
                <p>
                    Explore our <span class="text-highlight">bestselling orchids</span> and stunning bouquets. 
                    Perfect gifts to bring joy and happiness to your loved ones.
                </p>
                <a href="product-detail.php?id=5" class="btn btn-success">Learn More</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
