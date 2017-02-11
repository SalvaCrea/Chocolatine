<?php

function sp_dump( $array=false, $ajax=false ) {

    if ($array===false) { return false; }
    if (!$ajax) {
    echo '<pre>'.print_r($array, true).'</pre>';
    }
    if ($ajax) {
        $a = json_encode($array);
        echo "
            <script>
            console.log(".$a.");
            </script>
        ";
    }
    return true;

}

function sp_ressource()
{
    global $sp;
    // delete Jquery ressource of Wordpress
    wp_deregister_script( 'jquery' );
    // personnal style sheet
    wp_enqueue_style( 'styleCss',$sp['url'] . '/css/style.css' );

    wp_enqueue_style( 'boostrapCss',$sp['url'] . '/bower_components/bootstrap/dist/css/bootstrap.css' );
    wp_enqueue_script( 'boostrapJs',$sp['url'] . '/bower_components/bootstrap/dist/js/bootstrap.js' );

}
