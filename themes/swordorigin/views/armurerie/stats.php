<div class="caracts">
	<table>
	<tr class="topCaracts" style="color:rgb(255,204,114);"><td class="columnCaracts">Caractéristiques</td><td class="simpleColumn">Base</td><td class="simpleColumn">Bonus</td><td class="simpleColumn">Total</td></tr>
	<tr class="topCaracts"><td class="columnCaracts" style="color:white;">Caractéristiques primaires</td></tr>

	<tr class="lineA"><td class="columnCaracts">Vitalité</td><td class="simpleColumn"><?php echo $baseStats['vitalite']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_VITA]; ?></td><td class="simpleColumn"><?php echo $total['vitalité']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Sagesse</td><td class="simpleColumn"><?php echo $baseStats['sagesse']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_SASA]; ?></td><td class="simpleColumn"><?php echo $total['sagesse']; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Force</td><td class="simpleColumn"><?php echo $baseStats['force']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_FORCE]; ?></td><td class="simpleColumn"><?php echo $total['force']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Intelligence</td><td class="simpleColumn"><?php echo $baseStats['intelligence']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_INTEL]; ?></td><td class="simpleColumn"><?php echo $total['intelligence']; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Chance</td><td class="simpleColumn"><?php echo $baseStats['chance']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_CHANCE]; ?></td><td class="simpleColumn"><?php echo $total['chance']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Agilité</td><td class="simpleColumn"><?php echo $baseStats['agilite']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_AGI]; ?></td><td class="simpleColumn"><?php echo $total['agilité']; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">PA</td><td class="simpleColumn"><?php echo $baseStats['pa']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_PA]; ?></td><td class="simpleColumn"><?php echo $total['pa']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Mouvement</td><td class="simpleColumn"><?php echo $baseStats['pm']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_PM]; ?></td><td class="simpleColumn"><?php echo $total['pm']; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Initiative</td><td class="simpleColumn"><?php echo $baseStats['initiative']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_INI]; ?></td><td class="simpleColumn"><?php echo $total['initiative']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Prospection</td><td class="simpleColumn"><?php echo $baseStats['prospection']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_PP]; ?></td><td class="simpleColumn"><?php echo $total['prospection']; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Portée</td><td class="simpleColumn"><?php echo $baseStats['portée']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_PO]; ?></td><td class="simpleColumn"><?php echo $total['portée']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Invocation</td><td class="simpleColumn"><?php echo $baseStats['invocations']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_INVOC]; ?></td><td class="simpleColumn"><?php echo $total['invocations']; ?></td></tr>

	  <tr class="topCaracts"><td class="columnCaracts" style="color:white;">Caractéristiques secondaires</td></tr>
	  <tr class="lineB"><td class="columnCaracts">Esquive (PA)</td><td class="simpleColumn"><?php echo $baseStats['esquive']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_ESQUIVE_PA]; ?></td><td class="simpleColumn"><?php echo $total['esquivePA']; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Esquive (PM)</td><td class="simpleColumn"><?php echo $baseStats['esquive']; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_ESQUIVE_PM]; ?></td><td class="simpleColumn"><?php echo $total['esquivePM']; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Soins</td><td class="simpleColumn"> 0 </td><td class="simpleColumn"><?php echo $totalStuff[STAT_SOINS]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_SOINS]; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Coups critiques</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_CC]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_CC]; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Dommages</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_DMG]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_DMG]; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Dommages (%)</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_PRCENT_DMG]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_PRCENT_DMG]; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Renvoi (Dommages)</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_RENVOI_DMG]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_RENVOI_DMG]; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Echecs critiques</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_EC]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_EC]; ?></td></tr>
	  <tr class="lineB"><td class="columnCaracts">Bonus aux pièges</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_DMG_PIEGE]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_DMG_PIEGE]; ?></td></tr>
	  <tr class="lineA"><td class="columnCaracts">Pièges (%)</td><td class="simpleColumn">0</td><td class="simpleColumn"><?php echo $totalStuff[STAT_PRCENT_PIEGE]; ?></td><td class="simpleColumn"><?php echo $totalStuff[STAT_PRCENT_PIEGE]; ?></td></tr>
	</table>
</div>

</div>