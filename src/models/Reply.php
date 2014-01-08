<?php namespace Connor4312\LaravelForums;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $table = 'f_replies';

	public function post() {
		return $this->belongsTo('Category');
	}

	public function author() {
		return $this->belongsTo('Profile');
	}

	public function responding() {
		return $this->belongsTo('Reply', 'responding_id');
	}
}