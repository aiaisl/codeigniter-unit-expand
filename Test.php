<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once( APPPATH . 'controllers/Test_Controller.php' );

class Test extends Test_Controller {

	public function index()
	{
		$this->registTest(__Class__);
	}

	public function testFail()
	{
		$test = 1 + 2;
		$result = ($test == 2) ? true : false;

		$this->unit->run($test, 'is_true', '注定失败的测试');
	}

	public function testSuccess()
	{
		$test = 2 - 2;
		$result = ($test == 0) ? true : false;

		$this->unit->run($result, 'is_true', '这个测试会成功');
	}

}

/* End of file testCar.php */
/* Location: ./application/controllers/testCar.php */
