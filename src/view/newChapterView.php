
    <div clas='row'>
        
        <form action="" method="post">
            <h3 class='offset-3 col-6'>Nouveau chapitre</h3><br/>
            <?php
              if (isset($message))
              {
                  echo '<p> Message :' . $message . '</p>';
              }
            ?>
            <p>
                <label for="title">Titre du Chapitre : </label><input type="text" name="title" maxlength="255" required/><br/>
                <label for="content">Contenu : </label><textarea name="content"></textarea><br/>
                <input type="submit" value="Enregistrer ce chapitre" name="save-chapter" />
            </p>
        </form>
    </div>
