<div id="inventaire">
	<?php foreach($stuff as $k => $v) : ?>
		<?php if(array_key_exists($k,$css)) : 
                    $swfName = (file_exists(ASSETS_PATH.'/shared/images/items/'.$v[0].'.swf')) ? $v[0] : '0';
	   echo '<object style="'.$css[$k].'cursor:pointer;" onMouseOver="setStats(\''.htmlspecialchars($v[4]).'\'); return false;" onmouseout="clearStats(); return false;" width="45px;" height="55px" type="application/x-shockwave-flash" data="'.img_url('items/'. $swfName .'.swf').'">
			<param name="movie" value="'.img_url('items/'. $v[0] .'.swf').'" />
			<param name="wmode" value="transparent" />
			</object>';
			endif;	
	endforeach; ?>

</div>

<div id="stats">

</div>


</div>
<script>
var elStat = document.getElementById('stats');

    function setStats(content)
    {   
       elStat.innerHTML = content;
    }
    
    function clearStats()
    {
        elStat.innerHTML = '';
    }
    
</script>