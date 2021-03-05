<?php


class CreativeQA {
    private $endpoint = 'ENTER_YOUR_ENDPOINT_HERE';
    private $api_key = 'ENTER_YOUR_API_KEY_HERE';
    private $timeout = 120;
    private $err = '';
    
    public function __construct() {
        
    }
    
    public function scanZip($filename) {
        $binary = file_get_contents($filename);
        if($binary === false) {
            $this->err = 'Cannot read filename ' . $filename;
            return false;
        }
        $arr_data = array(
            'data' => base64_encode($binary)
        );
        return self::callAPI('/v3.0/scan/zip', 'POST', $arr_data);
    }
    
    public function scanTag($tag) {
        $arr_data = array(
            'data' => base64_encode(trim($tag))
        );
        return self::callAPI('/v3.0/scan/tag', 'POST', $arr_data);
    }
    
    public function scanVAST($url) {
        $arr_data = array(
            'data' => base64_encode($url)
        );
        return self::callAPI('/v3.0/scan/vast', 'POST', $arr_data);
    }
    
    public function getError() {
        return $this->err;
    }
    
    
    
    
    // ------------------
    // Private functions
    // ------------------
    
    private function callAPI($uri, $method, $arr_data=[]) {
        if($this->endpoint == 'ENTER_YOUR_ENDPOINT_HERE') {
            $this->err = "Endpoint not set. Open CreativeQA.class.php and enter your endpoint (sent by email).";
            return false;
        }
        if($this->endpoint == 'ENTER_YOUR_API_KEY_HERE') {
            $this->err = "API Key not set. Open CreativeQA.class.php and enter your API Key (sent by email).";
            return false;
        }
        
        $url = rtrim($this->endpoint,'/').$uri;
        $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_USERAGENT, "CreativeQA SDK v3.0");
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr_data));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
          curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-ApiKey: '.$this->api_key]);
          $response = json_decode(curl_exec($ch), true);
          $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          $curl_error = curl_error($ch);
        curl_close($ch);
        
        if(!is_array($response)) {
            $this->err = 'cURL error: ' . $curl_error;
            return false;
        }
        
        if($http_code!=200) {
            $this->err = $response['error_type'] . ': '. $response['message'];
            return false;
        }
        
        $this->err = '';
        return $response;
    }
}

?>
