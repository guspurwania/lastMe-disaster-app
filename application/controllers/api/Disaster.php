<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
use \Httpful\Request;

class Disaster extends REST_Controller {

    private $url = "http://realtime.inasafe.org/realtime/api/v1/earthquake-feature/";

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->config('rest');
        $this->load->config('ion_auth', TRUE);

        $this->load->library(array('ion_auth','form_validation','image_custom','email_custom', 'mainapi'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->model([
			'Users',
            'Phones'
		]);
		$this->qisqus = $this->config->item('qisqus');
    }

    public function disaster_get()
    {
        $SWLon = $this->get('SWLon');
        $SWLat = $this->get('SWLat');
        $NELon = $this->get('NELon');
        $NELat = $this->get('NELat');
        $min_magnitude = $this->get('min_magnitude');
        $since_last_hours = $this->get('since_last_hours');
        $response = Request::get($this->url.'?SWLon='.$SWLon.'&SWLat='.$SWLat.'&NELon='.$NELon.'&NELat='.$NELat.'&since_last_hours='.$since_last_hours.'&min_magnitude='.$min_magnitude.'&format=json')
                    ->send();

        $this->response([
            'code' => 200,
            'status' => 'OK',
            'message' => '',
            'results' => $response->body
        ], REST_Controller::HTTP_OK);
    }

}