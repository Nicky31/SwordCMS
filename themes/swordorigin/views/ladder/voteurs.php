<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1">
	<center>
	 <table class="table table-bordered table-striped table-condensed">
	    <tr>
	      <td><b><center>Place</center></b></td>
	      <td><b><center>Pseudonyme</center></b></td>
	      <td><b><center>Nombre de vote</center></b></td>
	    </tr>
	    
	    <?php foreach($voteurs as $voteur): ?>
	      <tr>
		<td><center><?php echo $num_voteur++; ?></center></td>
		<td><center><?php echo $voteur['pseudo']; ?></center></td>
		<td><center><b><?php echo $voteur['vote']; ?></b></center></td>
	      </tr>
	    <?php endforeach; ?>
	 </table>
	 
	 <?php echo $pagination; ?>
	</center>
      </div>		
    </div>
  </div>
</section>
