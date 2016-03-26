<section id="innertop-b" class="grid-block position-bg-white"></section>
<section class="grid-block position-bg-grey" id="innertop-a">
<div class="grid-box width100 grid-h">
<div class="module   deepest" style="min-height: 260px;">
<div class="frontpage-teaser-1">
<div class="box-inner news">
<h2 class="title">
<a href="#" style="color:#BFC132;"><?php echo htmlspecialchars($article['titre']); ?></a>
</h2>
<div class="by-line">
par <a href="<?php echo site_url('profil','public',intval($article['id'])); ?>" style="color:#BFC132;"><?php echo htmlspecialchars($article['auteur']); ?></a>
<span class="spacer"></span>, le <?php echo htmlspecialchars($article['date']); ?> 
<?php if($gm) : ?>
<a href="<?php echo site_url('thread','edit',intval($article['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/edit.png'); ?></a>
<a href="<?php echo site_url('thread','delete',intval($article['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/del.png'); ?></a>
<?php endif; ?>
</div>
<div class="article-left">
<a class="media-box pull-left" href="#" style="color:#BFC132;">
<img alt="" src="<?php echo img_url('profile/admin.jpg'); ?>" style="width:90px;height:90px;margin-top:-70px;" class="thumbnail">
</a>
</div>
<div class="article-right">
<div class="article-summary">
<?php echo display($article['text']); ?>
</div>
</div>
<span class="clear"> </span>
</div>
</div>
</div>
</div></section>


<?php foreach($comments as $comment) : ?>
	<section id="innertop-b" class="grid-block position-bg-white"></section>
	<section class="grid-block position-bg-grey" id="innertop-a">
	<div class="grid-box width100 grid-h">
	<div class="module   deepest">
	<div class="frontpage-teaser-1">
	<div class="box-inner news">
	<div class="by-line" style="font-style:italic;">
	Posté par <a style="color:#BFC132;"><?php echo htmlspecialchars($comment['auteur']); ?></a>
	<span class="spacer"></span>, le <?php echo htmlspecialchars($comment['date']); ?> :
	<?php $isAutor = !empty($_SESSION['pseudo']) && $comment['auteur'] == $_SESSION['pseudo'];
	if($gm || $isAutor) : ?>
		<a href="<?php echo site_url('comments','delete',intval($comment['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/del.png'); ?></a>
		<?php if($isAutor) : ?>
			<a href="<?php echo site_url('comments','edit',intval($comment['id'])); ?>" style="color:#BFC132;"><?php echo img('icones/edit.png'); ?></a> 
		<?php endif; ?>
	<?php endif; ?>
	</div> <br />
	<div class="article-right">
	<div class="article-summary">
	<?php echo display($comment['text']); ?>
	</div>
	</div>
	<span class="clear"> </span>
	</div>
	</div>
	</div>
	</div></section>
<?php endforeach; ?>

<?php echo $pagination; ?>

<?php if(!empty($_SESSION['pseudo'])) : ?>
    <section id="innertop-a" class="grid-block position-bg-grey">
        <div class="grid-box width100 grid-h">
            <div style="min-height: 494px;" class="module   deepest">
                <div class="frontpage-teaser-1">
                    <center>
                    <table>
                    <form method="post" action="<?php echo site_url('comments','add',$article['id'],$article['type']); ?>">
                    <tr>
                      <td align="center">Commentaire :</td>
                      <td align="center"><textarea name="comment" cols="70" rows="14" style="width:445px;"></textarea></td>
                    </tr> <br />

                    <tr> <td align="center"></td> </br> <td align="right"><input class="btn btn-info" type="submit" value="Commmenter"/></input></td></tr>
                    </td></tr>
                    </form>
                    </table>
                    </center>
                </div>		
            </div>
        </div>
    </section>
<?php endif; ?>