<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
use \Httpful\Request;

class Authenticate extends REST_Controller {

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
			'Users'
		]);
		$this->qisqus = $this->config->item('qisqus');
    }

    public function otp_post()
    {
        $response = $this->mainapi->get_otp($this->post('phone'));
        $this->response($response, REST_Controller::HTTP_OK);

        if($response['status'])
        {
            $this->response([
                'code' => 200,
                'status' => 'OK',
                'message' => "OTP Send Successfully"
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'code' => 400,
                'status' => 'FAILED',
                'message' => "Send OTP Failed"
            ], REST_Controller::HTTP_OK);
        }
    }

    public function otp_verify_post()
    {
        $response = $this->mainapi->validate_otp($this->post('otp'));

        if($response['status'])
        {
            $this->response([
                'code' => 200,
                'status' => 'OK',
                'message' => "OTP Verified"
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'code' => 400,
                'status' => 'FAILED',
                'message' => "OTP Not Valid"
            ], REST_Controller::HTTP_OK);
        }
    }

    public function register_post()
    {
        $phone = $this->input->post('phone');
        $phone_count = $this->db->query("SELECT * FROM users WHERE phone = '".$phone."'")->row();

        if($phone_count)
    	{
            $this->response([
				'code' => 400,
                'status' => 'FAILED',
                'message' => "Phone Number is used"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else
        {

            $user = new Users;
            $user->name = $this->input->post('name');
            $user->email = $this->input->post('email');
            $user->phone = $this->input->post('phone');

            if($user->save())
            {
                $this->response([
                    'code' => 201,
                    'status' => 'OK',
                    'message' => 'User Created'
                ], REST_Controller::HTTP_CREATED);
            }
            else
            {
                $this->response([
                    'code' => 400,
                    'status' => 'FAILED',
                    'message' => "Can't Register User"
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

}