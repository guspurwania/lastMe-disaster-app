<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
use \Httpful\Request;

class User extends REST_Controller {

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

    public function update_last_location_post()
    {
        $user = Users::find($this->post('user_id'));
        $user->lat = $this->post('lat');
        $user->lng = $this->post('lng');

        if($user->save())
        {
            $this->response([
                'code' => 200,
                'status' => 'OK',
                'message' => "Location Updated"
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'code' => 400,
                'status' => 'FAILED',
                'message' => "Can't update location"
            ], REST_Controller::HTTP_OK);
        }
    }

    public function friends_location_get()
    {
        $user_id = $this->get('user_id');
        $phones = Phones::where('user_id', $user_id)->get();
        $data = array();
        foreach ($phones as $key => $value) {
            $phone = $value['phone'];
            array_push($data, $phone);
        }

        $users = Users::whereIn('phone', $data)->get();

        $this->response([
            'code' => 200,
            'status' => 'OK',
            'data' => $users,
            'message' => ''
        ], REST_Controller::HTTP_OK);
    }

    public function user_by_phone_get()
    {
        $phone = $this->get('phone');
        $user = Users::where('phone', $phone)->first();

        $this->response([
            'code' => 200,
            'status' => 'OK',
            'data' => $user,
            'message' => ''
        ], REST_Controller::HTTP_OK);
    }

}