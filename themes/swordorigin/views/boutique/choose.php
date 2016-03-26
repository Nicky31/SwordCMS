
<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1">

      	<div class="itemBoutique">
				<div class="name"> <?php echo $item['name']; ?></div>
				<div class="level">Niveau <?php echo $item['level']; ?></div>
				<div class="points"><?php echo $item['points']; ?> points</div>
				<div class="stats">
					<?php echo $item['html']; ?>
				</div>

				<div class="swf">
					<?php echo getSwf('items/'. $item['swf']); ?>
				</div>
				<div class="link"><a style="color:#92979E;">Achat</a></div>
		</div> <br />

		<?php if($_SESSION['pts'] >= $item['points']) { ?>
	       
			<form method="post" action="<?php echo site_url('boutique','buy'); ?>">
				Acheter pour : 
		    	<select name="perso">
		      		<?php foreach($_SESSION['persos'] as $perso) : ?>
						<option value="<?php echo $perso['name']; ?>"><?php echo $perso['name']; ?></option>
		      		<?php endforeach; ?>
		    	</select>
                        
		    	<select name="jet">
		      		<option value="20">Jet Aléatoire</option>
		      		<option value="21">Jet Parfait (<?php echo $item['points'] * $config['perfectPrice']; ?> Points)</option>
		    	</select>
                        
		    	<input type="hidden" name="item" value="<?php echo $item['id']; ?>" />
		    	<button class="btn btn-warning" type="submit">Acheter</button>
			</form> 
		
	      <?php } else { ?>
		 	<center><div class="alert alert-danger">Tu n'as pas assez de points pour acheter cet objet !</div></center>
	      <?php } ?>

      </div>
  </div>
</div>
</section>