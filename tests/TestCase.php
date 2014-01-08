<?php namespace Connor4312\LaravelForums;

use Mockery;
use Artisan;

class TestCase extends \Orchestra\Testbench\TestCase {

	/**
	 * Sets up testing environment
	 * 
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->resetTables();
	}

	/**
	 * Tears down the testing environment
	 * 
	 * @return void
	 */
	public function tearDown() {
		parent::tearDown();

		Mockery::close();
	}

	/**
	 * Runs the migrations for the database via Artisan.
	 * 
	 * @return void
	 */
	protected function resetTables() {

		if ($this->migrated) {
			Artisan::call('migrate:refresh');
		} else {
			Artisan::call('migrate');
		}
	}

}
