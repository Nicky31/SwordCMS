<div id="armurerie">
	<div id="profilBg">
		<div id="head"><?php echo $head; ?></div>
		<div id="name"> <?php echo $name; ?> </div>
		<div id="guild"><?php echo $guild; ?> </div>
	</div><br>
	
	<div id="boutons">
		<a href="<?php echo site_url('perso','jobs',$pseudo); ?>" id="armurerie-métiers">
			<div class="bouton-armurerie"><strong>Métiers</strong></div>
		<a>
							
		<a href="<?php echo site_url('perso','stuff',$pseudo); ?>" id="armurerie-stuff">
			<div class="bouton-armurerie"><strong>Equipements</strong></div>
		</a>

		<a href="<?php echo site_url('perso','stats',$pseudo); ?>" id="armurerie-carac">
			<div class="bouton-armurerie"><strong>Caractéristiques</strong></div>
		</a>
	</div> <br />
