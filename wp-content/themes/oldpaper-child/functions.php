<?php

if ( function_exists( 'register_sidebar' ) ){
    register_sidebar(array(
		'name'=>'Add space',
        'description' => 'Customizable add space',
        'before_widget' => '<div class="widget col-sm-12 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        //'before_title' => '<h4><span>',
        //'after_title' => '</span></h4>',
    ));
}

?>