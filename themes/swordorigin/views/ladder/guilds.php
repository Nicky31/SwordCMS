<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1">
	<center>
	 <table class="table table-bordered table-striped table-condensed">
	    <tr>
	      <td><center><b>Place</b></center></td>
	      <td><b><center>Nom</center></b></td>
	      <td><b><center>Niveau</center></b></td>
	      <td><b><center>Experience</center></b></td>
	      <td><b><center>Membres</center></b></td>
	    </tr>
	  
	    <?php foreach($guilds as $guild): ?>
	      <tr>
		<td><center><?php echo $num_guild++; ?></center></td>
		<td><center><?php echo $guild['name']; ?></center></td>
		<td><center><?php echo $guild['lvl']; ?></center></td>
		<td><center><?php echo $guild['xp']; ?></center></td>
		<td><center><?php echo $guild['membersCount']; ?></center></td>
	      </tr>
	    <?php endforeach; ?>
	 </table>
	 
	 <?php echo $pagination; ?>
	</center>
      </div>		
    </div>
  </div>
</section>