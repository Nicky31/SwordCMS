
<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1"> <br> <br>
	<center> <br>
	
	  <form method="post" action="<?php echo site_url('inscription'); ?>">
	  <span id="errAccount"></span> <br />
	  <label style="margin-left:20px;" for="username">Nom de Compte : </label> <input type="text" id="username" name="account" style="margin-left:200px;" pattern="^[a-zA-Z0-9-]{6,20}$"><br><br>
	  
	  <span id="errPass"></span> <br>
	  <label style="margin-left:20px;" for="pass">Mot de passe :</label> <input type="password" id="pass" name="password" style="margin-left:217px;" pattern="^[a-zA-Z0-9]{6,20}$"><br><br>
	  <label style="margin-left:20px;" for="pass2">Comfirmation :</label> <input type="password" id="pass2" name="password2" style="margin-left:219px;" pattern="^[a-zA-Z0-9]{6,20}$"><br><br>
						  					
	  <label style="margin-left:20px;" for="email">E-Mail :</label> <input type="text" id="email" style="margin-left:263px;" name="email" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$"><br><br>
	  
	  <span id="errPseudo"></span><br>
	  <label style="margin-left:20px;" for="pseudo">Pseudo :</label> <input type="text" id="pseudo" name="pseudo" style="margin-left:256px;" pattern="^[a-zA-Z0-9]{4,20}$"><br><br>
	  
	  <label style="margin-left:20px;" for="question">Question secrete :</label> <select id="question" style="margin-left:195px;" name="question">
	  <option value="">&nbsp;</option>
	  <option value="Quel est mon numéro de ma carte de transport ?">Quel est mon numéro de ma carte de transport ?</option>
	  <option value="Quel est mon jeu de société préféré ?">Quel est mon jeu de société préféré ?</option>
	  <option value="Quel est mon joueur de football préféré ?">Quel est mon joueur de football préféré ?</option>
	  <option value="Quel est le modéle de ma premiére voiture ?">Quel est le modèle de ma première voiture ?</option>
	  <option value="Quel est le nom de mon livre préféré ?">Quel est le nom de mon livre préféré ?</option>
	  <option value="Quel est le deuxiéme prénom de mon pére ?">Quel est le deuxième prénom de mon père ?</option>
	  <option value="Quel est le nom de mon premier animal de compagnie ?">Quel est le nom de mon premier animal de compagnie ?</option>
	  </select><br><br>
	  
	  <label style="margin-left:20px;" for="reponse">Reponse secrete :</label> <input type="text" id="reponse" name="response" style="margin-left:195px;" pattern="^[a-zA-Z0-9éè\s-]{5,48}$"><br><br>
	  <br> <br>
	  
	  <button name="register" type="submit" class="btn btn-info">S'inscrire</button>
	  </center>
	  </form>
	</center>
      </div>		
    </div>
  </div>
</section>

<script>

$(function() {

	$('#username').change(function()
 	{
    	$.ajax({
       		url : '<?php echo site_url('inscription','ajax');?>', 
       		type : 'POST',
       		data : 'account='+ $("#username").val() + '&ajax=1',
       		dataType : 'html',
       		success : function(html,statut) {
				$("#errAccount").html(html);
       		}
    	});
  	});

  	$('#pseudo').change(function()
 	{
    	$.ajax({
       		url : '<?php echo site_url('inscription','ajax');?>', 
       		type : 'POST',
       		data : 'pseudo='+ $("#pseudo").val() + '&ajax=1',
       		dataType : 'html',
       		success : function(html,statut) {
				$("#errPseudo").html(html);
       		}
    	});
  	});

  	$('#pass2').change(function()
  	{
    	if($('#pass').val() != $('#pass2').val())
    	{
    		$('#errPass').html('<font color="red">Mots de passes différents');
    	} else
    	{
    		$('#errPass').html('');
    	}
  	});

});
</script>