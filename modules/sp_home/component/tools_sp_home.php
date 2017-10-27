<?php

use \salva_powa\sp_component;
use \Stripe\Stripe;

class tools_sp_home extends sp_component
{

        var $tools_sp_home_connected = false;

        function __construct()
        {
              $this->name = 'tools_sp_home';
        }

}
