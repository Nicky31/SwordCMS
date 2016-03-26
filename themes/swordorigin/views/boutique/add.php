<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1"> 

	<h4>Ajouter un item boutique </h4>
	<center>
	  <form method="post">
	  <label style="margin-left:20px;" for="username">Nom de l'item : </label>
          <input type="text" id="searchItem" name="item" style="margin-left:10px;" autocomplete="off" required>
          <div id="results"></div><br><br>
	  
	  <label style="margin-left:20px;" for="pass">Prix : </label> <input type="text" name="prix" style="margin-left:60px;" required><br><br>
	  
	  <button name="register" type="submit" class="btn btn-info">Ajouter</button>
	  </form>
	</center>

	</div>
  </div>
</div>
</section>

<style>      
      #results { position:relative; left:57px; display: none; width: 233px; border: 1px solid #AAA; border-top-width: 0; background-color: #FFF; }
      #results div { width: 220px; padding: 2px 4px; text-align: left; border: 0; background-color: #FFF; }
      #results div:hover, .result_focus { background-color: #DDD !important; }
    </style>
    
    <script>
    (function() {

    var searchElement = $('#searchItem'),
        resultsElement = $('#results'),
        selectedResult = -1, // Permet de savoir quel résultat est sélectionné : -1 signifie « aucune sélection »
        previousValue = searchElement.val(); // Dernière valeure recherchée

        searchElement.keypress(function(e) {
          if(e.which == 13 && selectedResult > -1) // Touche entrée
          { 
            searchElement.val($('#results div').eq(selectedResult).html());
            $('#results div').eq(selectedResult).removeClass("result_focus");
            selectedResult = -1;
            resultsElement.css('display','none');
          }    
        });
        
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
          $.ajax({
              url : '<?php echo site_url('boutique','ajax');?>', 
              type : 'POST',
              data : 'search='+ previousValue + '&ajax=1',
              dataType : 'html',
              success : function(html,statut) {
                  var data = html.split("|"); // Tableau des résultats
                  resultsElement.html(""); // On vide les résultats
                  resultsElement.css("display","none");

                  if(data.length > 0 && data != "") 
                  { 
                      for(var i = 0,c = data.length; i < c; i++)
                      {
                          resultsElement.append("<div>"+data[i]+"</div>\n");
                      }
                      selectedResult = -1;
                      resultsElement.css("display","block");
                  } 
              },
              error : function(html,status) {
                  alert('Erreur durant l\'accès au serveur, veuillez excuser la gêne occasionnée');
              }
          });
        }
    }); // End event KeyUp
})();
    </script>