<div class="topbar">
<div class="fill">
<div class="container">
<a class="brand" style="margin-left:90px;" href="<?php echo site_url(); ?>"><?php echo NAME; ?></a>
<ul class="nav">
<li class="active"><a href="<?php echo site_url('boutique'); ?>">Boutique</a></li>
<li><a href="<?php echo $config['forum']; ?>">Forum</a></li>
<li><a href="<?php echo site_url('inscription'); ?>">Inscription</a></li>
</ul>
<form method="post" action="<?php echo site_url('connection'); ?>" class="pull-right">
<input name="login" class="small" type="text" placeholder="Compte">
<input name="password" class="small" type="password" placeholder="Mot de passe">
<button class="btn btn-warning" type="submit" name="logon" id="submitLogin">Se connecter</button>
</form>
</div>
</div>
</div>

