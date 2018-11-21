<?php

class Fcm_push
{
    protected $CI;

    private $api_access_key = "AAAAnUiRP5U:APA91bHS3wmgsjWTMxTOMVJY1kAZb5AA96Z8OskOk_jcrb440-Uu0VYbisvO5Mq3wwzB50fA1t-FEzhEW8jvQq8LMRgw5U3_Hvuz1HaohKNfNEqpywbNy8o64tStb4EO8Wd7NlFK44zN";
    private $url = "https://fcm.googleapis.com/fcm/send";

    public function __construct()
    {   
        $this->CI =& get_instance();
    }

    function sendNotification($player_id, $data)
    {   
        $fields = array(
            'registration_ids' => $player_id,
            'data' => $data
        );
        
        $fields = json_encode($fields);

        $headers = array
        (
            'Authorization: key=' . $this->api_access_key,
            'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $this->url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec($ch );
        curl_close( $ch );
    }
}