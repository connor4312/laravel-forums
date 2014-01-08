<?php namespace Connor4312\LaravelForums;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	protected $table = 'f_profiles';

	public function user() {
		return $this->belongsTo('User');
	}
}