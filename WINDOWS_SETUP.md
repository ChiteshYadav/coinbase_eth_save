# Windows Setup Guide for Coinbase ETH Saver

This guide will help you set up the Coinbase ETH Saver project on a Windows system.

## Prerequisites

1. **XAMPP Installation**
   - Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
   - Install XAMPP with PHP 8.1 or higher
   - Make sure to include Apache, MySQL, and PHP during installation

2. **Composer Installation**
   - Download Composer from [https://getcomposer.org/download/](https://getcomposer.org/download/)
   - Run the Composer installer
   - Make sure to select the PHP from your XAMPP installation during setup

3. **Git Installation**
   - Download Git from [https://git-scm.com/download/win](https://git-scm.com/download/win)
   - Install Git with default settings

## Project Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/coinbase_eth_saver.git
   cd coinbase_eth_saver
   ```

2. **Configure XAMPP**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services
   - Click on "Config" button for Apache and select "httpd.conf"
   - Find the `DocumentRoot` and `Directory` settings and update them to point to your project's public folder:
     ```apache
     DocumentRoot "C:/xampp/htdocs/coinbase_eth_saver/public"
     <Directory "C:/xampp/htdocs/coinbase_eth_saver/public">
     ```

3. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `coinbase_eth_saver`
   - Import the `database/coinbase_eth_saver.sql` file

4. **Environment Configuration**
   - Copy `.env.example` to `.env`
   - Update the following settings in `.env`:
     ```
     CI_ENVIRONMENT = development
     database.default.hostname = localhost
     database.default.database = coinbase_eth_saver
     database.default.username = root
     database.default.password = 
     ```

5. **Composer Dependencies**
   - Open Command Prompt in your project directory
   - Run the following commands:
     ```bash
     composer install
     ```

## Fixing Composer Name Error

If you encounter a name error in `composer.json`, follow these steps:

1. **Open composer.json**
   - Make sure the name follows the format: `vendor/package-name`
   - Example:
     ```json
     {
         "name": "yourusername/coinbase-eth-saver",
         "description": "Coinbase ETH Saver Application",
         ...
     }
     ```

2. **Common Windows-specific Issues**
   - If you get permission errors, run Command Prompt as Administrator
   - If you get path-related errors, use forward slashes (/) instead of backslashes (\) in paths
   - Make sure PHP is in your system's PATH environment variable

3. **Verify PHP Version**
   ```bash
   php -v
   ```
   - Should show PHP 8.1 or higher

## Running the Application

1. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

2. **Access the Application**
   - Open your browser
   - Navigate to `http://localhost/coinbase_eth_saver/public`

## Troubleshooting

1. **Permission Issues**
   - Right-click on the project folder
   - Properties → Security
   - Make sure the XAMPP user has read/write permissions

2. **Apache Configuration**
   - If you get a 404 error, check your Apache configuration
   - Make sure mod_rewrite is enabled in XAMPP

3. **Database Connection**
   - Verify MySQL is running
   - Check database credentials in `.env`
   - Make sure the database exists

4. **Composer Issues**
   - Clear Composer cache:
     ```bash
     composer clear-cache
     ```
   - Update Composer:
     ```bash
     composer self-update
     ```

## Additional Notes

- Always use forward slashes (/) in file paths, even on Windows
- Keep XAMPP's PHP version updated
- Make sure to run Composer commands from the project root directory
- If you get SSL certificate errors, you might need to configure Composer to use the correct certificates

For any issues not covered here, please check the main README.md file or create an issue in the repository. 