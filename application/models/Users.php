<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
	protected $table	= 'users';
	protected $fillable = [
		'name',
		'email',
		'phone',
		'lat',
		'lng'
	];
	public $timestamps	= true;

	public function phones()
	{
		return $this->hasMany('Phones', 'user_id');
	}

}