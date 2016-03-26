<!DOCTYPE html>
<html slick-uniqueid="3" dir="ltr" lang="FR">
<head>
<meta charset="utf8" />
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="SwordOrigin">
<title><?php echo NAME; ?></title>
<?php
echo css_url('css/style');
echo css_url('css/bootstrap');
echo css_url('css/template'); 
echo css_url('css/modifications'); 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<style>
.modal{
	width:95px;
	height:70px;
	position:fixed;
	text-align:center;
	left:50%;
	top:50%;
	margin:-100px 0 0 -150px;
	color:#000000;
	background-color:#FFFFFF;
	border:1px solid #000000;
	padding-top:10px;
	font-size:13px;
	z-index:1000;
}

</style>
</head>
<body>
<?php echo $topbar; ?>

<div style="min-height: 550px;" class="page-body">
<div class="wrapper grid-block">
<header id="header">
<div id="headerbar" class="grid-block"><br><br><br><br>
<div class="logo">
<a href="<?php echo site_url(); ?>"></a>
</div>
<div class="custom-logo size-auto"></div></a>
<div class="module   deepest">
<div class="float-right">
<ul class="social-icons remove-margin">
<li class="twitter"><a href="#"></a></li>
<li class="facebook"><a href="#"></a></li>
<li class="google-plus"><a href="#"></a></li>
<li class="rss"><a href="#"></a></li>
</ul>
</div>
</div>
</div>
</header>
<div id="block-main">
<div id="main" class="grid-block">
<div style="background-color: rgb(246, 246, 246); min-height: 1817px;" id="maininner" class="grid-box">
<div id="menubar" class="grid-block">
<nav id="menu"><ul class="menu menu-dropdown">
<li class="level1 item105"><a href="<?php echo site_url(); ?>" class="level1 item101 parent active current"><span>Accueil</span></a></li>
<li class="level1 item105"><a href="<?php echo $config['forum']; ?>" class="level1"><span>Forum</span></a></li>
<li class="level1 item105"><a href="<?php echo site_url('inscription'); ?>" class="level1"><span>Inscription</span></a></li>
<li class="level1 item105"><a href="<?php echo site_url('ladder'); ?>" class="level1"><span>Ladder</span></a></li>
<li class="level1 item105"><a href="<?php echo site_url('screenshots'); ?>" class="level1"><span>ScreenShots</span></a></li>
</ul>
</nav>
</div>

<?php echo $content; ?>

</div>
 
<aside style="min-height: 1813px;border-radius:5px;" id="sidebar-a" class="grid-box sidebar"><div class="grid-box width100 grid-v">
<?php echo $panel; ?>

<div class="grid-box width100 grid-v"><div class="module mod-box mod-box-dark  deepest">
<h3 class="module-title">Communauté</h3>
<ul class="menu menu-sidebar">
<li class="level1 item111 parent">
<a href="<?php echo site_url(); ?>" class="level1 parent"><span>Accueil</span></a>
<a href="<?php echo site_url('screenshots'); ?>" class="level1 parent"><span>ScreenShots</span></a>
<a href="<?php echo site_url('join'); ?>" class="level1 parent"><span>Nous Rejoindre</span></a>
<a href="<?php echo site_url('inscription'); ?>" class="level1 parent"><span>Inscription</span></a>
<a href="<?php echo site_url('ladder'); ?>" class="level1 parent"><span>Ladder</span></a>
<a href="<?php echo site_url('staff'); ?>" class="level1 parent"><span>Staff</span></a>
</li>
</div></div>
<div class="grid-box width100 grid-v"><div class="module mod-box mod-box-dark  deepest">
<h3 class="module-title">Interactif</h3>
<ul class="menu menu-sidebar">
<li class="level1 item111 parent">
<a href="<?php echo $config['forum']; ?>" class="level1 parent"><span>Forum</span></a>
<a href="<?php echo site_url('thread','index','tutorial'); ?>" class="level1 parent"><span>Tutoriels</span></a>
<a href="<?php echo site_url('boutique'); ?>" class="level1 parent"><span>Boutique</span></a>
<a href="<?php echo site_url('vote'); ?>" class="level1 parent"><span>Vote</span></a>
<a href="<?php echo site_url('servers'); ?>" class="level1 parent"><span>Statuts des serveurs</span></a>
</li>
</div></div>

<div class="grid-box width100 grid-v"><div class="module mod-inset mod-transparent  deepest">
<h3 class="module-title"></h3>
<div class="vote_box">
<a class="vote" href="<?php echo site_url('vote'); ?>"></a>
</div>
<br>
</div>
</div>
</div>
</aside>
 </div>
 
<footer id="footer" class="grid-block">
<a id="totop-scroller" href="#"></a>
<div class="module   deepest">
</div>
<div class="module   deepest">
<br>Copyright © 2012 <a style="color:#FFF;" href="index.html" target="_blank">SwordOrigin</a>
</div>Design by <a style="color:#FFF;" href="#">Triicky</a> & PHP by <a style="color:#FFF;" href="#">Nicky31</a>
</footer>
</div>
</div>
<div id="lightbox-tmp"></div><div id="lightbox-loading"><div></div></div><div style="display: none;" id="lightbox-overlay"></div><div id="lightbox-wrap"><div id="lightbox-outer"><div id="lightbox-content"></div><a id="lightbox-close"></a><div id="lightbox-title"></div><a href="javascript:;" id="lightbox-left"><span id="lightbox-left-ico"></span></a><a href="javascript:;" id="lightbox-right"><span id="lightbox-right-ico"></span></a></div></div></body>
</html>