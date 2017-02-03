<?php
class sp_home_class
{
    var $return = array('html'=>''); // (array) content all items for the return

    function __constructor()
    {
        echo ' morue ';
    }
    function view()
    {
    global  $twig;

    $template = $twig->loadTemplate('sp_home/home.html');
    
    echo $template->render(array(
	     'moteur_name' => 'Twig'
    ));

    }
}
