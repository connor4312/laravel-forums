<?php namespace Connor4312\LaravelForums;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'f_categories';

	public function children() {
		return $this->hasMany('Category');
	}

	public function topics() {
		return $this->hasMany('Topic');
	}
}