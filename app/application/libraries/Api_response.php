<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_response {

    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function success($data, $message = 'Success', $code = 200) {
        $this->ci->output
            ->set_content_type('application/json')
            ->set_status_header($code)
            ->set_output(json_encode([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ]));
    }

    public function error($message, $code = 400) {
        $this->ci->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => 'error',
                'message' => $message
            ]));
    }
    
    
}
