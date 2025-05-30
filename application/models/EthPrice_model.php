<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EthPrice_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function fetch_and_save_price() {
        $url = 'https://api.coinbase.com/v2/prices/ETH-USD/buy';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            log_message('error', 'Curl error: ' . curl_error($ch));
            return false;
        }
        
        curl_close($ch);
        
        $data = json_decode($response, true);
        
        if (isset($data['data']['amount'])) {
            $price = $data['data']['amount'];
            return $this->save_price($price);
        }
        
        return false;
    }
    
    public function save_price($price) {
        $data = array(
            'price' => $price,
            'timestamp' => date('Y-m-d H:i:s')
        );
        
        return $this->db->insert('eth_prices', $data);
    }
    
    public function get_latest_price() {
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('eth_prices');
        
        return $query->row();
    }
    
    public function get_recent_prices($limit = 10) {
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('eth_prices');
        
        return $query->result();
    }
} 