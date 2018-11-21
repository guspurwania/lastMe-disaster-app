<?php

class Mainapi
{

    protected $CI;

    private $url = "https://api.mainapi.net/smsotp/1.0.1/otp/12345";

    public function __construct()
    {   
        $this->CI =& get_instance();
    }

    public function get_otp($phone_number)
    {
        $field = array(
            'phoneNum' => $phone_number,
            'digit' => 1 
        );

        $fields = json_encode($field);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Bearer cb110880d795c3e8823df5090c97f066'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    } 

    public function validate_otp($otpstr)
    {
        $field = array(
            'otpstr' => $otpstr,
            'digit' => 1 
        );

        $fields = json_encode($field);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . '/verifications');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Bearer cb110880d795c3e8823df5090c97f066'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

}