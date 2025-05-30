<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('EthPrice_model');
    }
    
    public function index() {
        // Fetch and save the latest price
        $this->EthPrice_model->fetch_and_save_price();
        
        // Get the latest price and recent prices
        $data['latest_price'] = $this->EthPrice_model->get_latest_price();
        $data['recent_prices'] = $this->EthPrice_model->get_recent_prices(10);
        
        // Load the view
        $this->load->view('home', $data);
    }
} 