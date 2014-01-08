<?php namespace Connor4312\LaravelForums;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

	protected $table = 'f_topics';

	public function replies() {
		return $this->hasMany('Reply');
	}

	public function category() {
		return $this->belongsTo('Category');
	}

	public function author() {
		return $this->belongsTo('Profile');
	}
}