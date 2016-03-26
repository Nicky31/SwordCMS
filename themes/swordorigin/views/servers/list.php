<section class="grid-block position-bg-grey" id="innertop-a">
	<div class="grid-box width100 grid-h">
    	<div class="module deepest" style="min-height: 542px;">
   			<div class="frontpage-teaser-1">

				<center><h1>Statuts des serveurs</h1></center><br>

				<?php foreach($servers as $server) : ?>

				<h2><?php echo $server['name']; ?> - Statistiques :</h2>
				<table class="table table-bordered table-striped table-condensed">
					<tr> <td>Rate PvM :</td> <td> x<?php echo $server['rateXP']; ?></td></tr>
					<tr> <td>Rate Drop :</td> <td>x<?php echo $server['rateDrop']; ?></td></tr>
					<tr> <td>Rate Kamas :</td> <td> x<?php echo $server['rateKamas']; ?></td></tr>
					<tr> <td>Niveau de depart :</td> <td> <?php echo $server['startLevel']; ?></td></tr>
					<tr> <td>Niveau maximal :</td> <td> <?php echo $server['lastLevel']; ?></td></tr>
					<tr> <td>Statut :</td> <td><?php echo $server['status'] ? '<button class="btn btn-mini btn-success">En ligne</button><br>' : '<button class="btn btn-mini btn-danger">Hors Ligne</button><br>'; ?></td></tr>
				</table>
				<?php endforeach; ?>

			</div>
		</div>
	</div>
</section>