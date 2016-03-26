<section class="grid-block position-bg-grey" id="innertop-a">
	<div class="grid-box width100 grid-h">
    	<div class="module deepest" style="min-height: 542px;">
      		<div class="frontpage-teaser-1"> 
				<center> 
					<table class="table table-bordered table-striped table-condensed">
					<tr>
						<td><b>Titre du tutoriel</b></td>
						<td><b>Auteur</b></td>
						<td><b>Lire</b></td>
						<td><b>Editer</b></td>
						<td><b>Supprimer</b></td>

						<?php foreach($threads as $tutorial): ?>
							<tr>
								<td><?php echo htmlspecialchars($tutorial['titre']); ?> </td>
								<td><?php echo htmlspecialchars($tutorial['auteur']); ?></td>
								<td><a href="<?php echo site_url('comments','index',$tutorial['id']); ?>"><?php echo img('icones/loupe.png'); ?></a></td>

								<?php if($gm || (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == $tutorial['auteur'])) : ?>
								<td><a href="<?php echo site_url('thread','edit',intval($tutorial['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/edit.png'); ?></a></td>
								<td><a href="<?php echo site_url('thread','delete',intval($tutorial['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/del.png'); ?></a></td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					</table>

					<?php if(empty($threads)) : ?>
						<center><div class="alert alert-danger">Aucun tutoriel n'est encore disponible !</div></center>
					<?php endif; ?>

					<?php if($gm): ?>
					<br />
					<hr />

					<table>
					<form method="post" action="<?php echo site_url('thread','add'); ?>">
					<input type="hidden" name="type" value="tutorial" />
					<tr> 
					  <td align="center">Titre :</td> 
					  <td align="center"><input type="text" name="title" id="titre" style="width:480px;" placeholder="Titre du tutoriel ..."/></td>
					</tr>

					<tr>
					  <td align="center">Tutoriel :</td>
					  <td align="center"><textarea name="content" cols="70" rows="14" style="width:480px;"></textarea></td>
					</tr> <br />

					<tr> <td align="center"></td> </br> <td align="right"><input class="btn btn-info" type="submit" value="Envoyer"/></input></td></tr>
					</td></tr>
					</form>
					</table>
					<?php endif; ?>

				</center>
			</div>
		</div>
	</div>
</section>
