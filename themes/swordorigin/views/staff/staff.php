<section class="grid-block position-bg-grey" id="innertop-a"><div class="grid-box width100 grid-h"><div class="module   deepest" style="min-height: 313px;">
<div class="frontpage-teaser-1">
<center>

<table class="table table-bordered table-striped table-condensed">
<tr class="info">
<td><b>Administrateurs</b></td>
</tr>

<?php foreach($administrateurs as $administrateur) : ?>
<tr>
  <td><?php echo $administrateur; ?></td>
</tr>
<?php endforeach; ?>
</table> <br />

<table class="table table-bordered table-striped table-condensed">
<tr class="info">
<td><b>Chefs Modérateurs</b></td>
</tr>

<?php foreach($chefmodos as $chefmodo) : ?>
<tr>
  <td><?php echo $chefmodo; ?></td>
</tr>
<?php endforeach; ?>
</table> <br /> 

<table class="table table-bordered table-striped table-condensed">
<tr class="info">
<td><b>Modérateurs</b></td>
</tr>

<?php foreach($modos as $modo) : ?>
<tr>
  <td><?php echo $modo; ?></td>
</tr>
<?php endforeach; ?>
</table>  <br />

<table class="table table-bordered table-striped table-condensed">
<tr class="info">
<td><b>Animateurs</b></td>
</tr>

<?php foreach($animateurs as $animateur) : ?>
<tr>
  <td><?php echo $animateur; ?></td>
</tr>
<?php endforeach; ?>
</table>  
    
</center>
</div>
</section>