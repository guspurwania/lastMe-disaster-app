<?php

class One_signal
{

    protected $CI;

    private $app_id = "cb47830c-20f5-4570-9183-fee5351f1447";
    private $url = "https://onesignal.com/api/v1/notifications";

    public function __construct()
    {   
        $this->CI =& get_instance();
    }

    function sendNotification($player_id, $content, $data, $url = 'http://dokterchat.dartdevproject.id/dashboard')
    {   
        $fields = array(
            'app_id' => $this->app_id,
            'include_player_ids' => $player_id,
            'contents' => $content,
            'data' => $data,
            'url' => $url
        );
        
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic ZTAwN2UyYTMtZjVhNS00MzY5LWE5YzMtMDA2ZTE0YzdhZGQz'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
    }
}