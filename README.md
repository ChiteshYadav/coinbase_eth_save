# Coinbase ETH Price Saver

This project is a simple ETH price tracker built with CodeIgniter 3. It fetches the latest Ethereum (ETH) buy price from Coinbase, saves it to a MySQL database, and displays the latest and recent prices in a web interface.

## Features
- Fetches ETH buy price from Coinbase API
- Saves prices with timestamps to a MySQL database
- Displays the latest and last 10 prices
- Clean Bootstrap UI

## Requirements
- PHP 7.4 or 8.x
- MySQL or MariaDB
- Composer
- Git

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/AkKnight08/coinbase_eth_save.git
cd coinbase_eth_save
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Create the Database
Log in to your MySQL server and run:
```sql
CREATE DATABASE eth_price_saver;
USE eth_price_saver;
CREATE TABLE eth_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(20,2) NOT NULL,
    timestamp DATETIME NOT NULL
);
```

### 4. Configure the Database Connection
Edit `application/config/database.php` and set your MySQL credentials:
```php
    'hostname' => 'localhost',
    'username' => 'your_mysql_user',
    'password' => 'your_mysql_password',
    'database' => 'eth_price_saver',
```

### 5. Run the Application Locally
Start the built-in PHP server from the project root:
```bash
php -S localhost:8080 -t public
```
Then open [http://localhost:8080](http://localhost:8080) in your browser.

## How It Works

### API Request
The application makes a GET request to the Coinbase API to fetch the latest ETH buy price. This is done in the `Home` controller (`application/controllers/Home.php`):

```php
$url = 'https://api.coinbase.com/v2/prices/ETH-USD/buy';
$response = file_get_contents($url);
$data = json_decode($response, true);
$price = $data['data']['amount'];
```

### Saving to Database
The price is then saved to the `eth_prices` table in the database using the `Eth_price_model` (`application/models/Eth_price_model.php`):

```php
$data = [
    'price' => $price,
    'timestamp' => date('Y-m-d H:i:s')
];
$this->db->insert('eth_prices', $data);
```

### Displaying Data
The latest price and the last 10 prices are fetched from the database and displayed in the view (`application/views/home.php`):

```php
$latest_price = $this->eth_price_model->get_latest_price();
$recent_prices = $this->eth_price_model->get_recent_prices(10);
```

## Sample Commands for Examiners

### 1. Fetch the Latest ETH Price
```bash
curl https://api.coinbase.com/v2/prices/ETH-USD/buy
```

### 2. Check the Database
Log in to MySQL and run:
```sql
USE eth_price_saver;
SELECT * FROM eth_prices ORDER BY timestamp DESC LIMIT 10;
```

### 3. Run the Application
```bash
php -S localhost:8080 -t public
```
Then visit [http://localhost:8080](http://localhost:8080) to see the latest and recent prices.

## Project Structure
- `public/` — Web root (entry point: `index.php`)
- `application/` — CodeIgniter app (controllers, models, views, config)
- `system/` — CodeIgniter core (do not modify)

## Troubleshooting
- Make sure your database credentials are correct
- Ensure the database and table exist
- Check PHP and MySQL are running
- For any issues, check the logs in `application/logs/`

## License
MIT 

## Sample Data for Testing

To quickly populate your database with sample ETH prices, you can run the following SQL commands:

```sql
USE eth_price_saver;

-- Insert sample ETH prices
INSERT INTO eth_prices (price, timestamp) VALUES
(2000.00, '2023-01-01 12:00:00'),
(2100.00, '2023-01-02 12:00:00'),
(2200.00, '2023-01-03 12:00:00'),
(2300.00, '2023-01-04 12:00:00'),
(2400.00, '2023-01-05 12:00:00'),
(2500.00, '2023-01-06 12:00:00'),
(2600.00, '2023-01-07 12:00:00'),
(2700.00, '2023-01-08 12:00:00'),
(2800.00, '2023-01-09 12:00:00'),
(2900.00, '2023-01-10 12:00:00');
```

Run these commands in your MySQL client to add sample data to the `eth_prices` table. This will help you test the application's display functionality without waiting for real-time API data. 