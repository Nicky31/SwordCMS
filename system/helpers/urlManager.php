<?php

function site_url($uri = '')
{		
    if( ! is_array($uri))
    {
        $uri = func_get_args();
    }

    $stringUrl = BASE_PATH .'/index.php';	

    foreach($uri as $current)
        $stringUrl .= '/'.$current;
		
    return $stringUrl;
}

function url($text, $uri = '')
{
	if( ! is_array($uri))
	{
		$uri = func_get_args();

		//	Suppression de la variable $text
		array_shift($uri);
	}
	
	echo '<a href="' . site_url($uri) . '">' . htmlentities($text) . '</a>';
	return '';
}

function up_url($file)
{
	return BASE_PATH . '/uploads/' . $file;
}