<center><div class="hero-unit"><h1>Modifier mon nom de compte</h1></div></center>

<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1"> <br> <br>
      
	  <form method="post" action="<?php echo site_url('profil','setAccount'); ?>">
	  <center>
	  <u>Question secrète :</u> <?php echo htmlspecialchars($_SESSION['question']); ?> <br />
	  <input id="response" name="reponse" type="text" placeholder="Réponse secrète" required /> <br /> <br />

	   <u>Nouveau nom de compte :</u>  Lettres & chiffres, 6 à 20 caractères, - <br />
	   <input id="newAccount" name="newAccount" type="text" pattern="^[a-zA-Z0-9-]{6,20}$" required /> 
	  <br> <br>
	  
	  <button name="register" type="submit" class="btn btn-info">Confirmer</button>
	  </center>
	  </form>
      </div>		
    </div>
  </div>
</section>
