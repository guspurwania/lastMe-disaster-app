<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
use \Httpful\Request;

class Setting extends REST_Controller {

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

    public function setting_post()
    {
        $status = TRUE;
        for($i = 0; $i < sizeof($this->post('phone')); $i++)
        {
            $phone = new Phones;
            $phone->user_id = $this->post('user_id');
            $phone->phone = $this->post('phone')[$i];
            if($phone->save())
            {
                $status = TRUE;
            }
            else
            {
                $status = FALSE;
            }
        }


        if($status)
        {
            $this->response([
                'code' => 200,
                'status' => 'OK',
                'message' => "Phones Created"
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'code' => 400,
                'status' => 'FAILED',
                'message' => "Can't created phones"
            ], REST_Controller::HTTP_OK);
        }
    }

}