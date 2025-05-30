<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETH Price Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .price-box {
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .price-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .price-timestamp {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .history-item {
            padding: 8px 10px;
            border-bottom: 1px solid #dee2e6;
        }
        .history-item:last-child {
            border-bottom: none;
        }
        .history-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .history-timestamp {
            color: #6c757d;
            font-size: 0.8rem;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
        }
        .card-header h3 {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">ETH Price Tracker</h1>
        
        <?php if (isset($latest_price)): ?>
        <div class="price-box text-center">
            <h2>Latest ETH Price</h2>
            <div class="price-value">$<?php echo number_format($latest_price->price, 2); ?></div>
            <div class="price-timestamp">
                <?php echo date('F j, Y, g:i a', strtotime($latest_price->timestamp)); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($recent_prices)): ?>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Recent Prices</h3>
            </div>
            <div class="card-body">
                <?php foreach ($recent_prices as $price): ?>
                <div class="history-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="history-price">$<?php echo number_format($price->price, 2); ?></span>
                        <span class="history-timestamp">
                            <?php echo date('F j, Y, g:i a', strtotime($price->timestamp)); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 