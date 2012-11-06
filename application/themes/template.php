<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<html>
    <head>
	    <title><?php echo NAME; ?></title>
	    <META NAME="keywords" lang="fr"content="serveur privé dofus 2.0"> 
		<META NAME="description" lang="fr" content="">
        <META NAME="robots" CONTENT="ALL">
        <META NAME="REVISIT-AFTER" CONTENT="1 DAYS">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" content="fr" />
        <?php echo css_url('style'); ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_PATH."/".ASSETS_DIR."/themes/images/ico.ico"; ?>" />
    </head>
    <body>
	<div id=all>
	
<!-- TOPSITE DEBUT -->
        <div id=top-site>
		    <div class="top-bouton">
			    <a href="<?php echo site_url('news','index'); ?>"><div class="top-home"></div></a>
				<div class="top-logo"></div>
				<a href="<?php echo site_url('boutique','index'); ?>"><div class="top-buy"></div></a>
			</div>
		</div>
<!-- TOPSITE FIN -->

<!-- HEADER DEBUT -->		
		<div id=header>
		    <div class="content-header">
			    <div class="headbox">
						<?php echo $panel; ?>
				</div>
			</div>
        </div>
<!-- HEADER FIN -->

<!-- CONTENT DEBUT -->
        <div id=content>
		
		    <!-- Menu de gauche début -->
		    <div class="left">
			    <a href="<?php echo site_url('vote','index'); ?>"><div class="left-vote"></div></a>
				
				<div class="top-menu"></div>
				
				<div class="mid-menu">
				    <div id="menu1">
                        <ul>
                            <li><a href="<?php echo site_url('news','index'); ?>">Accueil</a></li>
                            <li><a href="<?php echo site_url('join','index'); ?>">Nous rejoindre</a></li>
                            <li><a href="<?php echo site_url('boutique','index'); ?>">Boutique</a></li>
							<li><a href="<?php echo site_url('credit','index'); ?>">Créditer</a></li>
                            <li><a href="<?php echo $forum; ?>">Forum</a></li>
							<li><a href="<?php echo site_url('staff','index'); ?>">Equipe</a></li>
							<li><a href="javascript:alert('A venir');">Ladder</a></li>
                            <li><a href="javascript:alert('A venir');">Screenshots</a></li>
                        </ul>
                    </div>
				</div>
				<div class="bottom-menu"></div>
			</div>
			<!-- Menu de gauche fin -->
			
			<!-- Content de droite début -->
			<div class="right">
			    <div class="right-bar">
				    <div class="right-bar-title"> <?php echo $title; ?></div>
				</div>
				<div class="content-right">
				    <div class="content-right-top"></div>
					<div class="content-right-mid">
					<!-- right right -->
					    <div class="content-right-right">
						    <div class="informations">
							    <div class="informations-tableau">	
				                    <TABLE BORDER="0">
				                        <TR>
                                            <TD><div class="informations-tableau1">Serveur de jeux:</div></TD>
                                            <TD><div class="informations-tableau-request1"><span><?php echo $stats['server']; ?></span></div></TD>
					                    </TR>
                                        <TR>
                                            <TD><div class="informations-tableau1">Joueurs en ligne:</div></TD>
                                            <TD><div class="informations-tableau-request1">Undefined</div></TD>
					                    </TR>
                                        <TR>
                                            <TD><div class="informations-tableau1">Nombre d'inscrit:</div></TD>
                                            <TD><div class="informations-tableau-request1"><?php echo $stats['comptes']['count']; ?></div></TD>
					                    </TR>										
									</TABLE>
								</div>
								<div class="informations-tableau2">	
				                    <TABLE BORDER="0">
				                        <TR>
                                            <TD><div class="informations-tableau2">Serveur de  type:</div></TD>
                                            <TD><div class="informations-tableau-request2"><span><?php echo $config['type']; ?></span></div></TD>
					                    </TR>
										<TR>
                                            <TD><div class="informations-tableau2">Rate XP:</div></TD>
                                            <TD><div class="informations-tableau-request2">x<?php echo $config['pvm']; ?></div></TD>
					                    </TR>
										<TR>
                                            <TD><div class="informations-tableau2">Rate PVP:</div></TD>
                                            <TD><div class="informations-tableau-request2">x<?php echo $config['pvp']; ?></div></TD>
					                    </TR>
										<TR>
                                            <TD><div class="informations-tableau2">Rate Drop:</div></TD>
                                            <TD><div class="informations-tableau-request2">x<?php echo $config['drop']; ?></div></TD>
					                    </TR>
									</TABLE>
								</div>
							</div>
							
							<a href="<?php echo site_url('boutique','index'); ?>"><div class="right-bouton-vote"></div></a>
						</div>
					<!-- right right fin -->
						
					    <div class="content-right-left">
						
							<?php echo $content; ?>
						
						</div>
						
					</div>
					<div class="content-right-bottom"></div>
				</div>
			</div>
			<!-- Content de droite fin -->
			
	    <!-- footer -->
        <div class="footer"></div>
		</div>
<!-- CONTENT FIN -->
	</div>
    </body>
</html>
		
