<?php
class sp_autoloader
{
	static function register()
	{
			spl_autoload_resgister( array( __CLASS__, 'autoload' ) );
	}
	static function autoload( $class_name )
	{
			require $class_name . 'php';
	}
}
