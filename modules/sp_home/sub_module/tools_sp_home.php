<?php

use \salva_powa\sp_sub_module;
use \Stripe\Stripe;

class tools_sp_home extends sp_sub_module
{

        var $tools_sp_home_connected = false;

        function __construct()
        {
              $this->name = 'tools_sp_home';
        }

}
