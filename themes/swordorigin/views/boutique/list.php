
<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1"> 
	<br>

	<?php if($gm): ?>
 			 <center><a class="btn btn-info" href="<?php echo site_url('boutique','add'); ?>">Ajouter un item</a></center>
 		 <br />
	<?php endif; ?>
                 <!--
		<center>
			<form id="formSearch">
				<input id="searchItem" type="text" placeholder="Nom de l'item ..." style="margin-left:10px;"  autocomplete="off" required>
				<button class="btn btn-info" type="submit" name="register">Rechercher</button>
			</form>
			<div id="results"></div>
			<div style="display:none; margin-top:5px;" class="alert alert-danger" id="unexistantItemShop">Aucun item trouvé !</div>
		</center> <br /> -->

		<?php foreach($items as $item) : ?>
			<div class="itemBoutique <?php echo str_replace(' ','_',$item['name']);?>">

				<div class="name"> <?php echo $item['name']; ?></div>
				<div class="level">Niveau <?php echo $item['level']; ?></div>
				<div class="points"><?php echo $item['points']; ?> points</div>
				<div class="stats">
					<?php echo $item['html']; ?>
				</div>

				<div class="swf">
					<?php echo getSwf('items/'. $item['swf']); ?>
				</div>
				<div class="link"><a style="color:#92979E;" href="<?php echo site_url('boutique','choose',$item['id']); ?>">Acheter</a></div>
				<?php if($gm) : ?>
					<div class="delete"><a href="<?php echo site_url('boutique','delete',$item['id']); ?>"><?php echo img('icones/supp.png'); ?> </a></div>
				<?php endif; ?>

			</div> <br />
		<?php endforeach; ?>
	
      </div>		
    </div>
  </div>
</section>


<style>      
      #results { position:relative; right:41px; display: none; width: 233px; border: 1px solid #AAA; border-top-width: 0; background-color: #FFF; }
      #results div { width: 220px; padding: 2px 4px; text-align: left; border: 0; background-color: #FFF; }
      #results div:hover, .result_focus { background-color: #DDD !important; }
    </style>
<script>
(function() {
	var shopItems = [<?php foreach ($items as $item) { echo ' \''. $item['name'] .'\','; } echo 'null'; ?>];
	/*
	 * Partie autocompletion
	 */
	var searchElement = $('#searchItem'),
	        resultsElement = $('#results'),
	        selectedResult = -1, // Permet de savoir quel résultat est sélectionné : -1 signifie « aucune sélection »
	        previousValue = searchElement.val(); // Dernière valeure recherchée

	        /*searchElement.keypress(function(e) {
	          if(e.which == 13 && selectedResult > -1) // Touche entrée
	          { 
	            searchElement.val($('#results div').eq(selectedResult).html());
	            $('#results div').eq(selectedResult).removeClass("result_focus");
	            selectedResult = -1;
	            resultsElement.css('display','none');ID
	          }    
	        });*/
	        
	        searchElement.keyup(function(e) { // Haut = 38 / Bas = 40 / Entrée = 13          
	        if(e.which == 38 && selectedResult > -1) // Touche haut
	        {
	          $('#results div').eq(selectedResult).removeClass('result_focus');
	          selectedResult--;

	          if(selectedResult > -1)
	          {
	            $('#results div').eq(selectedResult).addClass('result_focus');
	          }
	        } 

	        else if(e.which == 40 && selectedResult < $('#results div').length - 1) // Touche bas
	        { 
	          resultsElement.css('display','block');

	          if(selectedResult > -1)
	            $('#results div').eq(selectedResult).removeClass("result_focus");
	          selectedResult++;

	            $('#results div').eq(selectedResult).addClass("result_focus");   
	        }

	        else if(searchElement.val() != previousValue) // Si c'est une entrée de texte
	        { 	
    	      	previousValue = searchElement.val();
              	resultsElement.html(""); // On vide les résultats
            	resultsElement.css("display","none");
            	if(previousValue == "") return;

	            for(var i = 0,c = shopItems.length; i < c; i++)
            	{
              		if(shopItems[i] == null ) break;
                  	var regex  = new RegExp("^" + previousValue, "i");
                  	if(regex.exec(shopItems[i])) // Correspond à l'item recherché
	                	resultsElement.append("<div>"+shopItems[i]+"</div>\n");
              	}
              	selectedResult = -1;
              	resultsElement.css("display","block");  
	        }

	           else if(e.which == 13 && selectedResult > -1) // Touche entrée
		      {
				searchElement.val($('#results div').eq(selectedResult).html());
				$('#results div').eq(selectedResult).removeClass("result_focus");
				selectedResult = -1;
				resultsElement.css('display','none');
		      }

	    }); // End event KeyUp

	/*
	 * Partie recherche de l'item
	 */
	var exists = false;
	$('#formSearch').submit(function(e) {
		alert('submited');
			// Item existe ?			
			for (var i = 0; i < shopItems.length; i++) {
		    	if(shopItems[i] == searchElement.val())
		    	{
		    		exists = true;
		    		break;
		    	}
		    	else
		    		exists = false;
			}
			if(exists == false)
			{
		    	$('#unexistantItemShop').fadeIn('slow').delay(1000).fadeOut('slow');
		    	$('.itemBoutique').css('display','block');
		    	$('.target').val('');
		    	return false;
			}

		// On cache tous les items
		$('.itemBoutique').css('display','none');

		// On affiche celui recherché
		var selectHide = '.' +  searchElement.val().replace(' ','_');
		$(selectHide).css('display','block');
		$('.target').val('');
		return false;
	});

})();
</script>