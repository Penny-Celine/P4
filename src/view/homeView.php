
    <div class ="row welcome-container">
      <div class="offset-1 col-10 col-lg-10">
        <blockquote class="blockquote">Soyez les bienvenu.e.s sur ce blog un peu particulier. Je me présente : Jean Forteroche, écrivain.<br/>
          Ici, je vais publier en temps réel les chapitres de mon futur roman : "Billet pour l'Alaska"<br/>
          Vous trouverez plus bas sur cette page le dernier chapitre paru. En haut de l'écran dans la barre de navigation vous pouvez accéder à la connexion au site si vous êtes déjà membre, voir tous les chapitres parus ou vous inscrire sur ce site.<br/>
          Ce site autorise les commentaires sur son contenu. Vous pouvez commenter mes chapitres si vous êtes membre.<br/>
          Pour devenir membre, inscrivez-vous ! Bonne lecture !<br/>
          <small>Jean Forteroche</small><br/>
        </blockquote>
      </div>
    </div>
    <div class="container last-chapter-container">
      <div class = "row">
        <div class = "col-12 col-lg-12 last-chapter">
          <div class = "row">
            <h2 class= "offset-3 col-6 last-chapter-title">
              <?php 
                echo $lastChapterTitle;
              ?>
            </h2>
            <span class="col-3 col-lg-3">Paru le <?php echo $lastChapterCreationDate; ?></span>
          </div>
          <div class="row">
            <p class="offset-1 col-10 col-lg-10">
              <?php 
                echo $lastChapterContent;
              ?>
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <h3 class="col-12 col-lg-12">Commentaires</h3><br/>
      </div>
      <div class="row">
        <p col-12 col-lg-12>
            <?php
                for ($i=0; isset($orderedComments[$i]); $i ++)
                {
                    echo '<form action="" method="post">';
                    echo '<div class="container comment">';
                    echo '<p class="row">Auteur :' .$orderedComments[$i]->author(). '</p><br/> ';
                    echo '<p class="row">Commentaire :' .$orderedComments[$i]->content(). '</p><br/> ';
                    echo '<p class="row">Ecrit le :' .$orderedComments[$i]->creationDate(). '</p></div>';
                    //echo 'Déjà modéré ?' .$orderedComments[$i]->isModified(). ' ';
                    //echo 'Reporté ?' .$orderedComments[$i]->isReported(). ' ';
                    echo '<input type="hidden" name="commentId" value="'.$orderedComments[$i]->id().'"/>';
                    echo '<input class="button" type="submit" name="report" value="Signaler"/></form>';
                }
            ?>
        </p>
      </div>
    </div>
    <div class='row'>
        <div class="container">    
                <form action="" method="post">
                    <h3 class='offset-3 col-6'>Commenter :</h3><br/>
                    <?php
                      if (isset($message))
                      {
                          echo '<p> Message :' . $message . '</p>';
                      }
                    ?>
                    <p class="col-12 col-lg-12">
                        <label for="author">Votre pseudo : </label><input type="text" name="author" value="<?=$_SESSION['user'] ?? ''?>" maxlength="255" required/><br/>
                        <label for="content">Message : </label><textarea name="content"></textarea><br/>
                        <input type="hidden" name="chapterId" value="<?= $chapterId ?? ''?>"/>
                        <input type="submit" value="Enregistrer" name="post-comment" />
                    </p>
                </form>
        </div>
    </div>

