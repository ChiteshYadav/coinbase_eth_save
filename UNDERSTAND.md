# Understanding the Coinbase ETH Price Saver Project

This document provides an overview of the project structure and explains how the different components interact to fetch, save, and display Ethereum (ETH) buy prices.

## Project Structure

The project follows the Model-View-Controller (MVC) architectural pattern used by CodeIgniter 3. The key directories and files are:

-   `public/`: This is the webroot directory. Only files within this directory are directly accessible from the web. The `index.php` file here serves as the single entry point for all requests.
-   `application/`: This directory contains the core application logic, including controllers, models, views, and configuration files.
    -   `application/config/`: Contains configuration files.
        -   `database.php`: Configures the connection to the MySQL database.
        -   `routes.php`: Defines the URL routing rules, mapping URLs to controller methods.
    -   `application/controllers/`: Contains the controller classes.
        -   `Home.php`: The main controller for the homepage. It handles fetching data and loading the view.
    -   `application/models/`: Contains the model classes.
        -   `EthPrice_model.php`: Handles data interaction, including fetching data from the Coinbase API and saving/retrieving data from the database.
    -   `application/views/`: Contains the view files.
        -   `home.php`: The template file that displays the ETH price data.
-   `system/`: Contains the core CodeIgniter framework files. You generally don't need to modify files in this directory.

## Application Flow

When a user accesses the homepage (`http://localhost:8080`), the following process occurs:

1.  **Request Entry Point:** The request is directed to `public/index.php`. This file initializes the CodeIgniter framework.
2.  **Routing:** CodeIgniter's router (configured in `application/config/routes.php`) determines which controller and method should handle the request. In this project, the default route is set to the `Home` controller's `index` method.
3.  **Controller Execution:** The `Home::index()` method is executed.
    -   It first calls `$this->EthPrice_model->fetch_and_save_price();`. This triggers the logic to:
        -   Make a request to the Coinbase API (`https://api.coinbase.com/v2/prices/ETH-USD/buy`).
        -   Parse the JSON response.
        -   If the price is successfully retrieved, it calls `$this->save_price($price);` within the model to insert the price and a timestamp into the `eth_prices` table in the database.
    -   After fetching and saving, `Home::index()` then calls `$data['latest_price'] = $this->EthPrice_model->get_latest_price();` to get the single most recent price.
    -   It also calls `$data['recent_prices'] = $this->EthPrice_model->get_recent_prices(10);` to get the last 10 saved prices from the database.
    -   Finally, it loads the `home` view, passing the `$data` array containing the latest price and the list of recent prices: `$this->load->view('home', $data);`.
4.  **View Rendering:** The `application/views/home.php` file receives the `$latest_price` and `$recent_prices` data.
    -   It checks if `$latest_price` exists and displays the latest price and timestamp in a prominent box.
    -   It checks if `$recent_prices` is not empty and loops through the array to display each recent price entry in a list format.
5.  **Response:** The rendered HTML from the view is sent back to the user's browser.

This flow ensures that each time the homepage is visited, the latest ETH buy price is recorded in the database, and the page displays both the very latest recorded price and a history of recent prices. 