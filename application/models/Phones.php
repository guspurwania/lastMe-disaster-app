<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Phones extends Eloquent
{
	protected $table	= 'phones';
	protected $fillable = [
		'user_id',
		'phone'
	];
	public $timestamps	= true;

	public function user()
	{
		return $this->belongsTo('Users');
	}

}