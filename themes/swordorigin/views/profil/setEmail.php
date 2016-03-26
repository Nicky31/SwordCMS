<section class="grid-block position-bg-grey" id="innertop-a">
  <div class="grid-box width100 grid-h">
    <div class="module deepest" style="min-height: 542px;">
      <div class="frontpage-teaser-1"> <br> <br>
      
	  <form method="post" action="<?php echo site_url('profil','setEmail'); ?>">
	  <center>
	  <u>Question secrète :</u> <?php echo htmlspecialchars($_SESSION['question']); ?> <br />
	  <input id="response" name="reponse" type="text" placeholder="Réponse secrète" required /> <br /> <br />

	   <u>Nouvelle adresse e-mail :</u> <br />
	   <input id="newAccount" name="newMail" type="text" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" required /> 
	  <br> <br>
	  
	  <button name="register" type="submit" class="btn btn-info">Confirmer</button>
	  </center>
	  </form>
      </div>		
    </div>
  </div>
</section>
  