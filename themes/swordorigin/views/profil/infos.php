<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1">
	<center>
	 <table class="table table-bordered table-striped table-condensed">
	    <tr> 
	      <td> <b>Nom de compte :</b></td>
	      <td> <?php echo htmlspecialchars($_SESSION['account']); ?> </td>
	      <td> <a href="<?php echo site_url('profil','setAccount'); ?>"> <?php echo img('icones/config.png');?> </a> </td>
	    </tr>
	    
	    <tr> 
	      <td> <b>Pseudo :</b></td>
	      <td> <?php echo htmlspecialchars($_SESSION['pseudo']); ?> </td>
	    </tr>
	    
	    <tr> 
	      <td> <b>Mot de passe :</b></td>
	      <td> ******* </td>
	      <td> <a href="<?php echo site_url('profil','setPassword'); ?>"> <?php echo img('icones/config.png');?> </a> </td>
	    </tr>
	    
	    <tr> 
	      <td> <b>E-Mail :</b></td>
	      <td> <?php echo htmlspecialchars($_SESSION['email']); ?> </td>
	      <td> <a href="<?php echo site_url('profil','setEmail'); ?>"> <?php echo img('icones/config.png');?> </a> </td>
	    </tr>
	    
	    <tr> 
	      <td> <b>Question secrète :</b></td>
	      <td> <?php echo htmlspecialchars($_SESSION['question']); ?> </td>
	      <td> <a href="<?php echo site_url('profil','setQuestion'); ?>"> <?php echo img('icones/config.png');?> </a> </td>
	    </tr>
	    
	    <tr> 
	      <td> <b>Nombre de pts boutique :</b></td>
	      <td> <?php echo intval($_SESSION['pts']); ?> </td>
	    </tr>

	    <tr>
	    	<form method="post" action="<?php echo site_url('perso','index',$_SESSION['persos'][0]['name']); ?>" id="persoForm">
		    	<td><b>Mes persos :</b></td>
		    	<td>
			    		<select name="perso" id="listPersos">
				      		<?php foreach($_SESSION['persos'] as $perso) : ?>
								<option value="<?php echo $perso['name']; ?>"><?php echo $perso['name']; ?></option>
				      		<?php endforeach; ?>
				    	</select>
		    	</td>
		    	<td><button type="submit"><?php echo img('icones/loupe.png'); ?></button></td>
	    	</form>
	    </tr>

	 </table>
	</center>
      </div>		
    </div>
  </div>
</section>

<script>
$('#listPersos').change(function() {
    $('#persoForm').attr('action','<?php echo site_url('perso','index') . '/';?>' + $('#listPersos').val());
});
</script>