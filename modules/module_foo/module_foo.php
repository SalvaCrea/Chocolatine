<?php
/*
*
*  The module Foo is an exemple of module for the module Salva_powa
*
 */

class module_foo extends sp_module
{
	public function get_name()
	{
			return 'Module Foo';
	}
	public function get_version()
	{
			return '1.0';
	}
	public function view_front()
	{
			echo 'Je suis le front';
	}
	private function view_back()
	{
			echo 'Je suis le back';
	}
	private function field_config()
	{
		$this->field = [
			'name' => 'foo'
		]
	}

}
