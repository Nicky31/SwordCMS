<?php
if(!empty($jobs)) // S'il a des métiers
{
	foreach ($jobs as $k => $v)
	{
		echo'<br>';

					  
		echo' <div class="metier">
			  <img src="'. img_url('armurerie/jobs/'.$k.'.png') . '" style="float:left;margin:31px -10px 0px 20px;" />
			  <span style="float:left;color:rgb(94,73,17);font-weight:bold;font-size:140%; margin:31px 15px 0px 20px;">'.$v['name'] .'</span>
			  <span style="float:left;margin-left:-81px;color:rgb(152,164,73);font-weight:bold;font-size:120%;margin-top:30px;"><br>Niveau: '.$v['level'].'</span>
			  </div>';
	}
			
}
else
	echo '<br><br><br><div class="metier">
	      <span style="float:left;margin-left:235px;margin-top:25px;color:rgb(94,73,17);font-weight:bold;font-size:140%">Aucun métier</span>
		  </div>';
?>
</div>