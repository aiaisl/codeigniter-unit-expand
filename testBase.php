<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
	}
	
	public function index()
	{
		$this->callTestMethods($this->getTestMethods());
		echo $this->unit->result();
	}

	public function getTestMethods()
	{
		$methods = get_class_methods(__Class__);
		foreach ($methods as $key => $method) {
			if(substr($method, 0, 4) != 'test') {
				unset($methods[$key]);
			}
		}
		return $methods;
	}

	public function callTestMethods($methods)
	{
		foreach ($methods as $key => $method) {
			call_user_func(array(__Class__, $method));
		}
	}
}
