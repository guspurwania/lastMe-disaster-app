<?php

class Image_custom
{
	protected $CI;

	private $avatar_path = './assets/images/avatar';
	private $avatar_width = 300;
	private $avatar_height = 300;

	private $token_path = './assets/images/token';
	private $token_width = 300;
	private $token_height = 900;

	private $expert_category_path = './assets/images/expert_category';
	private $expert_category_width = 281;
	private $expert_category_height = 288;

	private $bank_icon_path = './assets/images/bank';
	private $bank_icon_width = 500;
	private $bank_icon_height = 300;

	public function __construct()
	{	
		$this->CI =& get_instance();
	}

	public function upload_image($path, $files, $width, $height)
	{
		$config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']			= uniqid();
        $config['file_ext_tolower']		= TRUE;

        $this->CI->load->library('upload', $config);

        if ( ! $this->CI->upload->do_upload($files))
        {
            $error = array('error' => $this->CI->upload->display_errors());
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->CI->upload->data());
            $img_config['image_library'] 	= 'gd2';
			$img_config['source_image'] 	= $data['upload_data']['full_path'];
			$img_config['create_thumb'] 	= FALSE;
			$img_config['maintain_ratio'] 	= TRUE;
			$img_config['width']         	= $width;
			$img_config['height']       	= $height;

			$this->CI->load->library('image_lib', $img_config);
			$this->CI->image_lib->resize();

            return $data;
        }
	}

	public function unlink_image($path, $image_name)
	{
		if(file_exists($path.'/'.$image_name))
		{
			if(unlink($path.'/'.$image_name))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function upload_avatar($file)
	{
		return $this->upload_image($this->avatar_path, $file, $this->avatar_width, $this->avatar_height);
	}

	public function upload_token($file)
	{
		return $this->upload_image($this->token_path, $file, $this->token_width, $this->token_height);
	}

	public function upload_expert_category($file)
	{
		return $this->upload_image($this->expert_category_path, $file, $this->expert_category_width, $this->expert_category_height);
	}

	public function upload_bank_icon($file)
	{
		return $this->upload_image($this->bank_icon_path, $file, $this->bank_icon_width, $this->bank_icon_height);
	}

	public function unlink_avatar($image_name)
	{
		return $this->unlink_image($this->avatar_path, $image_name);
	}

	public function unlink_token($image_name)
	{
		return $this->unlink_image($this->token_path, $image_name);
	}

	public function unlink_expert_category($image_name)
	{
		return $this->unlink_image($this->expert_category_path, $image_name);
	}

	public function unlink_bank_icon($image_name)
	{
		return $this->unlink_image($this->bank_icon_path, $image_name);
	}

}