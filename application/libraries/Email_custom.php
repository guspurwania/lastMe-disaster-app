<?php

class Email_custom {

    protected $CI;

    private $protocol = 'smtp';
    private $smtp_host = 'dartdevproject.id';
    private $smtp_port = 587;
    private $smtp_user = 'noreply@dartdevproject.id';
    private $smtp_pass = 'z5#t?x3Ty]gs';
    private $mailtype = 'html';
    private $charset = 'utf-8';
    private $wordwrap = TRUE;
    private $email_config;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->library('email');

        $this->email_config = array(
            'protocol' => $this->protocol,
            'smtp_host' => $this->smtp_host,
            'smtp_port' => $this->smtp_port,
            'smtp_user' => $this->smtp_user,
            'smtp_pass' => $this->smtp_pass,
            'mailtype' => $this->mailtype,
            'charset' => $this->charset,
            'wordwrap' => $this->wordwrap,
            'newline' => "\r\n"
        );
    }

    public function send_mail($from, $from_name = 'Dokter Chat', $to, $subject, $message)
    {
        $this->CI->email->initialize($this->email_config);
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->from($from, $from_name);
        $this->CI->email->to($to);

        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        if($this->CI->email->send())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}