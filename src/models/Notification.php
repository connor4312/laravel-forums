<?php namespace Connor4312\LaravelForums;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	protected $table = 'f_notifications';

	public function author() {
		return $this->belongsTo('Profile');
	}
}