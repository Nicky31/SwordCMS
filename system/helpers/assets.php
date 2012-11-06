<?php  

function img_url($nom)
 {
	return BASE_PATH . '/' . ASSETS_DIR . '/images/' . $nom;
 }
	
 function css_url($nom)
 {
        return '<LINK rel="stylesheet" href="'. BASE_PATH.'/'. ASSETS_DIR.'/'. $nom .'.css" type="text/css"/>';
 }
	
function img($nom, $alt = '')
 {
	return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
 }

 

