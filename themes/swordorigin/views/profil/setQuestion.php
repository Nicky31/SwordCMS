<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1"> <br> <br>
      
	  <form method="post" action="<?php echo site_url('profil','setQuestion'); ?>">
	  <center>
	  <u>Question secrète :</u> <?php echo htmlspecialchars($_SESSION['question']); ?> <br />
	  <input id="response" name="reponse" type="text" placeholder="Réponse secrète" required /> <br /> <br />

	   <u>Nouvelle question secrète :</u> Lettres & chiffres,tirets,"é","è" doit se terminer par un "?",5 a 48 caractères <br />
	   <input name="newQuestion" type="text" pattern="^[a-zA-Z0-9éè\s-]{5,48}\?$" required /> 
	  <br> <br>

	  <u>Nouvelle réponse secrète :</u> Lettres & chiffres,tirets,"é","è",5 à 48 caractères  <br />
	   <input name="newResponse" type="text"  pattern="^[a-zA-Z0-9éè\s-]{5,48}$" required /> 
	  <br> <br>
	  
	  <button name="register" type="submit" class="btn btn-info">Confirmer</button>
	  </center>
	  </form>
      </div>		
    </div>
  </div>
</section>

