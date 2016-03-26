<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1">
	<center>
	 <table class="table table-bordered table-striped table-condensed">
	    <tr> 
	      <td> <b>Rang</b></td>
	      <td> <b>Race</b></td>
	      <td> <b>Nom</b></td>
	      <td> <b>Level</b></td>
              <td> <b>Expérience</b></td>
	      <td> <b>Alignement</b></td>
	    </tr>
	    
	    <?php foreach($persos as $perso) : ?>
	      <tr>
		<td><center> <?php echo $num_perso++; ?></center></td>
		<td> <img src='<?php echo img_url('icones/heads/'.$perso['class'].'.png'); ?>' > </td>
		<td> <a style="color: #92979E;" href="<?php echo site_url('perso','index',$perso['name']); ?>"><?php echo $perso['name']; ?></a> <span style="float: right;"> <img alt="Sexe" title="Sexe" class="icon_li" src="<?php echo img_url('icones/'.$perso['sexe'].'.png'); ?>" /></span></td>
		<td><center><?php echo $perso['level']; ?></center></td>
                <td><center><?php echo $perso['xp']; ?></center></td>
		<td><center><img alt='Alignement' title='Alignement' src='<?php echo img_url('icones/heads/align/'.$perso['alignement'].'.png'); ?>'/></center></td>
	      </tr>
	    <?php endforeach; ?>
	 </table>
	 
	 <?php echo $pagination; ?>
	</center>
      </div>		
    </div>
  </div>
</section>
