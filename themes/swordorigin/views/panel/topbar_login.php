<div class="topbar">
<div class="fill">
<div class="container">
<a href="<?php echo site_url(); ?>" style="margin-left:90px;" class="brand"><?php echo NAME; ?></a>
<ul class="nav">
<li class="active"><a href="<?php echo site_url('boutique'); ?>">Boutique</a></li>
<li><a href="<?php echo $config['forum']; ?>">Forum</a></li>
<li><a href="<?php echo site_url('credit'); ?>">Achats Points</a></li>
</ul>
<ul class="nav"><a style="margin-left:300px;" href="#"><b>Vous avez <u><?php echo $_SESSION['pts']; ?></u> Points</b></a>
</ul></div>
</div>
</div>