<?php

function return_time($sec) // Transforme un nbre de secs en H / m / s
{
	if($sec <= 60) // s'il n'y a qu'une minute ou moins
		return $sec." secondes";
	elseif($sec <= 3600) // S'il n'y à qu'une heure ou moins
		return floor($sec / 60).' minutes, '. $sec % 60 .' secondes';
	else
	{
		$hours = floor($sec / 3600);
		$minuts = floor(($sec % 3600) / 60);
		$secs = $sec % 60;
		return $hours .' heures , '. $minuts .' minutes et '. $secs .' secondes.';
	}
}

function display($str)
{
$str = htmlspecialchars($str);
$str = nl2br($str);

// BBCode
$str = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $str);
$str = preg_replace('#\[u\](.+)\[/u\]#isU', '<u>$1</u>', $str);
$str = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $str);
$str = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $str);
$str = preg_replace('#\[color=(red|green|blue|yellow|purple|olive|black|white)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $str);

return $str;
}

function getSwf($fileName)
{
    $script = '<object width="80px;" height="80px" type="application/x-shockwave-flash" data="'.img_url($fileName.'.swf') .'">
                 <param name="movie"  value="'.img_url($fileName.'.swf') .'" />
	  	 <param name="wmode" value="transparent" />
               </object>';
    
    return $script;
}