<?php  

function img_url($nom)
 {
    if(file_exists(ASSETS_PATH . '/shared/images/' . $nom))
    {
        return BASE_PATH . '/' . ASSETS_DIR . '/shared/images/' . $nom;
    }
        
    return BASE_PATH . '/' . ASSETS_DIR . '/'. THEME .'/images/' . $nom;
 }
	
 function css_url($nom)
 {
    if(file_exists(ASSETS_PATH . '/shared/' . $nom . '.css'))
    {
        return '<LINK rel="stylesheet" href="'. BASE_PATH.'/'. ASSETS_DIR.'/shared/'. $nom .'.css" type="text/css"/>';
    }
        
    return '<LINK rel="stylesheet" href="'. BASE_PATH.'/'. ASSETS_DIR.'/'. THEME .'/'. $nom .'.css" type="text/css"/>';
 }

 function js_url($nom)
 {
    if(file_exists(ASSETS_PATH . '/shared/js/' . $nom . '.js'))
    {
        return '<script src="'. BASE_PATH.'/'. ASSETS_DIR.'/shared/js/'. $nom .'.js" type="text/javascript"></script>';
    }
       
    return '<script src="'. BASE_PATH.'/'. ASSETS_DIR.'/'. THEME .'/js/'. $nom .'.js" type="text/javascript"></script>';
 }
 
function img($nom, $alt = '')
 {
    return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
 }

 

