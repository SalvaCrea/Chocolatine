<?php
global $current_user;

if ( !empty( $_POST['action_ajax'] ) && isset( $_POST['action_ajax'] ) ) {

    $var_ajax_controller =  new sp_ajax_controller();
    $var_ajax_controller->action = $_POST['action_ajax'];

    // control de l'écriture
    if (  is_admin() || $_POST['args']['post_author'] == $current_user->ID ) {

        $var_ajax_controller->args = $_POST['args'];
        $var_ajax_controller->controller();

    }

}



 ?>
