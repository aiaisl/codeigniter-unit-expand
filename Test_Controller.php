<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_Controller extends CI_Controller {

	var $unitConfig = array();
	var $testMethod = array();
	var $countResult = 0;
	var $testTarget = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
		$this->unitConfig = array(
			'onlyFail' => false
			);
	}

	public function registTest($testTarget)
	{
		$this->testTarget = $testTarget;

		$this->getTestMethods();

		$this->callTestMethods();

		$this->completeReport();


		echo "共有测试" . count($this->testMethod) . "个";

		echo "失败" . $this->countResult['fail'] . "个";
	}


	public function completeReport()
	{
		$count = array();

		$count['success'] = 0;
		$count['fail'] = 0;
		$count['all'] = count($this->testMethod);

		foreach ($this->unit->result() as $key => $r) {
			if($r['Result'] == 'Failed') {
				$count['fail'] = $count['fail'] + 1;
			} else {
				$count['success'] = $count['success'] + 1;
			}
			echo $this->unit->report(array($r));
		}

		$this->countResult = $count;
	}

	public function getTestMethods()
	{
		$methods = get_class_methods($this->testTarget);

		foreach ($methods as $key => $method) {
			if(substr($method, 0, 4) != 'test') {
				unset($methods[$key]);
			}
		}

		$this->testMethod = $methods;
	}

	public function callTestMethods()
	{
		foreach ($this->testMethod as $key => $method) {
			call_user_func(array($this->testTarget, $method));
		}
	}
}

/* End of file Test_Controller.php */
/* Location: ./application/controllers/Test_Controller.php */
