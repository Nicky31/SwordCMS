<!--<div class="modal" style="border:1px solid #000000;"><?php //echo img('icones/pacman-loading.gif');?><br /><b>Chargement ...</b> </div> -->

<?php foreach($threads as $new): ?>
<section id="innertop-b" class="grid-block position-bg-white"></section>

<section class="grid-block position-bg-grey" id="innertop-a">
<div class="grid-box width100 grid-h">
<div class="module   deepest" style="min-height: 260px;">
<div class="frontpage-teaser-1">
<div class="box-inner news">
<h2 class="title">
<a href="#" style="color:#BFC132;"><?php echo htmlspecialchars($new['titre']); ?></a>
</h2>
<div class="by-line">
par <a href="<?php echo site_url('profil','public',intval($new['id'])); ?>" style="color:#BFC132;"><?php echo htmlspecialchars($new['auteur']); ?></a>
<span class="spacer"></span>, le <?php echo htmlspecialchars($new['date']); ?> 
<a class="comments-link" href="<?php echo site_url('comments','index',$new['id']); ?>" style="color:#BFC132;"></a>
<?php if($gm) : ?>
<a href="<?php echo site_url('thread','edit',intval($new['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/edit.png'); ?></a>
<a href="<?php echo site_url('thread','delete',intval($new['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/del.png'); ?></a>
<?php endif; ?>
</div>
<div class="article-left">
<a class="media-box pull-left" href="#" style="color:#BFC132;">
<img alt="" src="<?php echo img_url('profile/admin.jpg'); ?>" style="width:90px;height:90px;margin-top:-70px;" class="thumbnail">
</a>
</div>
<div class="article-right">
<div class="article-summary">
<?php echo display($new['text']); ?>
</div>
</div>
<span class="clear"> </span>
</div>
</div>
</div>
</div></section>

<?php endforeach; 

echo $pagination; ?>

<?php if($gm): ?>
<hr />

<section id="innertop-a" class="grid-block position-bg-grey"><div class="grid-box width100 grid-h"><div style="min-height: 494px;" class="module   deepest">
<div class="frontpage-teaser-1">

<center>
<table>
<form method="post" action="<?php echo site_url('thread','add'); ?>">
<input type="hidden" name="type" value="news" />
<tr> 
  <td align="center">Titre :</td> 
  <td align="center"><input type="text" name="title" id="titre" style="width:480px;" placeholder="Titre de la news ..."/></td>
</tr>

<tr>
  <td align="center">News :</td>
  <td align="center"><textarea name="content" cols="70" rows="14" style="width:480px;"></textarea></td>
</tr> <br />

<tr> <td align="center"></td> </br> <td align="right"><input class="btn btn-info" type="submit" value="Envoyer"/></input></td></tr>
</td></tr>
</form>
</table>

</center>

</div>		
</div></div></section>

<?php endif; ?>