
    <div class='row'>
      <div class="container">    
        <form action="" method="post">
            <h3 class='offset-3 col-6'>Nouveau chapitre</h3><br/>
            <?php
              if (isset($errorMessage))
              {
                  echo '<p> Message :' . $errorMessage . '</p>';
              }
            ?>
            <p class="row">
              <label for="title" class="col-4 col-lg-4">Titre du Chapitre : </label><input class="col-6 col-lg-6" type="text" name="title" maxlength="255" required/><br/>
            </p>
            <p class="row">
              <label for="content" class="col-4 col-lg-4">Contenu : </label><br/><textarea class="col-12 col-lg-12 new-chapter" name="content"></textarea><br/>
            </p>
            <p class="row">  
              <input class="button" type="submit" value="Enregistrer ce chapitre" name="save-chapter" />
            </p>
        </form>
      </div>
    </div>
