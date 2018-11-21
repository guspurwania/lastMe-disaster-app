<?php

class Tinypng
{
	private $avatar_path = './assets/images/avatar';
	private $avatar_width = 215;
	private $avatar_height = 215;

	private $banner_path = './assets/images/banner';
	private $banner_width = 500;
	private $banner_height = 300;

	private $expert_category_path = './assets/images/expert_category';
	private $expert_category_width = 200;
	private $expert_category_height = 200;

	public function __construct()
	{
		\Tinify\setKey("y69jaOGRELTC8Cj24e8i4cJL0gBFQ18u");
	}

	public function upload_image($path, $files, $width, $height)
	{
		if(!empty($files['tmp_name']))
		{
			$image_name = uniqid() . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);

			$response = false;

			try {
			    $source = \Tinify\fromFile($files["tmp_name"]);
			    $resized = $source->resize(array(
				    "method" => "cover",
				    "width" => $width,
				    "height" => $height
				));
			    $resized->toFile($path. '/' .$image_name);
			    $response = $image_name;
			} catch(\Tinify\AccountException $e) {
			    $response = false;
			} catch(\Tinify\ClientException $e) {
			    $response = false;
			} catch(\Tinify\ServerException $e) {
			    $response = false;
			} catch(\Tinify\ConnectionException $e) {
			    $response = false;
			} catch(Exception $e) {
			    $response = false;
			}

			return $response;
		}
		else
		{
			return false;
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

	public function upload_banner($file)
	{
		return $this->upload_image($this->banner_path, $file, $this->banner_width, $this->banner_height);
	}

	public function upload_expert_category($file)
	{
		return $this->upload_image($this->expert_category_path, $file, $this->expert_category_width, $this->expert_category_height);
	}

	public function unlink_avatar($image_name)
	{
		return $this->unlink_image($this->avatar_path, $image_name);
	}

	public function unlink_banner($image_name)
	{
		return $this->unlink_image($this->banner_path, $image_name);
	}

	public function unlink_expert_category($image_name)
	{
		return $this->unlink_image($this->expert_category_path, $image_name);
	}

}